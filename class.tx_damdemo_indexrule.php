<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2003-2005 René Fritz (r.fritz@colorcube.de)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
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
 * Index rule plugin for the DAM.
 * Part of the DAM (digital asset management) extension.
 *
 * @author	René Fritz <r.fritz@colorcube.de>
 * @package TYPO3
 * @subpackage tx_damdemo
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 */

require_once(t3lib_extMgm::extPath('dam').'lib/class.tx_dam_indexrulebase.php');

/**
 * Index rule plugin for the DAM
 * Demo
 *
 * @author	René Fritz <r.fritz@colorcube.de>
 * @package TYPO3
 * @subpackage tx_dam
 */
class tx_damdemo_indexRule extends tx_dam_indexRuleBase {
	
	var $setup = array();

	function getTitle()	{
		global $LANG;
		return $LANG->sL('LLL:EXT:dam_demo/locallang_indexrules.php:title');
	}

	function getDescription()	{
		global $LANG;
		return $LANG->sL('LLL:EXT:dam_demo/locallang_indexrules.php:desc');
	}

	function getOptionsForm()	{
		global $LANG, $SOBE;

		$code = array();
		$code[1][1] = 	'<input type="hidden" name="data[rules][tx_damdemo_indexRule][option1]" value="0" />'.
						'<input type="checkbox" name="data[rules][tx_damdemo_indexRule][option1]"'.($this->setup['option1']?' checked="checked"':'').' value="1" />&nbsp;';
		$code[1][2] = $LANG->sL('LLL:EXT:dam_demo/locallang_indexrules.php:option1');
		return $SOBE->doc->table($code);
	}

	function getOptionsInfo()	{
		global $LANG;
		if($this->setup['option1']) {
			$out .= $LANG->sL('LLL:EXT:dam_demo/locallang_indexrules.php:option1');
		}
		return $out;
	}

	function processMeta($meta)	{

		$meta['fields']['title']=strtoupper($meta['fields']['title']);
		if($this->setup['option1']) {
			// do some extra stuff
		}
		
		return $meta;
	}

}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/class.tx_damdemo_indexrule.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/class.tx_damdemo_indexrule.php']);
}
?>
