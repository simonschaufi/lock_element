<?php

defined('TYPO3') or die();

use SimonSchaufi\LockElement\Form\Element\ChristmasCampaignElement;
use SimonSchaufi\LockElement\Form\Element\DonationElement;
use SimonSchaufi\LockElement\Hooks\DataHandler;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['lock_element'] =
    DataHandler::class;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1576280585] = [
    'nodeName' => 'christmasCampaignElement',
    'priority' => 40,
    'class' => ChristmasCampaignElement::class,
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1576280586] = [
    'nodeName' => 'donationElement',
    'priority' => 40,
    'class' => DonationElement::class,
];
