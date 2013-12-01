<?php
namespace Funky;

/**
 * Funky/Logger
 */
class Logger{
	const DEBUG = 0;
	const INFO = 1;
	const WARNING = 2;
	const ERROR = 3;
	private static $logLevel = Logger::INFO;

	public static function setLogLevel($logLevel){
		Logger::$logLevel = $logLevel;
	}

	public static function debug($message){
		Logger::log(Logger::DEBUG, $message);
	}

	public static function info($message){
		Logger::log(Logger::INFO, $message);
	}

	public static function warning($message){
		Logger::log(Logger::WARNING, $message);
	}

	public static function error($message){
		Logger::log(Logger::ERROR, $message);
	}

	public static function log($level, $message){
		if($level >= Logger::$logLevel){
			$timestamp = date(DATE_ATOM);
			$final_message = "{$timestamp} -> {$message}\n";
			
			error_log($final_message, 3, FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.APPLICATION_ENV.'.log');
		}
	}
}
