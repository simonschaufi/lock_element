<?php

namespace SimonSchaufi\LockElement;

use TYPO3\CMS\Backend\Utility\BackendUtility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008 Steffen Kamper <info@sk-typo3.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class DataHandler
{
    /**
     * processCmdmap_preProcess()
     * this function is called by the Hook in tce from class.t3lib_tcemain.php before processing commands
     *
     * @param string $command : reference to command: move,copy,version,delete or undelete
     * @param string $table : database table
     * @param int $id : database record uid
     * @param array $value : reference to command parameter array
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj : page Object reference
     *
     * @see \TYPO3\CMS\Core\DataHandling\DataHandler::process_cmdmap
     */
    public function processCmdmap_preProcess(string &$command, string $table, int $id, &$value, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj)
    {
        if ($command == 'delete' && ($table == 'tt_content' || $table == 'pages')) {
            //look for lock
            $rec = BackendUtility::getRecord($table, $id, 'tx_lockelement_locked');
            if ($rec['tx_lockelement_locked']) {
                //remove delete command
                $command = '';
            }
        }
    }
}
