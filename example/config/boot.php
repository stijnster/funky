<?php
define('FUNKY_APPLICATION_BASE_PATH', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'));

require_once(FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'funky'.DIRECTORY_SEPARATOR.'autoloader.php');

Funky\Data\Connection::setup(array('host' => 'localhost', 'username' => 'root', 'database' => 'funky', 'socket' => '/tmp/mysql.sock'));

$connection = Funky\Data\Connection::getInstance();