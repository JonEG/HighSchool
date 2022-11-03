<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
    'highschool',
    '',
    'top',
    null,
    [
        'labels' => 'LLL:EXT:classyear/Resources/Private/Language/locallang_mod_highschool.xlf',
        'name' => 'highschool',
        'iconIdentifier' => 'mod-highschool', //registered icon in ext_localconf
    ]
);

// Module HighSchool > Students
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'ClassYear', //extension name
    'highschool', //module name
    'tx_highschool_students', //submodule key
    'top',
    [
        \OvanGmbh\ClassYear\Controller\BackendHighschoolController::class => 'listStudents, recoveryEmail',
    ],
    [
        'access' => 'admin',
        'icon' => 'EXT:classyear/Resources/Public/Icons/Student.gif',
        'labels' => 'LLL:EXT:classyear/Resources/Private/Language/locallang_mod_highschool_student.xlf',
    ]
);