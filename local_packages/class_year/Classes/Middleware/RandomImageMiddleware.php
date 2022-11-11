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
        $document = $request->getParsedBody()['data']['tt_content'];
        if(!is_array($document)) return $handler->handle($request); //pass to next middleware

        foreach ($document as $id => $tt_content) {
            if($tt_content['CType'] != 'classyear_randomimage') return $handler->handle($request); //pass to next middleware
            //obtain url base from db
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
            $query = $queryBuilder->select('tx_classyear_random_image_url')->from('tt_content');
            $query->where(
                $queryBuilder->expr()->eq('uid', $id),
            );
            $response = $query->execute()->fetch();

            if($response['tx_classyear_random_image_url']) {
                $requestFactory = GeneralUtility::makeInstance(RequestFactoryInterface::class);
                $uriInterface = GeneralUtility::makeInstance(UriFactoryInterface::class);
                //create url 
                $url = $response['tx_classyear_random_image_url'] . '/' . $tt_content['imageheight']. '/' . $tt_content['imagewidth'];

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
                    return $handler->handle($request->withAttribute('random_image_url', $redirected_url));
                }
            }
        }
        return $handler->handle($request);
    }
}
