<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007 Kraft Bernhard (kraftb@kraftb.at)
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
/**
 * BE/FE Abstraction class for static calling via scope (::) operator
 *
 * $Id$
 *
 * @author	Kraft Bernhard <kraftb@kraftb.at>
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */


class tx_kbpageicon_t3libtcemain	{

	function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, &$pObj)	{
		if ($table=='pages')	{
			if (isset($fieldArray['tx_kbpageicon_pticon']))	{
				if ($fieldArray['tx_kbpageicon_pticon'])	{
					$fieldArray['module'] = 'ICON:'.$fieldArray['tx_kbpageicon_pticon'];
				} else	{
					$fieldArray['module'] = '';
				}
				$cacheFile = t3lib_extMgm::extPath('kb_page_icon', 'iconListCache.ser');
				@unlink($cacheFile);
			}
		}	
	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/kb_page_icon/class.tx_kbpageicon_t3lib_tcemain.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/kb_page_icon/class.tx_kbpageicon_t3lib_tcemain.php']);
}

?>
