<?php
class Application_Resource_Alert extends Zend_Db_Table_Abstract {
	protected $_name = 'alert';
	protected $_primary = 'code';
	protected $_rowClass = 'Application_Resource_Alert_Item';
	public function init() {
	}

	public function addAlert($info){
		$this->insert($info);
	}
	
	// Cancella segnalazione
    public function deleteAlert($code) {
    	$where = " code = '$code'";
    	return $this->delete($where);
    }
    
    // Ripesca tutte le segnalazioni, eventualmente paginati e ordinati
    public function getAlert(){
    	$select = $this->select()->order('code');
    	return $this->fetchAll($select);
    }
    
    public function getAlertByCode($info)
    {
    	$select = $this->select ()->where('code = ?', $info);
        return $this->fetchRow( $select )->toArray();
    }
    
    public function updateAlert($info, $code){
    	$where = "code = '$code'";
    	$this->update($info, $where);
    }
	
	public function evacuation($info, $code){
	    $where = "code = $code";
		$this->update($info, $where);
	}
	
	public function verifyAlert($position){
		$select = $this->select()->where('zone_code = ?', $position)->where("progress = 'GESTITO'");
		return $this->fetchAll($select);
	}
}
