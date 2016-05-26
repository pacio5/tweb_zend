<?php
class Application_Resource_Staff extends Zend_Db_Table_Abstract {
	protected $_name = 'user';
	protected $_primary = 'user';
	protected $_rowClass = 'Application_Resource_Staff_Item';
	public function init() {
	}
	
	// Estrae tutto lo staff, eventualmente paginati ed ordinati
	public function getStaff() {
		$select = $this->select ()->where('role = ?', 'staff')->order ( 'name' );
		return $this->fetchAll ( $select );
	}
	
	// Cancella staff dal codice
	public function deleteStaff($user) {
		$where = "user = '$user'";
		return $this->delete($where);
	}
	
	// Aggiorna dati staff DA RIVEDERE
	public function modifyStaff($code, $user, $name, $surname, $password, $role) {
		$this->update ( $code, $user, $name, $surname, $password, $role );
	}
	
	// inserisce un nuovo staff
	public function insertStaff($info) {
		$this->insert ( $info );
	}
	
}