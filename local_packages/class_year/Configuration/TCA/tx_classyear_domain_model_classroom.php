<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:classroom',
        'label' => 'name',
        'iconfile' => 'EXT:classyear/Resources/Public/Icons/Student.gif',
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim, unique',
                'required' => true,
            ],
        ],
        'slug' => [
            'label' => 'Slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['name'],
                    'replacements' => [
                        '/' => ''
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => ''
            ]
        ],
        'tutor' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:tutor',
            'config' => [
                'type' => 'select',
                'default' => null,
                'items' => [
                    ['null', null],
                    ['Please select an option','--div--'], // null-option
                ],
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'maxitems' => 1,
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'subjects' => [
            'label' => 'Subjects taught in this classroom',
            'config' => [
               'type' => 'group',
               'internal_type' => 'db',
               'allowed' => 'tx_classyear_domain_model_subject',
               'foreign_table' => 'tx_classyear_domain_model_subject',
               'MM' => 'tx_classyear_mm_classroom_subject',
               'MM_opposite_field' => 'classrooms',
            ]
        ],
        'students' => [
            'exclude' => true, //prevents everyone but admins from editing 
            'label' => 'Students in this classroom',
            'config' => [
                'readOnly' => true, //prohibits editing for everyone
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'foreign_field' => 'tx_classyear_classroom', //child field that points to parent
            ]
        ]
    ],
    'types' => [
        '0' => ['showitem' => 'name, slug, tutor, subjects, students'],
    ],
];