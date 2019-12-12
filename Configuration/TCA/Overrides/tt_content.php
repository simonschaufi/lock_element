<?php

$fields = [
    'tx_lockelement_locked' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:tt_content.tx_lockelement_locked',
        'config' => [
            'type' => 'check',
        ]
    ],
    'tx_lockelement_donate' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:tt_content.tx_lockelement_donate',
        'config' => [
            'type' => 'user',
            'userFunc' => \SimonSchaufi\LockElement\UserFunction\TCA::class . '->donateField',
            'parameters' => []
        ]
    ],
    'tx_lockelement_christmas_campaign' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:tt_content.tx_lockelement_christmas_campaign',
        'config' => [
            'type' => 'user',
            'userFunc' => \SimonSchaufi\LockElement\UserFunction\TCA::class . '->christmasCampaign',
            'parameters' => []
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

// Create new palette
$GLOBALS['TCA']['tt_content']['palettes']['tx_lock_element'] = [
    'showitem' => 'tx_lockelement_locked, tx_lockelement_donate'
];

// Add palette
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--palette--;LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:tt_content.palette_title;tx_lock_element'
);

// Add christmas campaign field
if (\SimonSchaufi\LockElement\UserFunction\TCA::showChristmasCampaign()) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        'tx_lockelement_christmas_campaign',
        '',
        'after:header'
    );
}
