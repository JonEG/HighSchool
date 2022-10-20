<?php
defined('TYPO3') or die();

// Add some fields to fe_users table to show TCA fields definitions
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',
   [
        'tx_classyear_classroom' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:classroom',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => null,
                'items' => [
                    ['null', null],
                    ['Please select an option','--div--'], // null-option
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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
   'fe_users',
   'tx_classyear_classroom',
   '',
   'after:password'
);

//? Record type for Students
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'fe_users',
    'tx_extbase_type',
    [
        'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:student', //label 
        'tx_classyear_domain_model_student' //db value
    ],
);

//? Record type for Teachers
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'fe_users',
    'tx_extbase_type',
    [
        'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:teacher', //label 
        'tx_classyear_domain_model_teacher' //db value
    ],
);