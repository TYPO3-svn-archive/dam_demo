<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	//
	// add custom fields to tx_dam
	//

$tempColumns = array(
	'tx_damdemo_info' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:dam_demo/fields/locallang_db.xml:tx_dam.tx_damdemo_info',
		'config' => array(
			'type' => 'input',
			'size' => '30',
		)
	),
	'tx_damdemo_customcategory' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:dam_demo/fields/locallang_db.xml:tx_dam.tx_damdemo_customcategory',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('', '0'),
				array('LLL:EXT:dam_demo/fields/locallang_db.xml:tx_dam.tx_damdemo_customcategory.I.0', '1'),
				array('LLL:EXT:dam_demo/fields/locallang_db.xml:tx_dam.tx_damdemo_customcategory.I.1', '2'),
				array('LLL:EXT:dam_demo/fields/locallang_db.xml:tx_dam.tx_damdemo_customcategory.I.2', '3'),
				array('LLL:EXT:dam_demo/fields/locallang_db.xml:tx_dam.tx_damdemo_customcategory.I.3', '4'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
);


t3lib_div::loadTCA('tx_dam');
t3lib_extMgm::addTCAcolumns('tx_dam',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tx_dam', '--div--;LLL:EXT:dam/locallang_db.xml:tx_dam_item.div_custom, tx_damdemo_info;;;;1-1-1, tx_damdemo_customcategory');

	// add fields to index preset fields
$TCA['tx_dam']['txdamInterface']['index_fieldList'] .= ',tx_damdemo_info,tx_damdemo_customcategory';


?>