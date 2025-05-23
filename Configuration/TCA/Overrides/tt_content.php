<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * (c) Simon Schaufelberger
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$fields = [
    'tx_lockelement_locked' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:tt_content.tx_lockelement_locked',
        'config' => [
            'type' => 'check',
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

// Create new palette
$GLOBALS['TCA']['tt_content']['palettes']['tx_lock_element'] = [
    'showitem' => 'tx_lockelement_locked',
];

// Add palette
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--palette--;LLL:EXT:lock_element/Resources/Private/Language/locallang_db.xlf:tt_content.palette_title;tx_lock_element'
);
