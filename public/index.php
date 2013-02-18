<?php
    //die("here");

    ini_set('xdebug.show_mem_delta', 'Off');
    ini_set('xdebug.trace_format', '2');
    xdebug_start_trace();

// Set the project root directory. Defaults to one folder above the one containing this file.
$sProjectDir = realpath(__DIR__ . '/..');
// Set the environment mode - possible values: production, development, maintenance
$sAppEnv = 'development';

// Add various locations to the include path. These locations will be PSR autoloaded once composer install has been run
set_include_path(
    get_include_path()
        . PATH_SEPARATOR . $sProjectDir . '/library'
        . PATH_SEPARATOR . $sProjectDir . '/application'
        . PATH_SEPARATOR . $sProjectDir . '/application/models'
        . PATH_SEPARATOR . $sProjectDir . '/application/modules'
);
/**
 * We now include Composer's autoloader and tell it to PSR autoload the include path
 * @var $oLoader Composer\Autoload\ClassLoader
 */
$oLoader = require_once $sProjectDir . '/vendor/autoload.php';
$oLoader->setUseIncludePath(true);

// Bootstrap and run the application, passing in the project directory and the application environment
include_once $sProjectDir.'/application/Bootstrapper.php';
$oBootstrapper = new Bootstrapper($sProjectDir, $sAppEnv);
$oBootstrapper->run();
