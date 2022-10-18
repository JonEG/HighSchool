<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:classroom',
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
    ],
    'types' => [
        '0' => ['showitem' => 'name'],
    ],
];