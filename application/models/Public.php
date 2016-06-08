<?php
class Application_Model_Public extends App_Model_Abstract{

	public function __construct()
	{
	}
	
	public function newUser($info){
		return $this->getResource('User')->insertUser($info);
	}
	
	public function viewFaq(){
		return $this->getResource('Faq')->getFaq();
	}
	
	public function getBuilding(){
		return $this->getResource('Building')->getBuilding();
	}
	

}