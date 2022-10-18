<?php

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear',
    'StudentList',
    'List current students',
    'EXT:classyear/Resources/Public/Icons/Extension.png'
);

//? add to Includes list on the backoffice
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('classyear','Configuration/Typoscript','StudentList');
