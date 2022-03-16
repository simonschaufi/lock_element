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

namespace SimonSchaufi\LockElement\Hooks;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\DataHandling\DataHandler as ParentDataHandler;

class DataHandler
{
    /**
     * processCmdmap_preProcess()
     * this function is called by the Hook in tce from \TYPO3\CMS\Core\DataHandling\DataHandler before processing commands
     *
     * @param string $command : reference to command: move,copy,version,delete or undelete
     * @param string $table : database table
     * @param int $id : database record uid
     * @param array $value : reference to command parameter array
     * @param ParentDataHandler $pObj : page Object reference
     *
     * @see \TYPO3\CMS\Core\DataHandling\DataHandler::process_cmdmap
     */
    public function processCmdmap_preProcess(string &$command, string $table, int $id, &$value, ParentDataHandler $pObj): void
    {
        if ($command === 'delete' && ($table === 'tt_content' || $table === 'pages')) {
            // look for lock
            $rec = BackendUtility::getRecord($table, $id, 'tx_lockelement_locked');
            if ($rec['tx_lockelement_locked']) {
                // remove delete command
                $command = '';
            }
        }
    }
}
