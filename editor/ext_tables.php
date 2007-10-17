<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


if (TYPO3_MODE=='BE')	{

	//
	// new editor: search and replace in text file
	//

	tx_dam::register_editor ('tx_damdemo_searchreplace', 'EXT:dam_demo/editor/class.tx_damdemo_searchreplace.php:&tx_damdemo_searchreplace');

}

?>