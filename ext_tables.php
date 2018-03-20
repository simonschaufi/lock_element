<?php
defined('TYPO3_MODE') or die();

$tempColumns = [
    'tx_lockelement_locked' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:lock_element/locallang_db.xml:tt_content.tx_lockelement_locked',
        'config' => [
            'type' => 'check',
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'tx_lockelement_locked;;;;1-1-1');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'tx_lockelement_locked;;;;1-1-1');
