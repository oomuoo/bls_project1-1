<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'timeZone'=>'Asia/Bangkok',

	// preloading 'log' component
	'preload'=>array('log'),
	'language'=>'th',	
	'timeZone'=>'Asia/Bangkok',
		
	'theme'=>'hebo',
		'modules'=>array(
				'gii'=>array(
						'generatorPaths'=>array(
								'bootstrap.gii',
						),
				),
		),
	// preloading 'log' component
	'preload'=>array('log'),
	//'theme'=>'rhea',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
			'ePdf' => array(
					'class'     => 'ext.yii-pdf.EYiiPdf',
					'params'    => array(
							'mpdf'  => array(
									'librarySourcePath' => 'application.extensions.mpdf.*',
									'constants'         => array(
											'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
									),
									'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder.
									'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
											'mode'              => 'UTF-8', //  This parameter specifies the mode of the new document.
											'format'            => 'A4', // format A4, A5, ...
											'default_font_size' => 0, // Sets the default document font size in points (pt)
											'default_font'      => '', // Sets the default font-family for the new document.
											'mgl'               => 12, // margin_left. Sets the page margins for the new document.
											'mgr'               => 12, // margin_right
											'mgt'               => 15, // margin_top
											'mgb'               => 15, // margin_bottom
											'mgh'               => 6, // margin_header
											'mgf'               => 6, // margin_footer
											'orientation'       => 'P', // landscape or portrait orientation
									)
							),
					)
			),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
						
		),
		
		'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap'),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
			

			
		'db'=>array(
			//'connectionString' => 'mysql:host=localhost;dbname=project3_se04',
			'connectionString' => 'mysql:host=localhost;dbname=bls_db',
			'emulatePrepare' => true,
			//'username' => 'project3_se04',
			//'password' => 'B9aJXzgj',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);