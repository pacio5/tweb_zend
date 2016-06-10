<?php
class Application_Resource_Escape extends Zend_Db_Table_Abstract {
	protected $_name = 'escape_map';
	protected $_primary = 'code';
	protected $_rowClass = 'Application_Resource_Escape_Item';
	public function init() {
	}
	
	// Estrae tutte le vie di fuga gestite, eventualmente paginate ed ordinate
	public function getEscape() {
		$select = $this->select ()->order ( 'code' );
		return $this->fetchAll ( $select );
	}
	
	public function getEscapeByCode($info) {
		$select = $this->select ()->where('code = ?', $info);
		return $this->fetchRow( $select )->toArray();
	}
	
	// inserisce una nuova via di fuga
	public function insertEscape($info) {
		$this->insert ( $info );
	}
	
	public function getEscapeByZoneCode($info){
		$select = $this->select ()->where('zone_code = ?', $info);
		return $this->fetchAll( $select )->toArray();
	}
	
	public function getOnlyEscapeByZoneCode($info){
		$select = $this->select ()->where('zone_code = ?', $info);
		return $this->fetchRow( $select )->toArray();
	}
	
	public function deleteEscapeByZone($code){
		$where = "zone_code = $code";
		$this->delete($where);
	}
}
