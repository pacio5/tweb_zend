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
	
	/**** Fine Edifici ****/
	
	
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
	
	public function getUserByUser($info){
		return $this->getResource('User')->getUserByUser($info);
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
	
	public function getUserByName($info)
	{
		return $this->getResource('User')->getUserByName($info);
	}

}