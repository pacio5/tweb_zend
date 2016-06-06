<?php
class Application_Resource_Floor extends Zend_Db_Table_Abstract {
	protected $_name = 'floor';
	protected $_primary = 'code';
	protected $_rowClass = 'Application_Resource_Floor_Item';
	public function init() {
	}
	
	// Estrae tutti i piani gestiti, eventualmente paginati ed ordinati
	public function getFloor() {
		$select = $this->select ()->order ( 'building_code' );
		return $this->fetchAll ( $select );
	}
	
	public function getFloorByCode($info) {
		$select = $this->select ()->where('building_code = ?', $info);
		return $this->fetchRow( $select )->toArray();
	}
	
	// Cancella piani dal db
	public function deleteFloor($code) {
		$where = "code = $code";
		return $this->delete($where);
	}
	// Aggiorna dati piani
	public function updateFloor($info, $code){
		$where = "code = $code";
		$this->update($info, $where);
	}
	
	// inserisce un nuovo piano
	public function insertFloor($info) {
		$this->insert ( $info );
	}
	
	// Prende il numero di piani a partire dal codice di un edificio
	public function getFloorNumberByCodeBuilding($info) {
		$select = $this->select ()->where('building_code = ?', $info);
		return $this->fetchRow( $select )->toArray();
	}
}