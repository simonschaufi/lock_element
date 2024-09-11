<?php

defined('TYPO3') or die();

use SimonSchaufi\LockElement\Hooks\DataHandler;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['lock_element'] =
    DataHandler::class;
