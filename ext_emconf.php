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
	'version' => '1.0.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'test',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'tx_dam',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Rene Fritz',
	'author_email' => 'r.fritz@colorcube.de',
	'author_company' => 'Colorcube - digital media lab, www.colorcube.de',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'dam' => '',
			'php' => '4.0.0-0.0.0',
			'typo3' => '3.8.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:23:{s:9:"ChangeLog";s:4:"f731";s:12:"ext_icon.gif";s:4:"999b";s:17:"ext_localconf.php";s:4:"fd84";s:14:"ext_tables.php";s:4:"5a5d";s:14:"ext_tables.sql";s:4:"dd1e";s:12:"icon_cat.gif";s:4:"c6e5";s:36:"action/class.tx_damdemo_pathInfo.php";s:4:"6e9c";s:21:"action/ext_tables.php";s:4:"539a";s:28:"action/locallang_actions.xml";s:4:"1224";s:40:"indexrule/class.tx_damdemo_indexrule.php";s:4:"55db";s:27:"indexrule/ext_localconf.php";s:4:"4ae6";s:34:"indexrule/locallang_indexrules.xml";s:4:"9f05";s:21:"fields/ext_tables.php";s:4:"ac65";s:23:"fields/locallang_db.xml";s:4:"6df2";s:45:"previewer/class.tx_damdemo_previewerFlash.php";s:4:"cc50";s:24:"previewer/ext_tables.php";s:4:"bef0";s:28:"sv1/class.tx_damdemo_sv1.php";s:4:"0a37";s:21:"sv1/ext_localconf.php";s:4:"9ff5";s:28:"sv2/class.tx_damdemo_sv2.php";s:4:"55ac";s:21:"sv2/ext_localconf.php";s:4:"4683";s:37:"selection/class.tx_damdemo_damcat.php";s:4:"3a81";s:27:"selection/ext_localconf.php";s:4:"457b";s:14:"doc/manual.sxw";s:4:"4b12";}',
);

?>