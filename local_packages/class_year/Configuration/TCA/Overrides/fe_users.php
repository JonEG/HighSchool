<?php
defined('TYPO3') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'classyear',
    'fe_users',
);

//TODO choose categories and load values

//? Add some fields to fe_users table to show TCA fields definitions
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',
   [
        'tx_classyear_classroom' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:classroom',
            'displayCond' => 'FIELD:tx_extbase_type:=:' . OvanGmbh\ClassYear\Domain\Model\Student::EXTBASE_TYPE,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Please select an option','--div--'],
                ],
                'foreign_table' => 'tx_classyear_domain_model_classroom',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
   ]
);

//? Add to fe_users TCA in backoffice
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
   'fe_users',
   'tx_classyear_classroom',
   '',
   'after:tx_extbase_type'
);

//? Record type for Students
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'fe_users',
    'tx_extbase_type',
    [
        'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:student', //label 
        OvanGmbh\ClassYear\Domain\Model\Student::EXTBASE_TYPE //db value
    ],
);