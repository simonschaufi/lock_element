<?php

defined('TYPO3') or die();

use SimonSchaufi\LockElement\UserFunction\TCA;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Add christmas campaign field to pages
if (TCA::showChristmasCampaign()) {
    ExtensionManagementUtility::addToAllTCAtypes(
        'pages',
        'tx_lockelement_christmas_campaign',
        '',
        'after:title'
    );
}

// Add christmas campaign field to content elements
if (TCA::showChristmasCampaign()) {
    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        'tx_lockelement_christmas_campaign',
        '',
        'after:header'
    );
}
