<?php

namespace OvanGmbh\ClassYear\Middleware;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use Psr\Http\Message\UriFactoryInterface;

class RandomImageMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if($request->getQueryParams()['route'] != '/record/edit'){
            return $handler->handle($request);
        } 
        
        $document = $request->getParsedBody()['data']['tt_content'];
        if(!is_array($document)) return $handler->handle($request); //pass to next middleware

        foreach ($document as $id => $tt_content) {

            //if request is not save random_image, pass to next middleware
            if($tt_content['CType'] != 'classyear_randomimage') return $handler->handle($request);
            
            //obtain url base from db
            if(filter_var($tt_content['tx_classyear_random_image_url'], FILTER_VALIDATE_URL)) {
                $requestFactory = GeneralUtility::makeInstance(RequestFactoryInterface::class);
                $uriInterface = GeneralUtility::makeInstance(UriFactoryInterface::class);
                //create url
                $url_parts = preg_split("/\//", $tt_content['tx_classyear_random_image_url']);
                $url_origin_parts = array_slice($url_parts, 0, 3);
                $clean_url = implode('/',$url_origin_parts);
                $url = $clean_url . '/' . $tt_content['imageheight']. '/' . $tt_content['imagewidth'];
                $options = array(
                    CURLOPT_RETURNTRANSFER => true,   // return web page
                    // CURLOPT_HEADER         => false,  // don't return headers
                    CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                    CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                    CURLOPT_ENCODING       => "",     // handle compressed
                    // CURLOPT_USERAGENT      => "test", // name of client
                    CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                    CURLOPT_CONNECTTIMEOUT => 6,    // time-out on connect
                    CURLOPT_TIMEOUT        => 6,    // time-out on response
                ); 
            
                $curl = curl_init($url);
                curl_setopt_array($curl, $options);
            
                $content = curl_exec($curl);

                //get last redirected url
                $redirected_url = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
            
                curl_close($curl);

                if($redirected_url){
                    $updated_parsed_body = $request->getParsedBody();
                    $updated_parsed_body['data']['tt_content'][$id]['tx_classyear_random_image_url'] = $redirected_url;
                    $new_request = $request->withParsedBody($updated_parsed_body);
                    return $handler->handle($new_request);
                }
            }
        }
        return $handler->handle($request);
    }
}
