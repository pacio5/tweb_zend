<?php
class Application_Model_User extends App_Model_Abstract {
	
	/**** Edificio ****/

	public function viewBuilding() {
		return $this->getResource ( 'Building' )->getBuilding ();
	}
	
	public function viewFloor()
	{
		return $this->getResource('Floor')->getFloor();
	}
	
	/**** Fine Edificio ****/
	
	/**** Profilo utente ****/

	public function updateUser($info, $code){
		return $this->getResource('User')->updateUser($info, $code);
	}
	
	public function getUserByName($info)
	{
		return $this->getResource('User')->getUserByName($info);
	}
	
	/**** Fine profilo utente ****/
	
	/**** Piani ****/
	public function getFloorNumberByCodeBuilding($info){
		return $this->getResource('Building')->getFloorNumberByCodeBuilding($info);
	}
}