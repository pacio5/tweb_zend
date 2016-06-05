<?php

class StaffController extends Zend_Controller_Action
{
	protected $_staffModel;
	protected $_authService;
	
	public function init()
	{
		$this->_helper->layout->setLayout('admin');
		$this->_staffModel = new Application_Model_Staff();
		$this->_authService = new Application_Service_Auth();
	}
	
	public function indexAction(){
		
	}
	
	public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index', 'public');
	}
	
	public function viewprofileAction(){
    }
}
