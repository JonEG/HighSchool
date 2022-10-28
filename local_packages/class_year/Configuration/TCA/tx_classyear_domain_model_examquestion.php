<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:exam.question',
        'label' => 'title',
        'iconfile' => 'EXT:classyear/Resources/Public/Icons/Student.gif',
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => [
                'required' => true,
                'type' => 'input',
            ]
        ],
        'correct_answer' => [
            'label' => 'Correct answer',
            'default' => null,
            'config' => [
                'nullable' => true,
                'type' => 'radio',
                'items' => [
                    ['verdadero',1 ],
                    ['falso',2 ],
                ]
            ]
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'title, correct_answer'],
    ],
];