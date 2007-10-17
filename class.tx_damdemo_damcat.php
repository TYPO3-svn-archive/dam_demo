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
 * Demo selection rule plugin for the DAM.
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


require_once(PATH_txdam.'lib/class.tx_dam_selprocbase.php');



/**
 * Data API class
 *
 * @author	Kasper Skårhøj <kasper@typo3.com>
 * @package TYPO3
 * @subpackage tx_damdemo
 */
class tx_damdemo_damcat extends tx_dam_selProcBase {

	function tx_damdemo_damcat()	{
		global $BACK_PATH;

		$this->isPureSelectionClass = FALSE;
		$this->isTreeViewClass = FALSE;

		$this->title='Demo tree';
		$this->treeName='txdamdemodamcat';
		$this->domIdPrefix = $this->treeName;

		$this->iconName = 'icon_cat.gif';
		$this->iconPath = $BACK_PATH.t3lib_extMgm::extRelPath('dam_demo');
	}


	/**
	 * Returns an array that can be browsed by the treebrowse-class
	 *
	 * @return  array       Multidimensional.
	 */
	function getTreeArray()	{
/*
		$tree = array (
			'brands' => array (
				'title' => 'BRANDS',
				'id' => 'brands',
				'_SUB_LEVEL' => array (
					'brands-brand:Yoella' => array (
						 'title' => 'Yoella',
						 'id' => 'brand:Yoella',
					),
						'brands-brand:Boella' => array (
						'title' => 'Boella',
						'id' => 'brand:Boella',
					),
					'brands-brand:Wulla' => array (
						'title' => 'Wulla Version 5 Release 11 ',
						'id' => 'brand:Wulla',
						'_SUB_LEVEL' => array (
							'brands-dom:Equipment Systems Engineering' => array (
								'title' => 'Equipment Systems Engineering',
								'id' => 'dom:Equipment Systems Engineering',
							),
							'brands-dom:Mechanical Design' => array (
								'title' => 'Mechanical Design',
								'id' => 'dom:Mechanical Design',
							),
							'brands-dom:Product Synthesis' => array (
								'title' => 'Product Synthesis',
								'id' => 'dom:Product Synthesis',
							),
							'brands-dom:Shape Design Styling' => array (
								'title' => 'Shape Design Styling',
								'id' => 'dom:Shape Design Styling',
							),
							'brands-dom:Analysis' => array (
								'title' => 'Analysis',
								'id' => 'dom:Analysis',
							),
						),
					),
				),
			),
		);
*/

		$tree = array (

			'1' => array (
				'title' => 'bad',
				'id' => '1',
			),
			'2' => array (
				'title' => 'medium',
				'id' => '2',
			),
			'3' => array (
				'title' => 'good',
				'id' => '3',
			),
			'4' => array (
				'title' => 'great',
				'id' => '4',
			),
		);

		return $tree;
	}


	/**
	 * Returns the title of an item
	 *
	 * @return  string
	 */
	function dam_itemTitle($id)	{
		$itemTitle = $id;
		return $itemTitle;
	}

	/**
	 * Function, processing the query part for selecting/filtering records in DAM
	 * Called from DAM
	 *
	 * @param   string            Query type: AND, OR, ...
	 * @param   string            Operator, eg. '!=' - see DAM Documentation
	 * @param   string            Category - corresponds to the "treename" used for the category tree in the nav. frame
	 * @param   string            The select value/id
	 * @param   string            The select value (true/false,...)
	 * @param   object            Reference to the parent DAM object.
	 * @return  string
	 * @see tx_dam_SCbase::getWhereClausePart()
	 */
	function dam_selectProc($queryType, $operator, $cat, $id, $value, &$damObj)      {

		$query= 'tx_dam.tx_damdemo_customcategory';
		if($operator=='!=') {
			$query.= ' NOT';
		}
		$query.= " LIKE BINARY '".$id."'";

		return array($queryType,$query);
	}

}





if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/class.tx_damdemo_damcat.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_demo/class.tx_damdemo_damcat.php']);
}
?>
