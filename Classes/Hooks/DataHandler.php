<?php

declare(strict_types=1);

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
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj : page Object reference
     *
     * @see \TYPO3\CMS\Core\DataHandling\DataHandler::process_cmdmap
     */
    public function processCmdmap_preProcess(string &$command, string $table, int $id, &$value, ParentDataHandler &$pObj)
    {
        if ($command == 'delete' && ($table == 'tt_content' || $table == 'pages')) {
            // look for lock
            $rec = BackendUtility::getRecord($table, $id, 'tx_lockelement_locked');
            if ($rec['tx_lockelement_locked']) {
                // remove delete command
                $command = '';
            }
        }
    }
}
