<?php

defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['lock_element'] =
    \SimonSchaufi\LockElement\Hooks\DataHandler::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1576280585] = [
    'nodeName' => 'christmasCampaignElement',
    'priority' => 40,
    'class' => \SimonSchaufi\LockElement\Form\Element\ChristmasCampaignElement::class,
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1576280586] = [
    'nodeName' => 'donationElement',
    'priority' => 40,
    'class' => \SimonSchaufi\LockElement\Form\Element\DonationElement::class,
];
