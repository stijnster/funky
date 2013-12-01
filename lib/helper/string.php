<?php
namespace Funky\Helper;

/**
 * Funky\Helper\String
 *
 * Adds helper methods to format strings.
 */
class String{

	/**
	 * classToFile
	 *
	 * Converts a class name to a filename. Classes have uppercase characters that get converted to lowercase.
	 * When the uppercase character is not the first, it gets prefixed by an underscore.
	 * Funky becomes funky and FunkyChicken becomes funky_chicken.
	 * 
	 * @param $class string The name of the class to convert.
	 * 
	 * @return string The converted class name.
	 */
	public static function classToFile($class){
		return preg_replace_callback('/(^[A-Z]{1}|([a-z]{1})([A-Z]{1}))/', function($matches){
			if(count($matches) == 4){
				$result = $matches[2].'_'.strtolower($matches[3]);
			}
			else{
				$result = strtolower($matches[0]);
			}

			return $result;
		}, $class);
	}

	/**
	 * fileToClass
	 *
	 * Converts a filename to a class name. Files have lowercase characters that get converted to uppercase.
	 * When the lowercase character is prefixed by an underscore, the underscore is removed and the next character becomes uppercase.
	 * funky becomes Funky and funky_chicken becomes FunkyChicken.
	 * 
	 * @param $file string The name of the file to convert.
	 * 
	 * @return string The converted file name.
	 */
	public static function fileToClass($file){
		return preg_replace_callback('/(^[a-z]{1}|(_)([a-z]{1}))/', function($matches){
			if(count($matches) == 4){
				$result = strtoupper($matches[3]);
			}
			else{
				$result = strtoupper($matches[0]);
			}
			
			return $result;
		}, $file);
	}
}