<?php
class mdb_Defaults
{
	static $_defaults = array (
		'system.title'						=> 'Mouse Breeding Database',
		'system.versions.bzr.binary'		=> 'bzr',
		'system.dojo.theme'					=> 'soria',
		// https so the app works on TLS hosts; Google still serves Dojo 1.5.0
		'system.dojo.cdn.base'				=> 'https://ajax.googleapis.com/ajax/libs/dojo/',
		// Last Dojo 1.x line; the legacy dojo.require() API this app uses is
		// still supported there. Zend_Dojo's own default is 1.5.0.
		'system.dojo.cdn.version'			=> '1.13.0',
		// Dojo 1.7+ ships one loader; the dojo.xd.js cross-domain build is gone.
		'system.dojo.cdn.dojopath'			=> '/dojo/dojo.js',
		'system.display.footer.launchpad'	=> true,
	);

	static $_userPrefs = array (
		'search.go.input.suggest'			=> '1',
		'interface.toaster.position'		=> 'tr',
		'interface.toaster.direction'		=> 'left',
		'interface.toaster.duration'		=> '300',
		'interface.table.expand'			=> true,
	);

	public static function getDefaults() {
		return self::$_defaults;
	}

	public static function getUserPrefs() {
		return self::$_userPrefs;
	}
}
