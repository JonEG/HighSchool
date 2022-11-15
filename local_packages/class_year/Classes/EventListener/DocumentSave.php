<?php

namespace OvanGmbh\ClassYear\EventListener;

use TYPO3\CMS\Backend\Controller\Event\AfterFormEnginePageInitializedEvent;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DocumentSave
{
    public function __invoke(AfterFormEnginePageInitializedEvent $event): void
    {
        /**
         * We were trying to modify random_image records before they are saved.
         * We ended up using middleware to modify the record. Since this event 
         * is called after the record is persisted, we would need to create a new db 
         * connection and persist the element again with our record modifications to make this work.
         * Also we do not have access to the id to persist it when it is created for the first time.
         * So we could only use this when editing not creating.
        */ 
    }
}
