<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * These things are here (and not in ext_tables.php) because they might be used in FE and ext_localconf.php will be included always.
	 */


	//
	// register a new file type to be detected
	//


	tx_dam::register_fileType ('m4v', 'video/x-m4v');

?>