<?php

class mdb_Messages {
	
	const MESSAGE_NAMESPACE = 'QuickMessage';
	
	public static function add($message, $type = 'message', $duration = 5000) {
		
		$message = trim ( $message );
		if (strlen( $message ) > 0) {
			$sessionNamespace = new Zend_Session_Namespace ( self::MESSAGE_NAMESPACE );
			$sessionNamespace->messages[] = array ('message' => htmlspecialchars($message), 'type' => $type, 'duration' => $duration );
		}
	}
	
	public static function count() {
	
		$sessionNamespace = new Zend_Session_Namespace ( self::MESSAGE_NAMESPACE );
		return is_array($sessionNamespace->messages) ? count($sessionNamespace->messages) : 0;
	}
	
	public static function pop() {

		$message = self::peek();
		self::discard();
		
		return $message;
		
	}
	
	public static function peek() {

		$sessionNamespace = new Zend_Session_Namespace ( self::MESSAGE_NAMESPACE );
		
		$message = null;
		if ( is_array($sessionNamespace->messages) && isset($sessionNamespace->messages[0]) ) {
			$message = $sessionNamespace->messages[0];
		}

		return $message;

	}
	
	public static function discard() {

		$sessionNamespace = new Zend_Session_Namespace ( self::MESSAGE_NAMESPACE );
		if ( is_array($sessionNamespace->messages) ) {
			$messages = $sessionNamespace->messages;
			array_shift($messages);
			$sessionNamespace->messages = $messages;
		}

	}
	
	public static function clear() {

		$sessionNamespace = new Zend_Session_Namespace ( self::MESSAGE_NAMESPACE );
		$sessionNamespace->messages = array();	

	}
	
	public static function getMessages() {

		$sessionNamespace = new Zend_Session_Namespace ( self::MESSAGE_NAMESPACE );
		
		if (is_array($sessionNamespace->messages)) {
			return $sessionNamespace->messages;
		} else {
			return array();
		}
		
	}
	
}