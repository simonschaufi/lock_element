<?php

// Add christmas campaign field
if (\SimonSchaufi\LockElement\UserFunction\TCA::showChristmasCampaign()) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages',
        'tx_lockelement_christmas_campaign',
        '',
        'after:title'
    );
}

// Add christmas campaign field
if (\SimonSchaufi\LockElement\UserFunction\TCA::showChristmasCampaign()) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        'tx_lockelement_christmas_campaign',
        '',
        'after:header'
    );
}
