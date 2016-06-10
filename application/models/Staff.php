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
	
	public function newAssociate($info, $code)
	{
		return $this->getResource('Zone')->associateEscape($info, $code);
	}
	/**** Fine profilo utente ****/
	
	public function viewBuilding()
	{
		return $this->getResource('Building')->getBuilding();
	}
	
	public function viewEscape()
	{
		return $this->getResource('Escape')->getEscape();
	}
	
	public function getBuildingFloor($info){
		return $this->getResource('Floor')->getBuildingFloor($info);
	}
	
	public function getFloorByCode($info){
		return $this->getResource('Floor')->getFloorByCode($info);
	}
	
	public function getFloorZone($info){
		return $this->getResource('Zone')->getFloorZone($info);
	}
	
	//Estrae tutte le righe delle vie di fuga
	public function getEscapeMap($info){
		return $this->getResource('Escape')->getEscapeByZoneCode($info);
	}
	
	//Estrae una singola riga delle vie di fuga
	public function getOnlyEscapeMap($info){
		return $this->getResource('Escape')->getOnlyEscapeByZoneCode($info);
	}
	
	/**** Segnalazioni ****/
	
	public function viewAlert()
	{
		return $this->getResource('Alert')->getAlert();
	}
	
	public function updateAlert($info, $code)
	{
		return $this->getResource('Alert')->updateAlert($info, $code);
	}
	
	public function getAlertByCode($info){
		return $this->getResource('Alert')->getAlertByCode($info);
	}
	
	public function deleteAlert($info)
	{
		return $this->getResource('Alert')->deleteAlert($info);
	}
	
	public function evacuation($info, $code){
		return $this->getResource('Alert')->evacuation($info, $code);
	}
	
	public function changeMap($info,$code){
		return $this->getResource('Zone')->changeMap($info, $code);
	}
	
	public function viewNameMap()
	{
		return $this->getResource('Escape')->getEscape();
	}
	/**** Fine Segnalazioni ****/
}
