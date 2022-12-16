<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:classyear/Resources/Private/Language/locallang.xlf:exam.question',
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