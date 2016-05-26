<?php
class Application_Resource_Faq extends Zend_Db_Table_Abstract {
	protected $_name = 'faq';
	protected $_primary = 'code';
	protected $_rowClass = 'Application_Resource_Staff_Item';
	public function init() {
	}
	
	// Estrae tutte le faq, eventualmente paginate ed ordinate
	public function getFaq() {
		$select = $this->select ()->order ( 'code' );
		return $this->fetchAll ( $select );
	}
	
	// Cancella una faq dal database
	public function deleteFaq($info) {
		$where = "code = $info";
		return $this->delete($where);
	}
	
	// inserisce una nuova faq
	public function insertFaq($info) {
		$this->insert ( $info );
	}
	
}