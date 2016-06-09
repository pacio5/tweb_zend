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
    
    // Recupera un utente dall'username
    public function getUserByName($user)
    {
        return $this->fetchRow($this->select()->where('user = ?', $user));
    }
    
    // Aggiorna L'utente
    public function updateUser($info, $code){
    	$where = "user = '$code'";
    	$this->update($info, $where);
    }
    
    // Aggiunge la posizione dell'utente
    public function addPosition($values, $code){
    	$where = "user = '$code'";
    	$this->update($values, $where);
    }
    
    // Cancella la posizione
    public function deletePosition($info){
    	$where = "user = '$info'";
    	$this->update(array('position' => NULL), $where);
    }
}