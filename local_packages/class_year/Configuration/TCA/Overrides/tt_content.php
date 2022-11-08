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

//? Add Plugin basic configuration to the TCA
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear', // extensionName
    'ExamsCRUD', // pluginName
    'Exam crud', // pluginTitle
    'EXT:classyear/Resources/Public/Icons/Extension.png'  // pluginIcon
);

//? add to Includes list on the backoffice
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('classyear','Configuration/Typoscript','ClassYear');

//? New Content element Type
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'Random Image', //label 
        'classyear_randomimage', //content element key
        'tt-random-image-icon' //icon identifier
    ],
    'textmedia',
    'after'
);