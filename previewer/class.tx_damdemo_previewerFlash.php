<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2003-2006 Rene Fritz (r.fritz@colorcube.de)
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
 *   58: class tx_damdemo_previewerFlash extends tx_dam_previewerProcBase
 *   69:     function isValid($row, $size, $type, $conf=array())
 *   90:     function render($row, $size, $type, $conf=array())
 *
 * TOTAL FUNCTIONS: 2
 * (This index is automatically created/updated by the script "update-class-index")
 *
 */


require_once(PATH_txdam.'lib/class.tx_dam_previewerprocbase.php');



/**
 * Contains a flash previewer.
 * Part of the DAM (digital asset management) extension.
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 * @package TYPO3
 * @subpackage tx_dam
 */
class tx_damdemo_previewerFlash extends tx_dam_previewerProcBase {

	/**
	 * Returns true if this previewer is able to render a preview for the given file
	 *
	 * @param	array		$row Meta data array
	 * @param	integer		$size The maximum size of the previewer
	 * @param	string		$type The wanted previewer type
	 * @param	array		$conf Additional configuration values. Might be empty.
	 * @return	boolean		True if this is the right previewer for the file
	 */
	function isValid($row, $size, $type, $conf=array()) {
		$valid = false;

		if ($row['file_type'] == 'swf'
			AND $size == '200') {
			 $valid = true;
		}

		return $valid;
	}


	/**
	 * Returns rendered previewer for flash moview which means they are embeded
	 *
	 * @param	array		$row Meta data array
	 * @param	integer		$size The maximum size of the previewer
	 * @param	string		$type The wanted previewer type
	 * @param	array		$conf Additional configuration values. Might be empty.
	 * @return	array		True if this is the right previewer for the file
	 */
	function render($row, $size, $type, $conf=array()) {

		$outArr = array(
			'htmlCode' => '',
			'headerCode' => ''
			);

		$absFile = tx_dam::file_absolutePath($row['file_path'].$row['file_name']);
		$siteUrl = t3lib_div::getIndpEnv('TYPO3_SITE_URL');
		$fileRelPath = tx_dam::file_relativeSitePath($row['file_path'].$row['file_name']);
		$size = 'width="190" height="140"';

//  This could be enhanced with an onclick loader using javascript

		$outArr['htmlCode'] = '<div style="border:solid #888 1px;margin:0.5em;">
			<object type="application/x-shockwave-flash" data="'.htmlspecialchars($siteUrl.t3lib_div::rawUrlEncodeFP($fileRelPath)).'" '.$size.'>
			<param name="movie" value="'.htmlspecialchars($siteUrl.t3lib_div::rawUrlEncodeFP($fileRelPath)).'" />
			<param name="quality" value="high" />
			</object>
			</div>';


		return $outArr;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/previewer/class.tx_damdemo_previewerFlash.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/previewer/class.tx_damdemo_previewerFlash.php']);
}
?>