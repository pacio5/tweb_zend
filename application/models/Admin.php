<?php
class Application_Model_Admin extends App_Model_Abstract{

	public function __construct()
	{
	}
	
	/**** Edifici ****/
	public function newBuilding($info)
	{
		return $this->getResource('Building')->insertBuilding($info);
	}
	
	public function deleteBuilding($info)
	{
		return $this->getResource('Building')->deleteBuilding($info);
	}
	
	public function viewBuilding()
	{
		return $this->getResource('Building')->getBuilding();
	}
	
	public function updateBuilding($info, $code)
	{
		return $this->getResource('Building')->updateBuilding($info, $code);
	}
	
	public function getBuildingByCode($info){
		return $this->getResource('Building')->getBuildingByCode($info);
	}
	
	public function associateBuilding($info, $code){
		return $this->getResource('Building')->associateBuilding($info, $code);
	}
	
	public function viewBuildingUnAssociate(){
		return $this->getResource('Building')->viewBuildingUnAssociate();
	}
	
	public function deleteAssociationBuilding($code){
		return $this->getResource('Building')->deleteAssociationBuilding($code);
	}
	
	/**** Fine Edifici ****/
	
	
	/**** Piani ****/
	public function newFloor($info)
	{
		return $this->getResource('Floor')->insertFloor($info);
	}
	
	public function deleteFloor($info)
	{
		return $this->getResource('Floor')->deleteFloor($info);
	}
	
	public function viewFloor()
	{
		return $this->getResource('Floor')->getFloor();
	}
	
	public function updateFloor($info, $code)
	{
		return $this->getResource('Floor')->updateFloor($info, $code);
	}
	
	public function getFloorByCode($info){
		return $this->getResource('Floor')->getFloorByCode($info);
	}
	
	public function getFloorNumberByCodeBuilding($info){
		return $this->getResource('Building')->getFloorNumberByCodeBuilding($info);
	}
	
	public function verifyFloor($building, $floor){
		return $this->getResource('Floor')->verifyFloor($building, $floor);
	}
	
	public function getBuildingFloor($info){
		return $this->getResource('Floor')->getBuildingFloor($info);
	}

	public function deleteFloorByBuildingCode($info){
		return $this->getResource('Floor')->deleteFloorByBuildingCode($info);
	}
	/**** Fine Piani ****/
	
	
	/**** Zone ****/
	public function newZone($info)
	{
		return $this->getResource('Zone')->insertZone($info);
	}
	
	public function viewZone()
	{
		return $this->getResource('Zone')->getZone();
	}
	
	public function getZoneByCode($info){
		return $this->getResource('Zone')->getZoneByCode($info);
	}
	
	public function getFloorZone($info){
		return $this->getResource('Zone')->getFloorZone($info);
	}
	
	public function deleteZoneByFloor($code){
		return $this->getResource('Zone')->deleteZoneByFloor($code);
	}

	/**** Fine Zone ****/
	
	
	/**** Vie di Fuga ****/
	public function newEscape($info)
	{
		return $this->getResource('Escape')->insertEscape($info);
	}
	
	public function viewEscape()
	{
		return $this->getResource('Escape')->getEscape();
	}
	
	public function getEscapeByCode($info){
		return $this->getResource('Escape')->getEscapeByCode($info);
	}
	
	public function deleteEscapeByZone($code){
		return $this->getResource('Escape')->deleteEscapeByZone($code);
	}
	
	public function deleteEscape($info){
		return $this->getResource('Escape')->deleteEscape($info);
	}
	/**** Fine Vie di Fuga ****/


	/**** Staff ****/
	public function viewStaff() {
		return $this->getResource('Staff')->getStaff();
	}
	
	public function deleteStaff($info) {
		return $this->getResource('Staff')->deleteStaff($info);
	}
	
	public function newStaff($info) {
		return $this->getResource('Staff')->insertStaff($info);
	}
	
	public function getStaffByUser($info){
		return $this->getResource('Staff')->getStaffByUser($info);
	}
	
	public function updateStaff($info, $code){
		return $this->getResource('Staff')->updateStaff($info, $code);
	}
	
	/**** Fine Staff ****/
	
	/**** Utente registrato ****/
	
	public function newUser($info){
		return $this->getResource('User')->insertUser($info);
	}
	
	public function viewUser(){
		return $this->getResource('User')->getUser();
	}
	
	public function deleteUser($info){
		return $this->getResource('User')->deleteUser($info);
	}
	
	public function updateUser($info, $code){
		return $this->getResource('User')->updateUser($info, $code);
	}

	public function getUserByName($info)
	{
		return $this->getResource('User')->getUserByName($info);
	}
	
	/**** Fine Utente Registrato ****/
	
	/**** F.A.Q ****/
	
	
	public function newFaq($info){
		return $this->getResource('Faq')->insertFaq($info);
	}
	
	public function viewFaq(){
		return $this->getResource('Faq')->getFaq();
	}
	
	public function deleteFaq($info){
		return $this->getResource('Faq')->deleteFaq($info);
	}
	
	public function getFaqByCode($code){
		return $this->getResource('Faq')->getFaqByCode($code);
	}
	
	public function updateFaq($info, $code){
		return $this->getResource('Faq')->updateFaq($info, $code);
	}
	
	/**** Fine F.A.Q ****/
	/**** Alert ****/
	public function viewAlert()
	{
		return $this->getResource('Alert')->getAlert();
	}

}