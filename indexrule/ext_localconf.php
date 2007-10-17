<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * These things are here (and not in ext_tables.php) because they might be used in FE and ext_localconf.php will be included always.
	 */

	//
	// custom index rule
	//

	tx_dam::register_indexingRule ('tx_damdemo_indexRule', 'EXT:dam_demo/indexrule/class.tx_damdemo_indexrule.php:&tx_damdemo_indexRule');



?>