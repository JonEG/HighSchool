<?php

namespace OvanGmbh\ClassYear\EventListener;

use TYPO3\CMS\Backend\Controller\Event\AfterFormEnginePageInitializedEvent;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DocumentSave
{
    public function __invoke(AfterFormEnginePageInitializedEvent $event): void
    {
        $eventRequest = $event->getRequest();
        $document = $eventRequest->getParsedBody()['data']['tt_content'];
        foreach ($document as $id => $tt_content) {
            if($tt_content['CType'] == 'classyear_randomimage'){
                $url_pieces = preg_split('/\//', $tt_content['tx_classyear_random_image_url']);
                $url_pieces[count($url_pieces) - 1 ] = $tt_content['imagewidth'];
                $url_pieces[count($url_pieces) - 2 ] = $tt_content['imageheight'];

                $new_generated_url = implode('/', $url_pieces);

                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
                $query = $queryBuilder->update('tt_content');
                $query->where(
                    $queryBuilder->expr()->eq('uid', $id),
                );
                $query->set('tx_classyear_random_image_url', $new_generated_url);
                $response = $query->execute();

                switch ($response) {
                    case 0:
                    case 1:
                    default:
                    var_dump($response);
                }
            }
        }
    }
}