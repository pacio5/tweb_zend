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
		$select = $this->select ()->where('code = ?', $info);
		return $this->fetchRow( $select );
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
	
	// Prende tutti i piani di un edificio
	public function getBuildingFloor($info){
		$select = $this->select()->where('building_code = ?', $info)->order('number');
		return $this->fetchAll($select);
	}
	
	public function verifyFloor($building, $floor){
		$select = $this->select()->where('building_code = ?', $building)->where('number = ?', $floor);
		return $this->fetchRow($select);
	}
	
}