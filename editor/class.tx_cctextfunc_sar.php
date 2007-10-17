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
 * Module extension (addition to function menu) 'Text tools' for the 'cc_textfunc' extension.
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 */


require_once (PATH_t3lib.'class.t3lib_tcemain.php');


if(!function_exists('str_ireplace')) {
	function str_ireplace($sword, $replace, $value) {
		return eregi_replace(quotemeta($sword), $replace, $value);
	}
}

/**
 * class 'Search and replace' for the 'cc_textfunc' extension.
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 * @package TYPO3
 * @subpackage tx_cctextfunc
 */
class tx_cctextfunc_sar {

	/**
	 * If set the character case will be ignored
	 */
	var $ignoreCase;

	/**
	 * Perform search and replace with regular expression if set
	 */	
	var $useRegex;

	/**
	 * The database table
	 */	
	var $table = '';

	/**
	 * Array with columns names that should be used for search and replace
	 */
	var $contentColumns = array();


	/**
	 * for testing ...
	 */
	var $dryRun = false;


	/*************************
	 *
	 * SETUP
	 *
	 *************************/

	/**
	 * Set the current table and the columns that should be used for search and replace
	 * 
	 * @param string $table The database table
	 * @param array $contentColumns Array with columns names
	 * @return void
	 */
	function setTable($table, $contentColumns) {
		$this->table = $table;
		$this->contentColumns = $contentColumns;
	}

	/**
	 * Set options for processing. Use regex or not, ignore case or not
	 * 
	 * @param boolean $useRegex Perform search and replace with regular expression if set
	 * @param boolean $ignoreCase If set the character case will be ignored
	 * @return void
	 */
	function setOptions($useRegex, $ignoreCase) {
		$this->useRegex = $useRegex;
		$this->ignoreCase = $ignoreCase;
	}


	/*************************
	 *
	 * PROCESSING
	 *
	 *************************/


	/**
	 * Search and replace strings in content of a record array
	 * 
	 * @param array $row Content to process
	 * @param string $sword Search word
	 * @param string $replace Replace string
	 * @return integer Number of changed record fields
	 */
	function replaceTextInFields($row, $sword, $replace) {
		global $TCA, $BE_USER;

		$uid = $row['uid'];

		$changedFields = array();

		foreach($row as $field => $fieldValue)	{
			if ($this->isContentColumn($field) AND $fieldValue) {
				$fieldValueNew = $this->replaceText($fieldValue, $sword, $replace);
				if (!($fieldValueNew===NULL)) {
					$changedFields[$field] = $fieldValueNew;
				}
			}
		}

		if (count($changedFields)) {
			if($this->dryRun) {
				debug($row);
				debug($changedFields, 'changed fields');
			} else {
				$tce = t3lib_div::makeInstance('t3lib_TCEmain');
				$tce->stripslashes_values = false;
				$TCAdefaultOverride = $BE_USER->getTSConfigProp('TCAdefaults');
				if (is_array($TCAdefaultOverride))	{
					$tce->setDefaultsFromUserTS($TCAdefaultOverride);
				}
				$tce->start(array($this->table=>array($uid=>$changedFields)),array());
				$tce->process_datamap();
			}
		}

		return count($changedFields);
	}



	/**
	 * Search and replace strings in content
	 * 
	 * @param string $content Content to process
	 * @param string $sword Search word
	 * @param string $replace Replace string
	 * @return string processed content of false if nothing was done
	 */
	function replaceText($content, $sword, $replace) {
		$replaced = NULL;

		if ($content) {
			if ($this->useRegex) {
				$swordEreg = $this->convertBackslashedToClass($sword);
				$replaceEreg = $this->convertBackslashedToRealChar($replace);
				if ($this->ignoreCase) {
					if (eregi($swordEreg, $content)) {
						$replaced = eregi_replace($swordEreg, $replaceEreg, $content);
					}
				} else {
					if (ereg($swordEreg, $content)) {
						$replaced = ereg_replace($swordEreg, $replaceEreg, $content);
					}
				}
			} else {
				if ($this->ignoreCase) {
					if (stristr($content, $sword)) {
						$replaced = str_ireplace($sword, $replace, $content);
					}
				} else {
					if (strstr($content, $sword)) {
						$replaced = str_replace($sword, $replace, $content);
					}
				}
			}
		}

		return $replaced;
	}




	/*************************
	 *
	 * SQL
	 *
	 *************************/


	/**
	 * Compiles and returns a search query clause
	 * 
	 * @param array $searchWords Array with search words
	 * @return string search clause
	 */
	function getSearchClause ($searchWords)	{

		$queryParts = array();
		foreach($searchWords as $sw)	{
			if ($this->useRegex) {
				$sw = $this->convertBackslashedToClass($sw);
				$sw = $GLOBALS['TYPO3_DB']->fullQuoteStr($sw, $this->table);
				if ($this->ignoreCase) {
					$like = ' REGEXP '.$sw;
				} else {
					$like = ' REGEXP BINARY '.$sw;
				}
			} else {
				$sw = $this->quoteForLike($sw);
				$sw = $GLOBALS['TYPO3_DB']->fullQuoteStr('%'.$sw.'%', $this->table);
				if ($this->ignoreCase) {
					$like = ' LIKE '.$sw;
				} else {
					$like = ' LIKE BINARY '.$sw;
				}
			}
			$queryParts[] = implode($like.' OR ', $this->contentColumns).$like;
		}
		return '('.implode(') AND (', $queryParts).')';
	}




	/*************************
	 *
	 * OUTPUT
	 *
	 *************************/


	/**
	 * Mark/Emphasize search and replace strings in content for HTML display
	 * 
	 * @param string $content Content to process
	 * @param string $sword Search word
	 * @param string $replace Replace string or false if a replace shouldn't be happen
	 * @return string processed content
	 */
	function markContentForDisplay($content, $sword, $replace=false) {
		$out = '';

			// regex
		if ($this->useRegex) {

			$swordEreg = $this->convertBackslashedToClass($sword);
			$replaceEreg = $this->convertBackslashedToRealChar($replace);

			if ($this->ignoreCase) {
				if (eregi($swordEreg, $content)) {
					$out = eregi_replace('('.$swordEreg.')', '###tx_cctextfunc-SPAN_RED###\\1###tx_cctextfunc-SPAN_END###', $content);
					if (!($replace===false)) {
						$out.= '###tx_cctextfunc-SPLIT###'.eregi_replace($swordEreg,'###tx_cctextfunc-SPAN_GREEN###'.$replaceEreg.'###tx_cctextfunc-SPAN_END###', $content);
					}
				} else {
					$out = $content;
				}
			} else {
				if (ereg($swordEreg, $content)) {
					$out = ereg_replace('('.$swordEreg.')', '###tx_cctextfunc-SPAN_RED###\\1###tx_cctextfunc-SPAN_END###', $content);
					if (!($replace===false)) {
						$out.= '###tx_cctextfunc-SPLIT###'.ereg_replace($swordEreg,'###tx_cctextfunc-SPAN_GREEN###'.$replaceEreg.'###tx_cctextfunc-SPAN_END###', $content);
					}
				} else {
					$out = $content;
				}

			}

			// str_replace
		} else {
			if ($this->ignoreCase) {
				if (stristr($content, $sword)) {
					$out = eregi_replace('('.quotemeta($sword).')', '###tx_cctextfunc-SPAN_RED###\\1###tx_cctextfunc-SPAN_END###', $content);
					if (!($replace===false)) {
						 $out.= '###tx_cctextfunc-SPLIT###'.str_ireplace($sword,'###tx_cctextfunc-SPAN_GREEN###'.$replace.'###tx_cctextfunc-SPAN_END###', $content);
					}
				} else {
					$out = $content;
				}

			} else {
				if (strstr($content, $sword)) {
					$out = str_replace($sword, '###tx_cctextfunc-SPAN_RED###'.$sword.'###tx_cctextfunc-SPAN_END###', $content);
					if (!($replace===false)) {
						$out.= '###tx_cctextfunc-SPLIT###'.str_replace($sword,'###tx_cctextfunc-SPAN_GREEN###'.$replace.'###tx_cctextfunc-SPAN_END###', $content);
					}
				} else {
					$out = $content;
				}
			}
		}

		$out = htmlspecialchars($out);

		$trans = array(
						'###tx_cctextfunc-SPAN_RED###' => '<span class="bgColor-10" style="color:red;font-weight:bold;">',
						'###tx_cctextfunc-SPAN_GREEN###' => '<span class="bgColor-10" style="color:green;font-weight:bold;">',
						'###tx_cctextfunc-SPAN_END###' => '</span>',
						'###tx_cctextfunc-SPLIT###' => '<hr>',
						"\t" => '&nbsp;&rarr;&nbsp;',
						'  ' => '&nbsp;&nbsp;',
						"\n" => "&para;<br />\n",
						);
		$out = strtr($out, $trans);

		return $out;
	}




	/*************************
	 *
	 * TOOLS, content
	 *
	 *************************/


	/**
	 * This removes fields like uid and pid from a row and returns content fields only.
	 * 
	 * @param array $row Array with field => value
	 * @return array processed row
	 */
	function getContentColumns($row) {
		foreach ($row as $field => $dummy) {
			if(!$this->isContentColumn($field)) {
				unset($row[$field]);
			}
		}
		return $row;
	}


	/**
	 * This checks if a field is a content column
	 * 
	 * @param string $field field name 
	 * @return boolean true if field is content column
	 */
	function isContentColumn($field) {
		return in_array($field, $this->contentColumns);
	}


	/**
	 * This will remove HTML tags and will also convert some
	 * common HTML entities to their text equivalent.
	 * 
	 * @param string $content HTML content to process
	 * @return string processed content
	 */
	function removeHTML($content)	{
		global $LANG;

		$content = strip_tags($content);
		if(function_exists('html_entity_decode')) {
			$content = html_entity_decode($content, ENT_QUOTES, $LANG->charSet);
		} else {
			$content = strtr($content, array_flip(get_html_translation_table(HTML_ENTITIES)));
		}
		return $content;
	}




	/*************************
	 *
	 * TOOLS, SQL/Regex
	 *
	 *************************/


	/**
	 * This will convert the strings \n \r \t to real newlines and tabs
	 * 
	 * @param string $content content to process
	 * @return string processed content
	 */
	function convertBackslashedToRealChar($content) {
		$content = str_replace('\n',"\n", $content);
		$content = str_replace('\r',"\r", $content);
		$content = str_replace('\t',"\t", $content);
		return $content;
	}


	/**
	 * This will convert backslashed regex shortcuts to character classes
	 * 
	 * @param string $content content to process
	 * @return string processed content
	 */
	function convertBackslashedToClass($content) {
		$content = $this->convertBackslashedToRealChar($content);
		$content = str_replace('\d','[[:digit:]]', $content);
		$content = str_replace('\D','[^[:digit:]]', $content);
		$content = str_replace('\w','[[:alnum:]]', $content);
		$content = str_replace('\W','[^[:alnum:]]', $content);
		$content = str_replace('\s','[[:blank:]]', $content);
		$content = str_replace('\S','[^[:blank:]]', $content);
		return $content;
	}


	/**
	 * This will add slashed to a string for usage with LIKE in SQL
	 * 
	 * @param string $content content to process
	 * @return string processed content
	 */	
	function quoteForLike ($content) {
		$trans = array(
						'\\' => '\\\\',
						'%' => '\\%',
						'_' => '\\_',
						);
		$content = strtr($content, $trans);
		return $content;
	}
}





if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cc_textfunc/class.tx_cctextfunc_sar.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cc_textfunc/class.tx_cctextfunc_sar.php']);
}

?>