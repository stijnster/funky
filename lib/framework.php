<?php
namespace Funky;

/**
 * framework loader file
 *
 * This fill will load the basic components and settings for the framework.
 */

/** Stop working if there is no application base path defined **/
if(!defined('FUNKY_APPLICATION_BASE_PATH')){
  throw new Exception('The constant "FUNKY_APPLICATION_BASE_PATH" should be defined before calling the framework. It should contain the path to the application\'s base path.');
}

/** Define the framework base path **/
define('FUNKY_FRAMEWORK_BASE_PATH', realpath(dirname(__FILE__)));

/** Load and register the autoloader **/
require_once(FUNKY_FRAMEWORK_BASE_PATH.DIRECTORY_SEPARATOR.'autoloader.php');
Autoloader::register();