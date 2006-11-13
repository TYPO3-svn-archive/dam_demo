<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * These things are here (and not in ext_tables.php) because they might be used in FE and ext_localconf.php will be included always.
	 */


	//
	// register browse tree and select rule for nav tree.
	//

		//  The id 'txdamdemodamcat' must not include '_'
	tx_dam::register_selection ('txdamdemodamcat', 'EXT:dam_demo/selection/class.tx_damdemo_damcat.php:&tx_damdemo_damcat', 'before:txdamMedia');



?>