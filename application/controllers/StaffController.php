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
		// Recupera le segnalazioni dal database
   		$alert = $this->_staffModel->viewAlert();
   		// Passo alla view gli edifici
   		$this->view->assign(array(
   				'alert' => $alert));
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
	
	/**** AJAX ****/
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
	
	/**** Fine AJAX ****/
	
	
	 
	//***** Segnalazioni *****/
        
    public function deletealertAction(){
    	$code = $this->_getParam('code');
    	$result = $this->_staffModel->deleteAlert($code);
    	$this->_helper->redirector('index');
    }
	
	public function evacuationAction(){
		$code = $this->_getParam('code');
		$data = array('progress' => 'Gestito');
    	$this->_staffModel->evacuation($data, (int)$code);
		$this->_helper->redirector('index');
	}
	
	public function singleevacuationAction(){
		$this->view->modifyMapForm = $this->getModifyMapForm();
	}
	
	private function getModifyMapForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Staff_Associate_Modify();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'staff',
    			'action' => 'changemap'),
    			'default'
    			));
    	return $this->_form;
    }
	
	public function changemapAction(){
		$this->view->modifyMapForm = $this->getModifyMapForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_form;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('index');
    	}
    	
		$name = $form->getValues();
		$escape = array('escape_map' => $name['image']);
    	$progress = array('progress' => 'Gestito');
		$code = $this->_getParam('code');
		$zone_code = $this->_getParam('zone_code');
    	$this->_staffModel->changeMap($escape,(int)$zone_code);
		$this->_staffModel->evacuation($progress, (int)$code);
    	$this->_helper->redirector('index');
	}
	
	/**** Segnala pericolo ****/
	public function alertAction() {
		$this->view->alertForm = $this->getAlertForm ();
	}
	private function getAlertForm() {
		$urlHelper = $this->_helper->getHelper ( 'url' );
		$this->_form = new Application_Form_Staff_Alert_Alert ();
		$this->_form->setAction ( $urlHelper->url ( array (
				'controller' => 'staff',
				'action' => 'addalert' 
			 ), 'default' ) );
		return $this->_form;
	}
	
	public function addalertAction() {
		$this->view->alertForm = $this->getAlertForm ();
		
		if(!$this->getRequest()->isPost()){
			$this->_helper->redirector('index');
		}
			
		$form = $this->_form;
		if(!$form->isValid($_POST)){
			$form->setDescription('Attenzione: dati inseriti errati');
			return $this->render('alert');
		}
		
		$values = $form->getValues();
		
		$building = $this->_staffModel->getBuildingByCode((int)$values['building_code']);
		$floor = $this->_staffModel->getFloorByCode((int)$values['floor_number']);
		$zone = $this->_staffModel->getZoneByCode((int)$values['zone_number']);
		
		$data = array(	'building' => $building['name'], 
						'floor' => $floor['number'], 
						'zone' => $zone['number'], 
						'type' => $values['alert'],	
						'user_code' => $this->_authService->getIdentity()->user,
						'progress' => 'Non Gestito',
						'zone_code' => $zone['code']
		);
		
		$this->_staffModel->addAlert($data);
		$this->_helper->redirector('index');
		
	}
	/**** Fine segnala pericolo ****/
    
    /**** Fine Segnalazioni ****/
}
