<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:student',
        'label' => 'name',
        'iconfile' => 'EXT:classyear/Resources/Public/Icons/Student.gif',
    ],
    'columns' => [
        'name' => [
            'name' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:name',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ],
        ],
        'surname' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:surname',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ],
        ],
        'email' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:email',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ],
        ],
        'classroom' => [
            'label' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:classroom',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_classyear_domain_model_classroom',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'name, surname, email, classroom'],
    ],
];