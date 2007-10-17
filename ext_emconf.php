<?php

########################################################################
# Extension Manager/Repository config file for ext: "dam_demo"
#
# Auto generated 29-09-2007 00:45
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Media: demo extension',
	'description' => 'Extend DAM with own fields, indexing rules and a category tree.',
	'category' => 'example',
	'shy' => 0,
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'test',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'tx_dam',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author' => 'René Fritz',
	'author_email' => 'r.fritz@colorcube.de',
	'author_company' => 'Colorcube - digital media lab',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '0.2.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '3.5.0-0.0.0',
			'php' => '3.0.0-0.0.0',
			'cms' => '',
			'dam' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:9:{s:27:"class.tx_damdemo_damcat.php";s:4:"7b7a";s:30:"class.tx_damdemo_indexrule.php";s:4:"0bbc";s:12:"ext_icon.gif";s:4:"999b";s:14:"ext_tables.php";s:4:"b2d2";s:14:"ext_tables.sql";s:4:"dd1e";s:12:"icon_cat.gif";s:4:"c6e5";s:16:"locallang_db.php";s:4:"2a75";s:24:"locallang_indexrules.php";s:4:"0148";s:14:"doc/manual.sxw";s:4:"8279";}',
);

?>