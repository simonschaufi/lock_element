<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_lockelement_locked' => array (		
		'exclude' => 1,		
		'label' => 'LLL:EXT:lock_element/locallang_db.xml:tt_content.tx_lockelement_locked',
		'config' => array (
			'type' => 'check',
		)
	),
);


t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tt_content','tx_lockelement_locked;;;;1-1-1');

t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('pages','tx_lockelement_locked;;;;1-1-1');

require_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_lockelements.php');
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] = 'tx_lockelements';
?>