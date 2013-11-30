<?php
namespace Funky\Test;

/**
 * Funky\Test\Case
 *
 */
class TestCase{
  private $errorCount;
  private $testCount;
  private $errors;
  
  function __construct(){
    $this->errorCount = 0;
    $this->testCount = 0;
    $this->errors = array();
  }
  
  private function setup(){
    echo "Starting test\n";
  }
  
  private function tearDown(){
    echo "\n\nEnding test with {$this->errorCount} error(s) for {$this->testCount} test(s).\n";
  }
  
  /**
   * beforeAll
   *
   * beforeAll is a stub method that will be called once before all tests.
   */
  public function beforeAll(){
  }
  
  /**
   * beforeAny
   *
   * beforeAny is a stub method that will be called before every tests.
   */
  public function beforeAny(){
  }
  
  /**
   * afterAll
   *
   * afterAll is a stub method that will be called once all tests are done.
   */
  public function afterAll(){
  }
  
  /**
   * afterAny
   *
   * afterAny is a stub method that will be called before every tests.
   */
  public function afterAny(){
  }
  
  public function assert($original, $test, $message = null){
    $this->testCount++;
    if($original != $test){
      echo "F";
      $this->errorCount++;
    }
    else{
      echo ".";
    }
  }

  public function not($original, $test, $message = null){
    $this->testCount++;
    if($original == $test){
      echo "F";
      $this->errorCount++;
    }
    else{
      echo ".";
    }
  }

  public function equal($original, $test, $message = null){
    $this->testCount++;
    if($original !== $test){
      echo "F";
      $this->errorCount++;
      var_dump(debug_backtrace());
    }
    else{
      echo ".";
    }
  }

  public function notEqual($original, $test, $message = null){
    $this->testCount++;
    if($original === $test){
      echo "F";
      $this->errorCount++;
      var_dump(debug_backtrace());
    }
    else{
      echo ".";
    }
  }
  
  /**
   * run
   *
   * Run the testcase
   */
  public function run(){
    $this->setup();
    $this->beforeAll();
    
    $methods = get_class_methods($this);
    foreach($methods as $method){
      if(preg_match("/^test.*$/", $method, $matches)){
        $this->beforeAny();
        $this->$method();
        $this->afterAny();
      }
    }
    
    $this->afterAll();
    $this->tearDown();
  }
}