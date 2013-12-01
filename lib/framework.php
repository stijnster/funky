<?php
namespace Funky;

/**
 * Funky\Framework
 *
 * This class will load the basic components and settings for the Funky Framework.
 */
class Framework{
  const MAJOR = 0;
  const MINOR = 0;
  const PATCH = 0;
  const BUILD = 1;
  
  /**
   * load
   *
   * Call load to load the framework's basic components.
   */
  public static function load(){  
    Framework::checkEnvironmentVariables();
    
    Framework::registerAutoloader();
    Framework::setupLogging();
    Framework::setupDatabase();
  }
  
  public static function version(){
    return implode('.', array(Framework::MAJOR, Framework::MINOR, Framework::PATCH, Framework::BUILD));
  }

  /**
   * checkEnvironmentVariables
   *
   * Private function that makes sure the necessary environment variables are available. If not, exceptions are thrown to stop further execution.
   */
  private static function checkEnvironmentVariables(){
    /** Stop working if there is no application base path defined **/
    if(!defined('FUNKY_APPLICATION_BASE_PATH')){
      throw new \Exception('The constant "FUNKY_APPLICATION_BASE_PATH" should be defined before calling the framework. It should contain the path to the application\'s base path.');
    }

    /** Stop working if there is no application environment set **/
    if(!defined('APPLICATION_ENV')){
      throw new \Exception('The constant "APPLICATION_ENV" should be defined before calling the framework. It should contain the name of the application\'s environment.');
    }

    /** Define the framework base path **/
    define('FUNKY_FRAMEWORK_BASE_PATH', realpath(dirname(__FILE__)));

    if(APPLICATION_ENV == 'production'){
      error_reporting(0);
      ini_set('display_errors', '0');
    }
    else{
      error_reporting(E_ALL);
      ini_set('display_errors', '1');
    }
  }

  /**
   * registerAutoloader
   *
   * Private function to load and register the autoloader
   */
  private static function registerAutoloader(){
    require_once(FUNKY_FRAMEWORK_BASE_PATH.DIRECTORY_SEPARATOR.'autoloader.php');
    Autoloader::register();
  }


  private static function setupLogging(){
    if(APPLICATION_ENV != 'production'){
      Logger::setLogLevel(Logger::DEBUG);
    }
  }

  
  /**
   * setupDatabase
   *
   * Private function that checks if there is a database.json file in the config folder of the application.
   * If a file can be found, it is used to setup the database connection.
   */
  private static function setupDatabase(){
    /** See if there is a database.json file in the  **/
    $database_file = FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.json';
    if(file_exists($database_file)){
        $connections = Config\Json::read($database_file);
        Data\Connection::setup($connections[APPLICATION_ENV]);
    }    
  }
}
