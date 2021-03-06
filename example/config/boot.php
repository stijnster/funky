<?php
/** Define environment **/
if(!defined('APPLICATION_ENV')){
  define('APPLICATION_ENV', 'development');
}

date_default_timezone_set('Europe/Brussels');

/** Set application base path **/
define('FUNKY_APPLICATION_BASE_PATH', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'));

/** Load the framework **/
require_once(FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'funky'.DIRECTORY_SEPARATOR.'framework.php');
Funky\Framework::load();

Funky\Data\Connection::getInstance();