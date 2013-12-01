<?php
namespace Funky\Test;

/**
 * Funky\Test\TestSuite
 *
 * The TestSuite runs a bunch of tests, that are located in a specified path.
 */
class TestSuite{  
	private $test_files;
	private $errorCount;
  private $testCount;

  function __construct(){
  	$this->test_files = array();
  	$this->errorCount = 0;
  	$this->testCount = 0;
  }

  /**
   * run
   * 
   * Run will launch all tests that can be found in the specified $path.
   * 
   * @param $path string A path where test files can be found. Files with test have a filename that starts with test_ .
   */
  public function run($path){
  	$this->findFilesRecursive($path);

  	echo "\n\nStarting test\n\n";

  	foreach($this->test_files as $test_file){
  		$this->runTestCase($test_file);
  	}

  	$test_file_count = count($this->test_files);
  	echo "\n\nEnding test with {$this->errorCount} error(s) for {$this->testCount} test(s) in {$test_file_count} files.\n\n\n";
  }

  /**
   * runTestCase
   *
   * This private function will run a specific test case file and gather information about it (errorCount, testCount).
   *
   * @param $file string The filename that should be tested. Based on the filename, the test class is created and called.
   */
  private function runTestCase($file){
  	$class = \Funky\Helper\String::fileToClass(basename($file, '.php'));

  	require_once($file);

  	$instance = new $class();
  	$instance->run(true);
  	$this->errorCount += $instance->getErrorCount();
  	$this->testCount += $instance->getTestCount();
  }

  /**
   * findFilesRecursive
   *
   * This private function will find all files, starting with test_ in a recursive manor. The function will
   * call itself if a directory is found (instead of a test file).
   *
   * @param $path string The path that should be searched for test_ files or directories.
   */
  private function findFilesRecursive($path){
  	$files = glob($path.DIRECTORY_SEPARATOR.'*');
  	foreach($files as $file){
  		if(is_dir($file)){
  			$this->findFilesRecursive($file);
  		}
  		else{
  			if(preg_match('/^test_/', basename($file))){
					array_push($this->test_files, $file);
  			}
  		}
  	}
  }
}