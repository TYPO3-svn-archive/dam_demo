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
 * Demo metaExtract service
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 */


require_once(PATH_t3lib.'class.t3lib_svbase.php');

class tx_damdemo_sv1 extends t3lib_svbase {
	var $prefixId = 'tx_damdemo_sv1';		// Same as class name
	var $scriptRelPath = 'sv1/class.tx_damdemo_sv1.php';	// Path to this script relative to the extension dir.
	var $extKey = 'damdemo';	// The extension key.


	/**
	 * performs the service processing
	 *
	 * @param	string 	Content which should be processed.
	 * @param	string 	Content type
	 * @param	array 	Configuration array
	 * @return	boolean
	 */
	function process($content='', $type='', $conf=array())	{


			// this is to create dummy data - in normal services this is of course not the case
			// so if you use this service as template just delete the line and the function _setTestFileContent()
		$content = $this->_createTestFileContent();



		$this->conf = $conf;

		$this->out = array();
		$this->out['fields'] = array();

		if ($content) {
			$this->setInput ($content, $type);
		}

		if($input = $this->getInput()) {

				// we know the format of the file - it's line based
			$input = explode("\n", $input);

			foreach ($input as $line) {

				list($name,$value) = t3lib_div::trimExplode(':', $line);

				if ($value) { // ignore empty lines headers and emtpy entries

					switch ($name) {
						case 'title':
							$this->out['fields']['title'] = $value;
						break;
						case 'content':
								// A text excerpt can be added which means later textExtract service will be skipped
							$this->out['textExtract'] = $value;
						break;
					}
				}
			}

			$this->postProcess();

		} else {
			$this->errorPush(T3_ERR_SV_NO_INPUT, 'No or empty input.');
		}

		return $this->getLastError();
	}


	/**
	 * processing of values
	 * eg. charset conversion
	 */
	function postProcess () {
		global $TYPO3_CONF_VARS;
		

		$csConvObj = t3lib_div::makeInstance('t3lib_cs');

			// we assume that the file meta data is encoded in iso-8859-1
		$csConvObj->convArray($this->out['fields'], 'iso-8859-1', $this->conf['wantedCharset']);
		$this->out['textExtract'] = $csConvObj->conv($this->out['textExtract'], 'iso-8859-1', $this->conf['wantedCharset']);
	}







	/**
	 * this is to create dummy data - in normal services this is of course not the case
	 * so if you use this service as template just delete this function
	 */
	function _createTestFileContent() {
		return '
title:This is the title of this document
content:Miles Davis was one of the most influential and innovative musicians of the twentieth century. Davis was a jazz trumpeter, bandleader, and composer. Davis was at the forefront of almost every major development of jazz after the Second World War. He played on some of the important early bebop records, the first cool jazz records were recorded under his name, he was largely responsible for the development of modal jazz, and jazz fusion arose from Davis\'s bands of the late sixties and early seventies and the musicians who worked with him. Davis was in a line of jazz trumpeters that started with Buddy Bolden and ran through Joe "King" Oliver, Louis Armstrong, Roy Eldridge, and Dizzy Gillespie. Many of the major figures in postwar jazz played in one of Davis\'s groups at some point in their career. Some authorities consider Davis to have been the first person really to understand the difference between live and recorded music.
		';
	}

}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/sv1/class.tx_damdemo_sv1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/sv1/class.tx_damdemo_sv1.php']);
}

?>
