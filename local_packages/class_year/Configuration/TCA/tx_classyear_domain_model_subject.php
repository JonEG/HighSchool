<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:subject',
        'label' => 'title',
        'iconfile' => 'EXT:classyear/Resources/Public/Icons/Student.gif',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'versioningWS' => true,
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:name',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ],
        ],
        'classrooms' => [
            'label' => 'Classrooms where this subject is taught',
            'config' => [
               'type' => 'group',
               'internal_type' => 'db',
               'allowed' => 'tx_classyear_domain_model_classroom',
               'foreign_table' => 'tx_classyear_domain_model_classroom',
               'MM' => 'tx_classyear_mm_classroom_subject',
            ]
        ]
    ],
    'types' => [
        '0' => ['showitem' => 'title, classrooms'],
    ],
];