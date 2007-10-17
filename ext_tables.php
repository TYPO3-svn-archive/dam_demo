<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$tempPath = t3lib_extMgm::extPath('dam_demo');

require($tempPath.'fields/ext_tables.php');


require($tempPath.'action/ext_tables.php');


require($tempPath.'previewer/ext_tables.php');


?>