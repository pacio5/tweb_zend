<?php

class Application_Resource_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary  = 'user';
    protected $_rowClass = 'Application_Resource_User_Item';
	
	public function init()
    {
    }
      
    // Inserisce un nuovo utente nel db
    public function insertUser($info){
    	$this->insert ( $info );
    }
    
    // Cancella user
    public function deleteUser($user) {
    	$where = " user = '$user'";
    	return $this->delete($where);
    }
    
    // Ripesca tutti gli utente con role user
    public function getUser(){
    	$select = $this->select()->where('role = ?', 'user')->order('name');
    	return $this->fetchAll($select);
    }
    
    public function getUserByName($usrName)
    {
        return $this->fetchRow($this->select()->where('user = ?', $usrName))->toArray();
    }
    
    public function updateUser($info, $code){
    	$where = "user = '$code'";
    	$this->update($info, $where);
    }
}