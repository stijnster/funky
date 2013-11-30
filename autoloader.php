<?php
namespace Funky;

class Autoloader{
  public static function register(){
    return spl_autoload_register(array('Funky\Autoloader', 'load'));
  }
  
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

define('FUNKY_FRAMEWORK_BASE_PATH', realpath(dirname(__FILE__)));

Autoloader::register();