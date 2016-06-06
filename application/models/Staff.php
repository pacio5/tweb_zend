<?php
class Application_Model_Staff extends App_Model_Abstract
{
	public function __construct()
	{
		
	}
	
	/**** Profilo utente ****/
	
	public function updateUser($info, $code){
		return $this->getResource('User')->updateUser($info, $code);
	}
	
	public function getUserByName($info)
	{
		return $this->getResource('User')->getUserByName($info);
	}
	
	/**** Fine profilo utente ****/
}
