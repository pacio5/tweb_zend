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
	
	public function getBuildingFloor($info){
		return $this->getResource('Floor')->getBuildingFloor($info);
	}
	
	public function getFloorZone($info){
		return $this->getResource('Zone')->getFloorZone($info);
	}
	
	public function getFloorByCode($info){
		return $this->getResource('Floor')->getFloorByCode($info);
	}
	
	/**** Fine Piani ****/
	
	/**** Registra posizione ****/
	public function addPosition($values, $code){
		return $this->getResource('User')->addPosition($values, $code);
	}
}