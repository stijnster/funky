<?php
namespace Funky\Data;

/**
 * Funky\Data\Connection
 *
 * The Connection class sets up (and tears down) a connection to a mysql database, using the mysqli library.
 */
class Connection{
  private static $instance;
  private static $connection;
  private static $host = null;
  private static $username = null;
  private static $password = null;
  private static $database = null;
  private static $port = null;
  private static $socket = null;

  /**
   * __construct
   *
   * The database connection is opened on the very first time the instance is being created.
   */
  private function __construct(){
    \Funky\Logger::debug('Opening database connection');
    Connection::$connection = mysqli_connect(Connection::$host, Connection::$username, Connection::$password, Connection::$database, Connection::$port, Connection::$socket);
  }
  
  /**
   * __destruct
   *
   * The database connection is closed when the class gets destroyed.
   */
  function __destruct(){
    Connection::$connection->close();
    \Funky\Logger::debug('Database connection closed');
  }
  
  /**
   * setup
   * 
   * @param $parameters array An array defining the connection to the database, using 'host', 'username', 'password', 'database', 'port' and 'socket'.
   */
  public static function setup($parameters){
    if(array_key_exists('host', $parameters)){
      Connection::$host = $parameters['host'];      
    }
    if(array_key_exists('username', $parameters)){
      Connection::$username = $parameters['username'];
    }
    if(array_key_exists('password', $parameters)){
      Connection::$password = $parameters['password'];
    }
    if(array_key_exists('database', $parameters)){
      Connection::$database = $parameters['database'];
    }
    if(array_key_exists('port', $parameters)){
      Connection::$port = $parameters['port'];
    }
    if(array_key_exists('socket', $parameters)){
      Connection::$socket = $parameters['socket'];
    }
  }
  
  /**
   * getInstance
   *
   * Singleton method to retrieve the instance to the provided database connection.
   *
   * @return Funky\Data\Connection instance
   */
  public static function getInstance(){
    if(!Connection::$instance instanceof self){
      Connection::$instance = new self();
    }
    
    return Connection::$instance;
  }
  
  /**
   * getConnection
   *
   * This is a method to get access to the connection.
   *
   * @return Funky\Data\Connection instance
   */
  public static function getConnection(){
    return Connection::$connection;
  }
}