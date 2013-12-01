<?php
namespace Funky\Test;

/**
 * Funky\Test\TestSuite
 *
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

  public function run($path){
  	$this->findFilesRecursive($path);

  	echo "\n\nStarting test\n\n";

  	foreach($this->test_files as $test_file){
  		$this->runTestCase($test_file);
  	}

  	$test_file_count = count($this->test_files);
  	echo "\n\nEnding test with {$this->errorCount} error(s) for {$this->testCount} test(s) in {$test_file_count} files.\n\n\n";
  }

  private function runTestCase($file){
  	$class = \Funky\Helper\String::fileToClass(basename($file, '.php'));

  	require_once($file);

  	$instance = new $class();
  	$instance->run(true);
  	$this->errorCount += $instance->getErrorCount();
  	$this->testCount += $instance->getTestCount();
  }

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