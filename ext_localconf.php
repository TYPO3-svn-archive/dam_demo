<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * Normally all components of an extension register here.
	 * For better understanding the parts are moved to the components folders, means you can clearly see which code belongs to which component.
	 * Also naming of folders is different than pi1, pi2 etc. This is just to find the code more easily.
	 */

$tempPath = t3lib_extMgm::extPath('dam_demo');

require($tempPath.'selection/ext_localconf.php');

require($tempPath.'indexrule/ext_localconf.php');

require($tempPath.'file_type/ext_localconf.php');

require($tempPath.'sv1/ext_localconf.php');


// experimental:
# require($tempPath.sv2/ext_localconf.php');




?>