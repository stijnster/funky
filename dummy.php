<?php
require_once 'data/connection.php';

Funky\Data\Connection::setup(array('host' => 'localhost', 'username' => 'root', 'database' => 'twizzi2_restore'));
Funky\Data\Connection::getInstance();


var_dump(Funky\Data\Connection::getConnection());