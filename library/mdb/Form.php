<?php

/**
 * Base class for the application's Dojo forms.
 *
 * Validation is done by the dijit widgets and by Zend_Form on the server.
 * The forms must opt out of the browser's native HTML5 validation: Zend_Dojo
 * emits required="false" as a widget parameter, the layout applies those
 * parameters as DOM attributes, and Dojo 1.7+ keeps the attribute on the
 * native input. A required attribute is "on" regardless of its value, so
 * without novalidate the browser silently refuses to submit forms that have
 * hidden optional fields (for example the chimera group on the mouse form).
 */
class mdb_Form extends Zend_Dojo_Form {

	public function __construct($options = null) {
		parent::__construct($options);
		$this->setAttrib('novalidate', 'novalidate');
	}
}
