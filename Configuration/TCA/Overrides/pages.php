<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$fields = [
    'tx_lockelement_locked' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:tt_content.tx_lockelement_locked',
        'config' => [
            'type' => 'check',
        ]
    ],
];

ExtensionManagementUtility::addTCAcolumns('pages', $fields);

// Create new palette
$GLOBALS['TCA']['pages']['palettes']['tx_lock_element'] = [
    'showitem' => 'tx_lockelement_locked',
];

// Add palette
ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    '--palette--;LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:pages.palette_title;tx_lock_element'
);
