<?php 

//? Add Plugin basic configuration to the TCA
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ClassYear', // extensionName
    'StudentList', // pluginName
    'List current students', // pluginTitle
    'EXT:classyear/Resources/Public/Icons/Extension.png'  // pluginIcon
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['classyear_studentlist']='pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'classyear_studentlist',
    'FILE:EXT:classyear/Configuration/Flexforms/PluginStudentList.xml'
);