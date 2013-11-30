<?php
/** Define environment **/
if(!defined('APPLICATION_ENV')){
  define('APPLICATION_ENV', 'test');
}

/** Set application base path **/
define('FUNKY_APPLICATION_BASE_PATH', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'));

/** Load the framework **/
require_once(FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'framework.php');
Funky\Framework::load();
