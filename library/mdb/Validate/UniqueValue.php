<?php

require_once 'Zend/Validate/Abstract.php';

class mdb_Validate_UniqueValue extends Zend_Validate_Abstract {

	const EXISTS = 'exists';
	const DB_ERR = 'db_err';

	protected $_table;
	protected $_id;
	protected $_id_col;
	protected $_value_col;
	protected $_where;

	protected $_messageVariables = array (
		'table' => '_table',
		'id' => '_id',
		'id_col' => '_id_col',
		'value_col' => '_value_col',
		'where' => '_where',
	);

	protected $_messageTemplates = array (
		self::EXISTS => "'%value%' is already used",
		self::DB_ERR => "database error while validating value" );

	public function __construct($table, $id, $id_col, $value_col) {
		$this->_table = $table;
		$this->_value_col = $value_col;
		$this->_id_col = $id_col;
		$this->_id = $id;
	}

	/**
	 * Set the id of the row being edited so its own value is not treated
	 * as a duplicate.
	 */
	public function setId($id) {
		$this->_id = $id;
		return $this;
	}

	/**
	 * Extra SQL condition appended to the uniqueness query.
	 */
	public function setWhere($where) {
		$this->_where = $where;
		return $this;
	}

	public function isValid($value) {

		$this->_setValue ( $value );

		try {
			$db = Zend_Db_Table::getDefaultAdapter ();

			if (is_null($this->_id)) {
				$id_where = $db->quoteIdentifier($this->_id_col).' is not null ';
			} else {
				$id_where = $db->quoteIdentifier($this->_id_col).' != '.$db->quote($this->_id);
			}
			if ( $this->_where ) {
				$id_where.= ' and '.$this->_where;
			}

			if ($db->fetchOne('select count(*) from '.$db->quoteIdentifier($this->_table).' where '.$id_where.' and '.$db->quoteIdentifier($this->_value_col).' = '.$db->quote($value))) {
				$this->_error ( self::EXISTS );
				return false;
			}
		} catch (Zend_Db_Exception $e) {
			$this->_messageTemplates[self::DB_ERR] = $e->getMessage();
			$this->_error ( self::DB_ERR );
			return false;
		}

		return true;
	}
}