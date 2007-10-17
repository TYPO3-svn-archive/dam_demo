<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 Rene Fritz <r.fritz@colorcube.de>
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
 * Command module 'edit text file'
 * Part of the DAM (digital asset management) extension.
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 * @package DAM-ModCmd
 * @subpackage Edit
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *
 * TOTAL FUNCTIONS: 5
 * (This index is automatically created/updated by the script "update-class-index")
 *
 */
require_once(PATH_txdam.'lib/class.tx_dam_guifunc.php');

require_once(PATH_txdam.'lib/class.tx_dam_editorbase.php');

$GLOBALS['LANG']->includeLLFile('EXT:dam_demo/editor/locallang.xml');

class tx_damdemo_searchreplace extends tx_dam_editorBase {


	/**
	 * Returns true if this editor is able to handle the given file
	 *
	 * @param	mixed		$media Media object or itemInfo array. Currently the function have to work with a media object or an itemInfo array.
	 * @param	array		$conf Additional configuration values. Might be empty.
	 * @return	boolean		True if this is the right editor for the file
	 */
	function isValid ($media, $conf=array()) {
		$file_type = is_object($media) ? $media->getType() : $media['file_type'];
		return t3lib_div::inList($GLOBALS['TYPO3_CONF_VARS']['SYS']['textfile_ext'], $file_type);
	}


	/**
	 * Returns the icon image tag.
	 * Additional attributes to the image tagcan be added.
	 *
	 * @param	string		$addAttribute Additional attributes
	 * @return	string
	 */
	function getIcon ($addAttribute='') {
		$iconFile = t3lib_extMgm::extRelPath('dam_demo').'editor/icon_searchreplace.gif';
		$icon = '<img'.t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'], $iconFile, 'width="16" height="12"').$this->_cleanAttribute($addAttribute).' alt="" />';

		return $icon;
	}


	/**
	 * Returns the short label like: Delete
	 *
	 * @return	string
	 */
	function getLabel () {
		return $GLOBALS['LANG']->getLL('tx_damdemo_searchreplace.title');
	}


	/**
	 * Returns a short description for tooltips for example like: Delete folder recursivley
	 *
	 * @return	string
	 */
	function getDescription () {
		return $GLOBALS['LANG']->getLL('tx_damdemo_searchreplace.descr');
	}






	/***************************************
	 *
	 *   Module
	 *
	 ***************************************/




	/**
	 * Do some init things
	 *
	 * @return	void
	 */
	function cmdInit() {
		$GLOBALS['SOBE']->templateClass = 'template';
		$GLOBALS['SOBE']->pageTitle = $this->getLabel();
	}


	/**
	 * Additional access check
	 *
	 * @return	boolean Return true if access is granted
	 */
	function accessCheck() {
		return tx_dam::access_checkFileOperation('editFile');
	}


	/**
	 * Do some init things and set some things in HTML header
	 *
	 * @return	void
	 */
	function head() {
	}


	/**
	 * Returns a help icon for context help
	 *
	 * @return	string HTML
	 */
	function getContextHelp() {
// todo csh
#		return t3lib_BEfunc::cshItem('xMOD_csh_corebe', 'file_rename', $GLOBALS['BACK_PATH'],'');
	}


	/**
	 * Main function, rendering the content of the rename form
	 *
	 * @return	void
	 */
	function main()	{
		global  $LANG;

		$content = '';

		if ((t3lib_div::_GP('save') OR t3lib_div::_GP('save_close')) AND is_array($this->pObj->data) AND isset($this->pObj->data['search'])) {

			require_once (t3lib_extMgm::extPath('dam_demo').'editor/class.tx_cctextfunc_sar.php');
			$sar = t3lib_div::makeInstance('tx_cctextfunc_sar');
			$fileContent = $sar->replaceText(t3lib_div::getURL($this->pObj->media->getPathAbsolute()), $this->pObj->data['search'], $this->pObj->data['replace']);

				// process conent update
			$error = tx_dam::process_editFile($this->pObj->media->getInfoArray(), $fileContent);

			if ($error) {
				$content .= $this->pObj->errorMessageBox ($error);

			} elseif (t3lib_div::_GP('save_close')) {
				$this->pObj->redirect(true);
				return;
			}
		}
		
		$content.= $this->renderForm(t3lib_div::getURL($this->pObj->media->getPathAbsolute()));

		return $content;
	}


	/**
	 * Making the form for create file
	 *
	 * @return	string		HTML content
	 */
	function renderForm($fileContent='')	{
		global $BE_USER, $LANG, $TYPO3_CONF_VARS;

		$content = '';
		$msg = array();

		$msg[] = tx_dam_guiFunc::getFolderInfoBar(tx_dam::path_compileInfo($this->pObj->media->pathAbsolute));
		$msg[] = '&nbsp;';

		$msg[] = $GLOBALS['LANG']->sL('LLL:EXT:dam/locallang_db.xml:tx_dam_item.file_name',1).' <strong>'.htmlspecialchars($this->pObj->media->filename).'</strong>';
		$msg[] = '&nbsp;';
		
		
		if ($this->pObj->data['search']) {
			require_once (t3lib_extMgm::extPath('dam_demo').'editor/class.tx_cctextfunc_sar.php');
			$sar = t3lib_div::makeInstance('tx_cctextfunc_sar');
			$fileContent = $sar->markContentForDisplay($fileContent, $this->pObj->data['search'], $this->pObj->data['replace']);
		} else {	
			
			$fileContent = htmlspecialchars($fileContent);
			
			$trans = array(
							"\t" => '&nbsp;&rarr;&nbsp;',
							'  ' => '&nbsp;&nbsp;',
							"\n" => "&para;<br />\n",
							);
			$fileContent = strtr($fileContent, $trans);			
		}
		
		
		$msg[] = '
			Search: <input type="text" name="data[search]" value="'.htmlspecialchars($this->pObj->data['search']).'" style="margin-right:2em;" />
			Replace: <input type="text" name="data[replace]" value="'.htmlspecialchars($this->pObj->data['replace']).'" style="margin-right:3em;" />
			<input type="submit" name="process" value="'.$GLOBALS['LANG']->getLL('labelCmdProcess',1).'" />';
			
		$msg[] = '&nbsp;';
		$msg[] = $GLOBALS['LANG']->getLL('tx_dam_cmd_filenew.text_content',1);		
		
		$divStyle = 'border:solid 1px #333; background-color: #eee; padding-left:3px;color:#111;';
		$msg[] = '<div style="'.htmlspecialchars($divStyle.' overflow:auto; width:99%; height:65%').'" >'.
					$fileContent.
					'</div>';


		$buttons = '
			<input type="submit" name="save" value="'.$GLOBALS['LANG']->getLL('labelCmdSave',1).'" />
			<input type="submit" name="save_close" value="'.$GLOBALS['LANG']->getLL('labelCmdSaveClose',1).'" />
			<input type="submit" value="'.$LANG->sL('LLL:EXT:lang/locallang_core.xml:labels.cancel',1).'" onclick="jumpBack(); return false;" />';


		$content .= $GLOBALS['SOBE']->getMessageBox ($GLOBALS['SOBE']->pageTitle, $msg, $buttons, 1);

		return $content;
	}

}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam/mod_edit/class.tx_dam_edit_text.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam/mod_edit/class.tx_dam_edit_text.php']);
}

?>