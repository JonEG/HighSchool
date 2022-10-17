<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:studentTitle',
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
    ],
    'types' => [
        '0' => ['showitem' => 'name, surname, email'],
    ],
];