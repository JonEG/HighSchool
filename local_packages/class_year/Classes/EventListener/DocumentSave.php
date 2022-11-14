<?php

namespace OvanGmbh\ClassYear\EventListener;

use TYPO3\CMS\Backend\Controller\Event\AfterFormEnginePageInitializedEvent;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DocumentSave
{
    public function __invoke(AfterFormEnginePageInitializedEvent $event): void
    {
        // $eventRequest = $event->getRequest();
        // $final_url = $eventRequest->getAttribute('random_image_url');
        // if (!$final_url) {
        //     return;
        // }

        // $document = $eventRequest->getParsedBody()['data']['tt_content'];
        // //do nothing if no content
        // if (!is_array($document)) {
        //     return;
        // }

        // foreach ($document as $id => $_) {
        //     $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        //     $query = $queryBuilder->update('tt_content');
        //     $query->where(
        //         $queryBuilder->expr()->eq('uid', $id),
        //     );
        //     $query->set('tx_classyear_random_image_url', $final_url);
        //     $response = $query->execute();
        // }
    }
}
