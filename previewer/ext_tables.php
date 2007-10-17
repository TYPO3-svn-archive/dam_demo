<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


if (TYPO3_MODE=='BE')	{

	//
	// new previewer: flash movie player
	//

	tx_dam::register_previewer ('tx_damdemo_previewerFlash', 'EXT:dam_demo/previewer/class.tx_damdemo_previewerFlash.php:&tx_damdemo_previewerFlash');

}

?>