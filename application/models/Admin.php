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
	
	public function modifyBuilding($info)
	{
		return $this->getResource('Building')->modifyBuilding($info);
	}
	
	public function viewBuilding()
	{
		return $this->getResource('Building')->getBuilding();
	}
	
	/**** Fine Edifici ****/
	
	
	/**** Staff ****/
	public function viewStaff() {
		return $this->getResource('Staff')->getStaff();
	}
	
	public function deleteStaff($info) {
		return $this->getResource('Staff')->deleteStaff($info);
	}
	
	public function modifyStaff($info) {
		return $this->getResource('Staff')->modifyStaff($info);
	}
	
	public function newStaff($info) {
		return $this->getResource('Staff')->insertStaff($info);
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
	
	public function modifyUser($info){
		return $this->getResource('User')->modifyUser($info);
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
	
	public function modifyFaq($info){
		return $this->getResource('Faq')->modifyFaq($info);
	}
	
	/**** Fine F.A.Q ****/
	
	public function getUserByName($info)
	{
		return $this->getResource('User')->getUserByName($info);
	}

}