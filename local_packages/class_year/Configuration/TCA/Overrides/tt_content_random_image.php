<?php

//? New Content element Type
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'Random Image', //label 
        'classyear_randomimage', //content element key
        'tt-random-image-icon' //icon identifier
    ],
    'textmedia',
    'after'
);

//? Include static file for classyear_randomimage content element in the backoffice
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'classyear',
    'Configuration/TSConfig/Page/Mod/Wizards/NewContentElement.tsconfig',
    'TT Random Image'
);

//? add content element to tca
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
    'tx_classyear_random_image_url' => [
        'exclude' => 1,
        'label' => 'Custom random image url',
        'config' => [
            'type' => 'input',
            'renderType' => 'inputLink',
            'default' => 'https://random.imagecdn.app/__height__/__width__',
        ],
    ],
]);

//? Configure classyear_randomimage backend fields.
$GLOBALS['TCA']['tt_content']['types']['classyear_randomimage'] = [
    'showitem' => '
         --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;random_image,
         --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
    ',
    'columnsOverrides' => [
        'imageheight' => [
            'config' => [
                'default' => 500,
            ],
        ],
        'imagewidth' => [
            'config' => [
                'default' => 500,
            ],
        ],
    ],
];

//? Custom palette
$GLOBALS['TCA']['tt_content']['palettes']['random_image'] = [
    'label' => 'Image Settings',
    'showitem' => '
        tx_classyear_random_image_url;Random Image,
        --linebreak--,
        imageheight; Height,
        --linebreak--,
        imagewidth; Width,
    '
];