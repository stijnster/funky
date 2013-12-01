<?php
require_once(realpath(dirname(__FILE__)).'/../config/boot.php');

class TestHelperString extends Funky\Test\TestCase{

	function testClassToFile(){
		$this->assert('funky', Funky\Helper\String::classToFile('Funky'));
		$this->assert('chicken', Funky\Helper\String::classToFile('Chicken'));
		$this->assert('funky_chicken', Funky\Helper\String::classToFile('FunkyChicken'));
		$this->assert('funky_chicken_dance', Funky\Helper\String::classToFile('FunkyChickenDance'));
		$this->assert('funky/chicken/helper', Funky\Helper\String::classToFile('Funky\Chicken\Helper'));
		$this->assert('funky/chicken/helper_dance', Funky\Helper\String::classToFile('Funky\Chicken\HelperDance'));
		$this->assert('funky/chicken/helper_dance_method', Funky\Helper\String::classToFile('Funky\Chicken\HelperDanceMethod'));
	}

	function testFileToClass(){
		$this->assert('Funky', Funky\Helper\String::fileToClass('funky'));
		$this->assert('Chicken', Funky\Helper\String::fileToClass('chicken'));
		$this->assert('FunkyChicken', Funky\Helper\String::fileToClass('funky_chicken'));
		$this->assert('FunkyChickenDance', Funky\Helper\String::fileToClass('funky_chicken_dance'));
		$this->assert('Funky\Chicken\Helper', Funky\Helper\String::fileToClass('funky/chicken/helper'));
		$this->assert('Funky\Chicken\HelperDance', Funky\Helper\String::fileToClass('funky/chicken/helper_dance'));
		$this->assert('Funky\Chicken\HelperDanceMethod', Funky\Helper\String::fileToClass('funky/chicken/helper_dance_method'));
	}
}

$testHelperString = new TestHelperString();
$testHelperString->run();
