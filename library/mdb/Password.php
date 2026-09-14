<?php

/**
 * Password hashing for the users table.
 *
 * New and changed passwords are stored with password_hash() (bcrypt).
 * Rows created before this existed hold an unsalted MD5 hex digest; those
 * keep working, and a user's row moves to the modern hash the next time
 * their password is set.
 */
class mdb_Password {

	/**
	 * Hash a plain-text password for storage.
	 */
	public static function hash($plain) {
		return password_hash($plain, PASSWORD_DEFAULT);
	}

	/**
	 * Check a plain-text password against a stored hash, accepting both the
	 * legacy MD5 form and password_hash() output.
	 */
	public static function verify($plain, $stored) {
		if ($plain === null || $plain === '' || $stored === null || $stored === '') {
			return false;
		}
		if (self::isLegacy($stored)) {
			return hash_equals(strtolower($stored), md5($plain));
		}
		return password_verify($plain, $stored);
	}

	/**
	 * True when the stored value is an unsalted MD5 digest from the
	 * original application.
	 */
	public static function isLegacy($stored) {
		return is_string($stored) && strlen($stored) == 32 && ctype_xdigit($stored);
	}
}
