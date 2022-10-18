<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'StudentList',
    [
        \OvanGmbh\ClassYear\Controller\StudentController::class => 'list',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\StudentController::class => 'list',
    ]
);