<?php
class Application_Resource_Building extends Zend_Db_Table_Abstract {
	protected $_name = 'building';
	protected $_primary = 'code';
	protected $_rowClass = 'Application_Resource_Building_Item';
	public function init() {
	}
	
	// Estrae tutti gli edifici gestiti, eventualmente paginati ed ordinati
	public function getBuilding() {
		$select = $this->select ()->order ( 'code' );
		return $this->fetchAll ( $select );
	}
	
	// Cancella edificio dal db
	public function deleteBuilding($code) {
		$where = "code = $code";
		return $this->delete($where);
	}
	// Aggiorna dati edificio DA RIVEDERE
	public function modifyBuilding($code, $address, $name, $floor_number) {
		$this->update ( $code, $address, $name, $floor_number );
	}
	
	// inserisce un nuovo edificio
	public function insertBuilding($info) {
		$this->insert ( $info );
	}
}

