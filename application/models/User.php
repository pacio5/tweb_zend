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
}