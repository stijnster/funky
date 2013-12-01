<?php
namespace Funky\Test;

/**
 * Funky\Test\TestCase
 *
 * TestCase forms the basic class to create tests. It provides methods to test specific values
 * and callback functions that run before or after any or all test.
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
  
  /**
   * setup
   *
   * setup is a private function that gets called when starting the test case. It basicaly prints out that
   * the test is starting.
   */
  private function setup(){
    if(!$this->inSuite){
      echo "Starting test\n";
    }
  }
  
  /**
   * tearDown
   *
   * tearDown is a private function that gets called when the test case is done. It prints out some statistics
   * about the tests.
   */
  private function tearDown(){
    if(!$this->inSuite){
      echo "\n\nEnding test with {$this->errorCount} error(s) for {$this->testCount} test(s).\n";
    }
    foreach($this->errors as $error){
      echo "\n{$error}\n\n";
    }
  }

  /**
   * getErrorCount
   *
   * Gets the number of errors that occured during the test.
   */
  public function getErrorCount(){
    return $this->errorCount;
  }

  /**
   * getTestCount
   *
   * Gets the number of tests that where executed during the test.
   */
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
  
  /**
   * assert
   * 
   * This test compares two values. If the values are different, the test fails.
   *
   * @param $original mixed The expected value.
   * @param $test mixed The value to test.
   * @param $message string optional A specific message can be provided to print when the test fails.
   */
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

  /**
   * not
   * 
   * This test compares two values. If the values are the same, the test fails.
   *
   * @param $original mixed The expected value.
   * @param $test mixed The value to test.
   * @param $message string optional A specific message can be provided to print when the test fails.
   */
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

  /**
   * equal
   * 
   * This test compares two values to match exactly. If the values are different, the test fails.
   *
   * @param $original mixed The expected value.
   * @param $test mixed The value to test.
   * @param $message string optional A specific message can be provided to print when the test fails.
   */
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

  /**
   * notEqual
   * 
   * This test compares two values to not match exactly. If the values are the same, the test fails.
   *
   * @param $original mixed The expected value.
   * @param $test mixed The value to test.
   * @param $message string optional A specific message can be provided to print when the test fails.
   */
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
  
  /**
   * failed
   * 
   * Failed is a private function that gets called when a test fails. It gathers information on
   * where the test was called from, and increases the test and error count.
   *
   * @param $message string The message that gets printed.
   */
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
  
  /**
   * success
   * 
   * Success is a private function that gets called when a test is succesfull. It will increment the
   * testCount.
   */
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