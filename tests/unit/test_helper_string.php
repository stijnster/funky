<?php
require_once(realpath(dirname(__FILE__)).'/../config/boot.php');

class TestHelperString extends Funky\Test\TestCase{

	function testClassToFile(){
		$this->assert('funky', Funky\Helper\String::classToFile('Funky'));
		$this->assert('chicken', Funky\Helper\String::classToFile('Chicken'));
		$this->assert('funky_chicken', Funky\Helper\String::classToFile('FunkyChicken'));
	}

	function testFileToClass(){
		$this->assert('Funky', Funky\Helper\String::fileToClass('funky'));
		$this->assert('Chicken', Funky\Helper\String::fileToClass('chicken'));
		$this->assert('FunkyChicken', Funky\Helper\String::fileToClass('funky_chicken'));
	}
}

$testHelperString = new TestHelperString();
$testHelperString->run();
