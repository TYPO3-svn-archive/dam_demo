<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


	/**
	 * These things are here (and not in ext_tables.php) because they might be used in FE and ext_localconf.php will be included always.
	 */


	//
	// add metaExtract services - should be in a separate extension normally
	//

	t3lib_extMgm::addService($_EXTKEY,  'metaExtract' /* sv type */,  'tx_damdemo_sv1' /* sv key */,
		array(

			'title' => 'Meta extraction (demo)',
			'description' => 'Simulate a meta extraction service for file type *.test',

			'subtype' => 'test',	// this service is for *.test files

			'available' => true,
			'priority' => 60,
			'quality' => 50,

			'os' => '',
			'exec' => '',

			'classFile' => t3lib_extMgm::extPath($_EXTKEY).'sv1/class.tx_damdemo_sv1.php',
			'className' => 'tx_damdemo_sv1',
		)
	);


?>