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
}
