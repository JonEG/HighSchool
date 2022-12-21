<?php
defined('TYPO3_MODE') || die('Access denied.');

//? Set plugin controller and actions
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'StudentList',
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'list',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'list',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'OvanGmbh.ClassYear',
    'ClassmatesList',
    [
        'Main' => 'classmates',
    ],
    // non-cacheable actions
    [
        'Main' => 'classmates',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'SubjectsList',
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'subjects',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\MainController::class => 'subjects',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'ExamsCRUD',
    [
        \OvanGmbh\ClassYear\Controller\ExamController::class => 'list, form, create, edit',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\ExamController::class => 'list, form, create, edit',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'ClassYear',
    'JsonPlugin',
    [
        \OvanGmbh\ClassYear\Controller\JsonController::class => 'listClassrooms, showClassroom',
    ],
    // non-cacheable actions
    [
        \OvanGmbh\ClassYear\Controller\JsonController::class => 'listClassrooms, showClassroom',
    ]
);

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'mod-highschool',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => 'EXT:classyear/Resources/Public/Icons/Extension.png']
);

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'tt-random-image-icon',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => 'EXT:classyear/Resources/Public/Icons/Homero.png']
);


//? hooks 
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['extkey'] = \OvanGmbh\ClassYear\Hook\TCEmainHook::class;
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['extkey'] = \OvanGmbh\ClassYear\Hook\TCEmainHook::class;


// //? Always include Random classyear_randomimage content element in the backoffice
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfigFile(
//     '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sitepackage/Configuration/TSConfig/Page/Mod/Wizards/RandomImageContentElement.tsconfig">'
// );

//? Create a custom cache
$conf = 'cacheConfigurations';
$ext = 'classyear';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching'][$conf][$ext] ??= [];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching'][$conf][$ext]['frontend'] ??= 
\TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching'][$conf][$ext]['backend'] ??= 
\TYPO3\CMS\Core\Cache\Backend\Typo3DatabaseBackend::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching'][$conf][$ext]['options'] ??= 
['defaultLifetime' => 0];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching'][$conf][$ext]['groups'] ??= 
['pages'];
