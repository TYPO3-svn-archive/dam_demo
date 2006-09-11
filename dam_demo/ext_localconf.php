<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * These things are here (and not in ext_tables.php) because they might be used in FE and ext_localconf.php will be included always.
	 */

$tempPath = t3lib_extMgm::extPath('dam_demo');

require($tempPath.'selection/ext_localconf.php');



require($tempPath.'indexrule/ext_localconf.php');



require($tempPath.'sv1/ext_localconf.php');



// experimental:
# require($tempPath.sv2/ext_localconf.php');




?>