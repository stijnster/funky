<?php
namespace Funky\Config;

/**
 * Funky\Config\Json
 *
 * This is a helper class that opens a json file and decodes and returns its contents. It can be used to read
 * json configuration files.
 */
class Json{
  
  /**
   * read
   *
   * read is a static function that reads, decodes and return the contents of a given file.
   * 
   * @param $filename string Pass in the filename that should be parsed.
   *
   * @return mixed Depending on the contents of the json file.
   */
  public static function read($filename){
    return json_decode(file_get_contents($filename), true);
  }
}