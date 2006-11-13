<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


if (TYPO3_MODE=='BE')	{

	//
	// new action: path info button in file module
	//

	tx_dam::register_action ('tx_damdemo_pathInfo', 'EXT:dam_demo/action/class.tx_damdemo_pathInfo.php:&tx_damdemo_pathInfo');

}

?>