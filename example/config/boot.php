<?php
/** Define environment **/
if(!defined('APPLICATION_ENV')){
  define('APPLICATION_ENV', 'development');
}

/** Set application base path and load the framework **/
define('FUNKY_APPLICATION_BASE_PATH', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'));
require_once(FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'funky'.DIRECTORY_SEPARATOR.'framework.php');

/** Database setup **/
$database = Funky\Config\Json::read(FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.json');
Funky\Data\Connection::setup($database[APPLICATION_ENV]);
$connection = Funky\Data\Connection::getInstance();