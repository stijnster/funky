<?php
require_once(realpath(dirname(__FILE__)).'/../config/boot.php');

class TestTestCase extends Funky\Test\TestCase{
  function testAssert(){
    $this->assert('test', 'test');
    $this->assert('3', 3);
    $this->not('3', 4);
    $this->equal('test', 'test');
    $this->notEqual('4', 4);
  }
}

$testTestCase = new TestTestCase();
$testTestCase->run();
