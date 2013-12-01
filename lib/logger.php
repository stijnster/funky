<?php
namespace Funky;

/**
 * Funky/Logger
 * 
 * The Logger class adds basic logging functionality to the framework. It expects a log folder in the application
 * named 'log'.
 * There are 4 log leves; debug, info, warning and error. The production environment only logs info and higher.
 */
class Logger{
	const DEBUG = 0;
	const INFO = 1;
	const WARNING = 2;
	const ERROR = 3;
	private static $logLevel = Logger::INFO;

	/**
	 * setLogLevel
	 *
	 * This function sets the loglevel. Messages under a given log level will not be recorded.
	 */
	public static function setLogLevel($logLevel){
		Logger::$logLevel = $logLevel;
	}

	/**
	 * debug
	 *
	 * Logs a message using the debug level.
	 *
	 * @param $message string The message that needs to be logged.
	 */
	public static function debug($message){
		Logger::log(Logger::DEBUG, $message);
	}

	/**
	 * info
	 *
	 * Logs a message using the info level.
	 *
	 * @param $message string The message that needs to be logged.
	 */
	public static function info($message){
		Logger::log(Logger::INFO, $message);
	}

	/**
	 * warning
	 *
	 * Logs a message using the warning level.
	 *
	 * @param $message string The message that needs to be logged.
	 */
	public static function warning($message){
		Logger::log(Logger::WARNING, $message);
	}

	/**
	 * error
	 *
	 * Logs a message using the error level.
	 *
	 * @param $message string The message that needs to be logged.
	 */
	public static function error($message){
		Logger::log(Logger::ERROR, $message);
	}

	/**
	 * debug
	 *
	 * This private function logs a message under a specific level. If the level is not high enough,
	 * the message isn't recorded in the log.
	 *
	 * @param $level int Based on the constats DEBUG, INFO, WARNING and ERROR.
	 * @param $message string The message that needs to be logged.
	 */
	private static function log($level, $message){
		if($level >= Logger::$logLevel){
			$timestamp = date(DATE_ATOM);
			$final_message = "{$timestamp} -> {$message}\n";

			error_log($final_message, 3, FUNKY_APPLICATION_BASE_PATH.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.APPLICATION_ENV.'.log');
		}
	}
}
