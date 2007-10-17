<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


if (TYPO3_MODE=='BE')	{
	
		// register navigation tree and select rule for nav tree. Id 'txdamdemodamcat' must not include '_'
	$TYPO3_CONF_VARS['EXTCONF']['dam']['selectionClasses']['txdamdemodamcat'] = 'EXT:dam_demo/class.tx_damdemo_damcat.php:&tx_damdemo_damcat';

	
		// custom index rule
	$TYPO3_CONF_VARS['EXTCONF']['dam']['indexRuleClasses']['tx_damdemo_indexRule'] = 'EXT:dam_demo/class.tx_damdemo_indexrule.php:&tx_damdemo_indexRule';
}


	// add custom fields to tx_dam
$tempColumns = Array (
	'tx_damdemo_info' => Array (
		'exclude' => 1,		
		'label' => 'LLL:EXT:dam_demo/locallang_db.php:tx_dam.tx_damdemo_info',		
		'config' => Array (
			'type' => 'input',	
			'size' => '30',
		)
	),
	'tx_damdemo_customcategory' => Array (
		'exclude' => 1,		
		'label' => 'LLL:EXT:dam_demo/locallang_db.php:tx_dam.tx_damdemo_customcategory',		
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('LLL:EXT:dam_demo/locallang_db.php:tx_dam.tx_damdemo_customcategory.I.0', '0'),
				Array('LLL:EXT:dam_demo/locallang_db.php:tx_dam.tx_damdemo_customcategory.I.1', '1'),
				Array('LLL:EXT:dam_demo/locallang_db.php:tx_dam.tx_damdemo_customcategory.I.2', '2'),
				Array('LLL:EXT:dam_demo/locallang_db.php:tx_dam.tx_damdemo_customcategory.I.3', '3'),
			),
			'size' => 1,	
			'maxitems' => 1,
		)
	),
);


t3lib_div::loadTCA('tx_dam');
t3lib_extMgm::addTCAcolumns('tx_dam',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tx_dam','tx_damdemo_info;;;;1-1-1, tx_damdemo_customcategory');

	// add fields to index preset fields
$TCA['tx_dam']['txdamInterface']['index_fieldList'] .= ',tx_damdemo_info,tx_damdemo_customcategory';

?>
