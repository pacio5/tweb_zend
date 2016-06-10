<?php
class Application_Model_User extends App_Model_Abstract {
	
	/**** Edificio ****/

	public function viewBuilding() {
		return $this->getResource ( 'Building' )->getBuilding ();
	}
	
	public function getFloorNumberByCodeBuilding($info){
		return $this->getResource('Building')->getFloorNumberByCodeBuilding($info);
	}
	
	public function getBuildingByCode($info){
		return $this->getResource('Building')->getBuildingByCode($info);
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
	public function viewFloor()
	{
		return $this->getResource('Floor')->getFloor();
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
	
	// Cancella Posizione
	
	public function deletePosition($info){
		return $this->getResource('User')->deletePosition($info);
	}
	
	/**** Fin Registra Posizione ****/
	
	/**** Zone ****/
	public function getZoneByCode($info){
		return $this->getResource('Zone')->getZoneByCode($info);
	}
	
	/**** Fine zone ****/
	
	/**** Visualizza Via di Fuga ****/
	public function getEscapeByZone($info){
		return $this->getResource('Zone')->getEscapeByZone($info);
	}
	/**** Fine Visualizza Via di Fuga ****/
	/**** Segnala pericolo ****/
	public function addAlert($info){
		return $this->getResource('Alert')->addAlert($info);
	}
	
	/**** Fine Segnala Pericolo ****/
	public function verifyAlert($position){
		return $this->getResource('Alert')->verifyAlert($position);
	}
	
}