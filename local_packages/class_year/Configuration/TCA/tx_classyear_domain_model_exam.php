<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:exam',
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
            'label' => 'Title',
            'config' => [
                'required' => true,
                'type' => 'input',
            ]
        ],
        'date' => [
            'label' => 'Date',
            'config' => [
                'required' => true,
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ]
        ],
        'classroom' => [
            'label' => 'Classroom',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => null,
                'items' => [
                    [
                        'Static values',
                        '--div--',
                    ],
                    [
                        'undefined',
                        null,
                    ],
                    [
                        'DB values',
                        '--div--',
                    ],
                ],
                'foreign_table' => 'tx_classyear_domain_model_classroom',
            ],
        ],
        'subject' => [
            'label' => 'Subject',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => null,
                'items' => [
                    [
                        'Static values',
                        '--div--',
                    ],
                    [
                        'undefined',
                        null,
                    ],
                    [
                        'DB values',
                        '--div--',
                    ],
                ],
                'foreign_table' => 'tx_classyear_domain_model_subject', // SELECT * from tx_classyear_domain_model_subject
                'foreign_table_where' => 'AND {#tx_classyear_domain_model_subject}.{#uid} IN (SELECT {#tx_classyear_mm_classroom_subject}.{#uid_local} FROM {#tx_classyear_mm_classroom_subject} WHERE {#tx_classyear_mm_classroom_subject}.{#uid_foreign} = ###REC_FIELD_classroom###)',
            ],
        ],
        'questions' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:exam.question',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_classyear_domain_model_examquestion',
                'foreign_table_field' => 'questions',
            ]
        ]

    ],
    'types' => [
        '0' => ['showitem' => 'title, date, classroom, subject, questions'],
    ],
];