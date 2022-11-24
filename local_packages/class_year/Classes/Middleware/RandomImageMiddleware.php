<?php

namespace OvanGmbh\ClassYear\Middleware;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class RandomImageMiddleware implements MiddlewareInterface
{
 public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
 {
  if ($request->getQueryParams()['route'] != '/record/edit') {
   return $handler->handle($request);
  }

  $document = $request->getParsedBody()['data']['tt_content'];
  if (!is_array($document)) {
   return $handler->handle($request);
  }
  //pass to next middleware

  foreach ($document as $id => $tt_content) {

   //if request is not save random_image, pass to next middleware
   if ($tt_content['CType'] != 'classyear_randomimage') {
    return $handler->handle($request);
   }

   //obtain url base from db
   if (filter_var($tt_content['tx_classyear_random_image_url'], FILTER_VALIDATE_URL)) {
    $value = self::recursiveFind($tt_content['pi_flexform'], 'settings.isAutomaticallyRefreshed');
    if ($value['vDEF']) {
     $url = 'https://picsum.photos' . '/' . $tt_content['imageheight'] . '/' . $tt_content['imagewidth'];
     $updated_parsed_body = $request->getParsedBody();
     $updated_parsed_body['data']['tt_content'][$id]['tx_classyear_random_image_url'] = $url;
     $new_request = $request->withParsedBody($updated_parsed_body);
     return $handler->handle($new_request);
    }
   };
   $requestFactory = GeneralUtility::makeInstance(RequestFactoryInterface::class);
   $uriInterface = GeneralUtility::makeInstance(UriFactoryInterface::class);
   //create url
   $url = 'https://picsum.photos' . '/' . $tt_content['imageheight'] . '/' . $tt_content['imagewidth'];
   $options = array(
    CURLOPT_RETURNTRANSFER => true, // return web page
    // CURLOPT_HEADER         => false,  // don't return headers
    CURLOPT_FOLLOWLOCATION => true, // follow redirects
    CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
    CURLOPT_ENCODING => "", // handle compressed
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13', // name of client
    CURLOPT_AUTOREFERER => true, // set referrer on redirect
    CURLOPT_CONNECTTIMEOUT => 6, // time-out on connect
    CURLOPT_TIMEOUT => 6, // time-out on response
   );

   $curl = curl_init($url);
   curl_setopt_array($curl, $options);

   $content = curl_exec($curl);

   //get last redirected url
   $redirected_url = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);

   curl_close($curl);

   if ($redirected_url) {
    $updated_parsed_body = $request->getParsedBody();
    $updated_parsed_body['data']['tt_content'][$id]['tx_classyear_random_image_url'] = $redirected_url;
    $new_request = $request->withParsedBody($updated_parsed_body);
    return $handler->handle($new_request);
   }
  }
  return $handler->handle($request);
 }

 private function recursiveFind(array $haystack, $needle)
 {
  $iterator = new \RecursiveArrayIterator($haystack);
  $recursive = new \RecursiveIteratorIterator(
   $iterator,
   \RecursiveIteratorIterator::SELF_FIRST
  );
  foreach ($recursive as $key => $value) {
   if ($key === $needle) {
    return $value;
   }
  }
 }
}
