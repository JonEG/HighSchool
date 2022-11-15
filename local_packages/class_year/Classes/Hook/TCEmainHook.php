<?php

declare (strict_types = 1);

namespace OvanGmbh\ClassYear\Hook;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class TCEmainHook
{
    public function processDatamap_preProcessFieldArray(array&$fieldArray, $table, $id, \TYPO3\CMS\Core\DataHandling\DataHandler&$pObj)
    {
    }
}
