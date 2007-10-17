<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * These things are here (and not in ext_tables.php) because they might be used in FE and ext_localconf.php will be included always.
	 */


	//
	// add metaExtract services - should be in a separate extension normally
	//

	t3lib_extMgm::addService($_EXTKEY,  'metaExtract' /* sv type */,  'tx_damdemo_sv2' /* sv key */,
		array(

			'title' => 'Meta extraction (demo)',
			'description' => 'Simulate a meta extraction service for files with childs of type *.test2',

			'subtype' => 'test2',	// this service is for *.test2 files

			'available' => true,
			'priority' => 60,
			'quality' => 50,

			'os' => '',
			'exec' => '',

			'classFile' => t3lib_extMgm::extPath($_EXTKEY).'sv2/class.tx_damdemo_sv2.php',
			'className' => 'tx_damdemo_sv2',
		)
	);


?>