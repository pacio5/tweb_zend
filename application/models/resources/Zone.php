<?php
class Application_Resource_Zone extends Zend_Db_Table_Abstract {
	protected $_name = 'zone';
	protected $_primary = 'code';
	protected $_rowClass = 'Application_Resource_Zone_Item';
	public function init() {
	}
	
	// Estrae tutte le zone gestite, eventualmente paginate ed ordinate
	public function getZone() {
		$select = $this->select ()->order ( 'code' );
		return $this->fetchAll ( $select );
	}
	
	public function getZoneByCode($info) {
		$select = $this->select ()->where('code = ?', $info);
		return $this->fetchRow( $select )->toArray();
	}
	
	// inserisce una nuova zona
	public function insertZone($info) {
		$this->insert ( $info );
	}
	
	// Prende tutte le zone di un piano
	public function getFloorZone($info){
		$select = $this->select()->where('floor_code = ?', $info)->order('number');
		return $this->fetchAll($select);
	}
	
	// Via di fuga 
	public function getEscapeByZone($info){
		$select = $this->select()->where('code = ?', $info);
		return $this->fetchRow($select);
	}
	
	public function associateEscape($info, $code){
		$where = "code = $code";
		$this->update($info, $where);
	}
	

	public function changeMap($info, $code){
		$where = "code = $code";
		$this->update($info, $where);
	}
	public function deleteZoneByFloor($code){
		$where = "floor_code = $code";
		$this->delete($where);
	}
}
