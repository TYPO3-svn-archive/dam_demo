<?php

########################################################################
# Extension Manager/Repository config file for ext: "dam_demo"
#
# Auto generated 21-08-2006 01:00
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
	'version' => '1.0.101',
	'dependencies' => 'cms,dam',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'tx_dam',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'The DAM development team',
	'author_email' => 'typo3-project-dam@lists.netfielders.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'dam' => '',
			'php' => '4.0.0-',
			'typo3' => '4.0.0-',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => '',
	'suggests' => array(
	),
);

?>