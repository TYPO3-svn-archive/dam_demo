<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * Normally all components of an extension register here.
	 * It is seperated and included for better understanding, means you can clearlc see which code belongs to which component.
	 * Also naming of folders is different than pi1, pi2 etc. This is just to find the code more easily.
	 */

$tempPath = t3lib_extMgm::extPath('dam_demo');

require($tempPath.'fields/ext_tables.php');

require($tempPath.'action/ext_tables.php');

require($tempPath.'previewer/ext_tables.php');


?>