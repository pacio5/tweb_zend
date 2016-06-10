<?php

class StaffController extends Zend_Controller_Action
{
	protected $_staffModel;
	protected $_authService;
	protected $_form;
	
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
	
	/***** Profile ****/
	public function viewprofileAction() {
	}
	public function modifyprofileAction() {
		$this->view->modifyprofileForm = $this->modifyProfileForm ();
		$user = $this->_getparam ( 'user' );
		$user = $this->_staffModel->getUserByName ( $user );
		$form = $this->_form;
		$form->populate ( $user->toArray () );
	}
	public function updateuserAction() {
		$this->view->modifyprofileForm = $this->modifyProfileForm ();
		$code = $this->_getParam ( 'user' );
		if (! $this->getRequest ()->isPost ()) {
			$this->_helper->redirector ( 'index' );
		}
	
		$form = $this->_form;
	
		if (! $form->isValid ( $_POST )) {
			$form->setDescription ( 'Attenzione: dati inseriti errati' );
			return $this->render ( 'modifyprofile' );
		}
	
		$values = $form->getValues ();
		$this->_staffModel->updateUser ( $values, $code );
		$this->_helper->redirector ( 'viewprofile' );
	}
	private function modifyProfileForm() {
		$urlHelper = $this->_helper->getHelper ( 'url' );
		$this->_form = new Application_Form_Staff_User_Update ();
		$this->_form->setAction ( $urlHelper->url ( array (
				'controller' => 'staff',
				'action' => 'updateuser'
		), 'default' ) );
		return $this->_form;
	}
	
	/**** End Profile ****/
	/**** Associate, associazione zona-fuga ****/
	
	public function associateAction(){
		$this->view->associateForm = $this->getAssociateForm();
	}
	
	private function getAssociateForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Staff_Associate_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'staff',
    			'action' => 'addassociate'),
    			'default'
    			));
    	return $this->_form;
    }

	public function addassociateAction(){
    	$this->view->associateForm = $this->getAssociateForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_form;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('associate');
    	}
    	
    	$values = $form->getValues();
		$data = array('escape_map' => $values['escape_map']);
    	$this->_staffModel->newAssociate($data, (int)$values['zone_number']);
    	$this->_helper->redirector('index');
    }
	
	public function floornumberAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		$param = (int)$this->_getParam('code');
		
		$res = $this->_staffModel->getBuildingFloor($param);
		
		
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
	
	public function zonenumberAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		$param = (int)$this->_getParam('code');
		
		$res = $this->_staffModel->getFloorZone($param)->toArray();
		
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}

	public function escapemapAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		$param = (int)$this->_getParam('code');
		
		$res = $this->_staffModel->getEscapeMap($param);
		
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
	
	public function onlyescapemapAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		$param = (int)$this->_getParam('code');
		
		$res = $this->_staffModel->getOnlyEscapeMap($param);
		
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
}
