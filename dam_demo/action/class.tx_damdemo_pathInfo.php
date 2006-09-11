<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2003-2006 Rene Fritz (r.fritz@colorcube.de)
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
 * Part of the DAM (digital asset management) extension.
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 * @package TYPO3
 * @subpackage tx_dam
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   64: class tx_damdemo_pathInfo extends tx_dam_actionbase
 *   84:     function isPossiblyValid ($type, $itemInfo=NULL, $env=NULL)
 *   99:     function isValid ($type, $itemInfo=NULL, $env=NULL)
 *  112:     function getWantedDivider ($type)
 *  123:     function getIcon ($addAttribute='')
 *  133:     function getLabel ()
 *  142:     function getDescription ()
 *  152:     function _getCommand()
 *
 * TOTAL FUNCTIONS: 7
 * (This index is automatically created/updated by the script "update-class-index")
 *
 */



require_once (PATH_txdam.'lib/class.tx_dam_actionbase.php');



/**
 * Demo action rendering an info button for paths
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 * @package TYPO3
 * @subpackage tx_dam
 * @see tx_dam_actionbase
 */
class tx_damdemo_pathInfo extends tx_dam_actionbase {


	/**
	 * Defines the types that the object can render
	 * @var array
	 */
	var $typesAvailable = array('icon', 'button');

	/**
	 * Returns true if the action is of the wanted type
	 * This method should return true if the action is possibly true.
	 * This could be the case when a control is wanted for a list of files and in beforhand a check should be done which controls might be work.
	 * In a second step each file is checked with isValid().
	 *
	 * @param	string		$type Action type
	 * @param	array		$itemInfo Item info array. Eg pathInfo, meta data array
	 * @param	array		$env Environment array. Can be set with setEnv() too.
	 * @return	boolean
	 */
	function isPossiblyValid ($type, $itemInfo=NULL, $env=NULL) {
		if ($valid = $this->isTypeValid ($type, $itemInfo, $env)) {
			$valid = ($this->itemInfo['__type'] == 'dir');
		}
		return $valid;
	}

	/**
	 * Returns true if the action is of the wanted type
	 *
	 * @param	string		$type Action type
	 * @param	array		$itemInfo Item info array. Eg pathInfo, meta data array
	 * @param	array		$env Environment array. Can be set with setEnv() too.
	 * @return	boolean
	 */
	function isValid ($type, $itemInfo=NULL, $env=NULL) {
		if ($valid = $this->isTypeValid ($type, $itemInfo, $env)) {
			$valid = ($this->itemInfo['__type'] == 'dir');
		}
		return $valid;
	}

	/**
	 * Tells if a spacer/margin is wanted before/after the action
	 *
	 * @param	string		$type Says what type of action is wanted
	 * @return	string		Example: "divider:spacer". Divider before and spacer after
	 */
	function getWantedDivider ($type) {
		return 'divider:';
	}

	/**
	 * Returns the icon image tag.
	 * Additional attributes to the image tagcan be added.
	 *
	 * @param	string $addAttribute Additional attributes
	 * @return string
	 */
	function getIcon ($addAttribute='') {
		$icon =	'<img'.t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'],'gfx/info.gif','width="17" height="12"').$this->_cleanAttribute($addAttribute).' alt="" />';
		return $icon;
	}

	/**
	 * Returns the short label like: Delete
	 *
	 * @return string
	 */
	function getLabel () {
		return $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.xml:cm.info');
	}

	/**
	 * Returns a short description for tooltips for example like: Delete folder recursivley
	 *
	 * @return string
	 */
	function getDescription () {
		return $GLOBALS['LANG']->sL('LLL:EXT:dam_demo/action/locallang_actions.xml:tx_damdemo_folderInfo');
	}


	/**
	 * Returns a command array for the current type
	 *
	 * @return array Command array
	 */
	function _getCommand() {
		$commands = parent::_getCommand();

		$commands['href'] = '#';

		$output = '';
		foreach ($this->itemInfo as $key => $value) {
			$output .= $key.': '.$value.'\\n';
		}

		$commands['aTagAttribute'] = 'onclick="alert(\''.htmlspecialchars($output).'\');return false;"';

		return $commands;
	}

}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/action/class.tx_damdemo_pathInfo.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/action/class.tx_damdemo_pathInfo.php']);
}

?>