<?php
//? Add Plugin basic configuration to the TCA
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear', // extensionName
    'StudentList', // pluginName
    'List current students', // pluginTitle
    'EXT:classyear/Resources/Public/Icons/Extension.png'  // pluginIcon
);

//? Add Plugin basic configuration to the TCA
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear', // extensionName
    'ClassmatesList', // pluginName
    'List user classmates', // pluginTitle
    'EXT:classyear/Resources/Public/Icons/Extension.png'  // pluginIcon
);

//? Add Plugin basic configuration to the TCA
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear', // extensionName
    'SubjectsList', // pluginName
    'List user subjects', // pluginTitle
    'EXT:classyear/Resources/Public/Icons/Extension.png'  // pluginIcon
);

//? Add Plugin basic configuration to the TCA
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear', // extensionName
    'JsonPlugin', // pluginName
    'Json stuff', // pluginTitle
    'EXT:classyear/Resources/Public/Icons/Extension.png'  // pluginIcon
);

//? add to Includes list on the backoffice
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('classyear','Configuration/Typoscript','ClassYear');
