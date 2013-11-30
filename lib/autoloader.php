<?php
namespace Funky;

/**
 * Funky/Autoloader
 *
 * The Autoloader class automaticaly loads classes when they are needed. It will look for a Funky\ prefix to start loading files from the framework.
 */
class Autoloader{
  
  /**
   * register
   * 
   * This registers the Autoloader load function in the autoloader chain.
   */
  public static function register(){
    return spl_autoload_register(array('Funky\Autoloader', 'load'));
  }
  
  /**
   * load
   *
   * When a class is requested and cannot be found, its name gets passed into this function. Bases on the name, the function will try to decode the class name and load the required file.
   *
   * @param $class string The name of the class that is requested.
   *
   * @return boolean Indicates wether or not the load was successfull.
   */
  public static function load($class){
    if(preg_match("/^Funky\\\(.*)$/", $class, $matches)){
      $paths = explode("\\", $matches[1]);
      foreach($paths as $key => $path){
        $paths[$key] = strtolower($path);
      }

      $filename = FUNKY_FRAMEWORK_BASE_PATH.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $paths).'.php';

      if(file_exists($filename)){
        require_once($filename);
        return true;
      }
      else{
        return false;
      }
    }
  }
}