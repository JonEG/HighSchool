<?php
defined('TYPO3_MODE') || die('Access denied.');

//? Set plugin controller and actions
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'StudentList',
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'list',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'list',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'ClassmatesList',
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'classmates',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'classmates',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'SubjectsList',
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'subjects',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'subjects',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'ExamsCRUD',
    [
        \OvanGmbh\ClassYear\Controller\ExamController::class => 'list, form, create, edit',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\ExamController::class => 'list, form, create, edit',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'JsonPlugin',
    [
        \OvanGmbh\ClassYear\Controller\JsonController::class => 'listClassrooms, showClassroom',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\JsonController::class => 'listClassrooms, showClassroom',
    ]
);