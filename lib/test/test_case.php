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
  private $inSuite;
  
  function __construct(){
    $this->errorCount = 0;
    $this->testCount = 0;
    $this->errors = array();
  }
  
  private function setup(){
    if(!$this->inSuite){
      echo "Starting test\n";
    }
  }
  
  private function tearDown(){
    if(!$this->inSuite){
      echo "\n\nEnding test with {$this->errorCount} error(s) for {$this->testCount} test(s).\n";
    }
    foreach($this->errors as $error){
      echo "\n{$error}\n\n";
    }
  }

  public function getErrorCount(){
    return $this->errorCount;
  }

  public function getTestCount(){
    return $this->testCount;
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
    if($message == null){
      $message = "Expected {$test} to be the same as {$original}.";
    }
    
    if($original != $test){
      $this->failed($message);
    }
    else{
      $this->success();
    }
  }

  public function not($original, $test, $message = null){
    if($message == null){
      $message = "Expected {$test} not to be the same as {$original}.";
    }

    if($original == $test){
      $this->failed($message);
    }
    else{
      $this->success();
    }
  }

  public function equal($original, $test, $message = null){
    if($message == null){
      $message = "Expected {$test} to be the exactly the same as {$original}.";
    }
    
    if($original !== $test){
      $this->failed($message);
    }
    else{
      $this->success();
    }
  }

  public function notEqual($original, $test, $message = null){
    if($message == null){
      $message = "Expected {$test} to be not exactly the same as {$original}.";
    }

    if($original === $test){
      $this->failed($message);
    }
    else{
      $this->success();
    }
  }
  
  private function failed($message){
    $this->testCount++;
    $this->errorCount++;
    
    $backtrace = debug_backtrace();
    
    if(count($backtrace) > 0){
      $caller = $backtrace[1];
      
      $this->errors[] = "{$message}\n\tIn file {$caller['file']} on line {$caller['line']}";
    }
    
    echo "F";
  }
  
  private function success(){
    $this->testCount++;
    
    echo ".";
  }
  
  /**
   * run
   *
   * Run the testcase
   *
   * @param $inSuite bool Indicates wether the test is executed in a suite.
   */
  public function run($inSuite = false){
    $this->inSuite = $inSuite;
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