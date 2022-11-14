<?php

declare (strict_types = 1);

namespace OvanGmbh\ClassYear\Hook;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class TCEmainHook
{
    /** 
     * Update the random image content url to a hardcoded one
     */
    public function processDatamap_preProcessFieldArray(array&$fieldArray, $table, $id, \TYPO3\CMS\Core\DataHandling\DataHandler&$pObj)
    {
        // // $id_to_be_created = str_contains(strval($id), 'NEW');
        // $is_valid_url = filter_var($fieldArray['tx_classyear_random_image_url'], FILTER_VALIDATE_URL);
        // if($is_valid_url) {
        //     $requestFactory = GeneralUtility::makeInstance(RequestFactoryInterface::class);
        //     $uriInterface = GeneralUtility::makeInstance(UriFactoryInterface::class);
        //     //create url
        //     $url_parts = preg_split("/\//", $fieldArray['tx_classyear_random_image_url']);
        //     $url_origin_parts = array_slice($url_parts, 0, 3);
        //     $clean_url = implode('/',$url_origin_parts);
        //     $url = $clean_url . '/' . $fieldArray['imageheight']. '/' . $fieldArray['imagewidth'];

        //     $options = array(
        //         CURLOPT_RETURNTRANSFER => true,   // return web page
        //         // CURLOPT_HEADER         => false,  // don't return headers
        //         CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        //         CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        //         CURLOPT_ENCODING       => "",     // handle compressed
        //         // CURLOPT_USERAGENT      => "test", // name of client
        //         CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        //         CURLOPT_CONNECTTIMEOUT => 6,    // time-out on connect
        //         CURLOPT_TIMEOUT        => 6,    // time-out on response
        //     ); 
        
        //     $curl = curl_init($url);
        //     curl_setopt_array($curl, $options);
        
        //     $content = curl_exec($curl);

        //     //get last redirected url
        //     $redirected_url = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        
        //     curl_close($curl);

        //     if($redirected_url){
        //         $fieldArray['tx_classyear_random_image_url'] = $redirected_url;
        //     }
        // }
    }
}
