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
	
	// Cancella zona dal db
	public function deleteZone($code) {
		$where = "code = $code";
		return $this->delete($where);
	}
	// Aggiorna dati zona
	public function updateZone($info, $code){
		$where = "code = $code";
		$this->update($info, $where);
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
}
