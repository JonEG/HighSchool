<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Class Year',
    'description' => 'An extension to manage a classroom.',
    'category' => 'plugin',
    'author' => 'Jon Echeveste',
    'author_company' => 'Ovan',
    'author_email' => 'j.echeveste-gonzalez@ovan.de',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
        ],
    ],
];