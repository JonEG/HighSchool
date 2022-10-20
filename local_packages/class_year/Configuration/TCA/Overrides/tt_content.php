<?php
//? Add Plugin basic configuration to the TCA
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear', // extensionName
    'StudentList', // pluginName
    'List current students', // pluginTitle
    'EXT:classyear/Resources/Public/Icons/Extension.png'  // pluginIcon
);

//? add to Includes list on the backoffice
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('classyear','Configuration/Typoscript','StudentList');
