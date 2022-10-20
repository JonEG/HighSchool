<?php
defined('TYPO3') or die();

//? Add some fields to fe_users table to show TCA fields definitions
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',
   [
        'tx_classyear_classroom' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:classroom',
            'displayCond' => 'FIELD:tx_extbase_type:=:tx_classyear_domain_model_student',
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