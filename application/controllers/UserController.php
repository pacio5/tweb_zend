<?php
class UserController extends Zend_Controller_Action {
	protected $_form;
	public function init() {
		$this->_helper->layout->setLayout ( 'main' );
		$this->_authService = new Application_Service_Auth ();
	}
	public function indexAction() {
	}
	public function logoutAction() {
		$this->_authService->clear ();
		return $this->_helper->redirector ( 'index', 'public' );
	}
	
	/**** Registra la posizione ****/
	public function registerpositionAction() {
		$this->view->registerpositionForm = $this->getPositionForm ();
	}
	
	// Genera il form per registrare la posizione
	private function getPositionForm(){
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Position_Register();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'user',
				'action' => 'addposition'),
				'default'
				));
		return $this->_form;
	}
	
	public function addpositionAction(){
		
	}
	
	/**** Fine registra la posizione ****/
	
	public function escapeAction() {
	}
	
	
	/**** Segnala pericolo ****/
	
	public function alertAction() {
		$this->view->alertForm = $this->getAlertForm ();
	}
	
	
	private function getAlertForm(){
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Alert_Alert();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'user',
				'action' => 'addalert'),
				'default'
				));
		return $this->_form;
	}
	
	public function addalertAction(){
		
	}
	/**** Fine segnala pericolo ****/
}