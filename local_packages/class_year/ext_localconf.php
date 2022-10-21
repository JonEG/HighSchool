<?php
defined('TYPO3_MODE') || die('Access denied.');

//? Set plugin controller and actions
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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'ClassmatesList',
    [
        \OvanGmbh\ClassYear\Controller\StudentController::class => 'classmates',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\StudentController::class => 'classmates',
    ]
);