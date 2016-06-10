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
	
	public function getBuildingByCode($info) {
		$select = $this->select ()->where('code = ?', $info);
		return $this->fetchRow( $select )->toArray();
	}
	
	public function getBuildingByRole($info){
		$select = $this->select ()->where ("staff_code = ?",$info)->orWhere ("staff_code IS NULL");
		return $this->fetchAll ( $select );
	}
	
	// Cancella edificio dal db
	public function deleteBuilding($code) {
		$where = "code = $code";
		return $this->delete($where);
	}
	// Aggiorna dati edificio
	public function updateBuilding($info, $code){
		$where = "code = $code";
		$this->update($info, $where);
	}
	
	// inserisce un nuovo edificio
	public function insertBuilding($info) {
		$this->insert ( $info );
	}
	
	// Prende il numero di piani a partire dal codice di un edificio
	public function getFloorNumberByCodeBuilding($info) {
		$select = $this->select ()->where("code = ?", $info);
		return $this->fetchRow( $select );
	}
	
	// Associata staff code all'utente
	public function associateBuilding($info, $code){
		$where = "code = $code";
		$this->update($info, $where);
	}
	
	// Prende tutti gli edifici che non sono stati associati
	public function viewBuildingUnAssociate(){
		$select = $this->select()->where("staff_code IS NULL");
		return $this->fetchAll($select);
	}
	
	public function deleteAssociationBuilding($code){
		$where = "code = $code";
		$this->update(array('staff_code' => NULL), $where);
	}
}

