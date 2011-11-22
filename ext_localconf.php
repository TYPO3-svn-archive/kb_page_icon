<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:kb_page_icon/class.tx_kbpageicon_t3libtcemain.php:&tx_kbpageicon_t3libtcemain';

?>
