<?php
class UserController extends Zend_Controller_Action {
	protected $_form;
	protected $_userModel;
	protected $_authService;
	public function init() {
		$this->_helper->layout->setLayout ( 'main' );
		$this->_authService = new Application_Service_Auth ();
		$this->_userModel = new Application_Model_User();
	}
	public function indexAction() {
		$res = $this->_userModel->getUserByName($this->_authService->getIdentity()->user);
		$position = $res['position'];
		$this->view->assign(array('position' => $position));
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
	private function getPositionForm() {
		$urlHelper = $this->_helper->getHelper ( 'url' );
		$this->_form = new Application_Form_User_Position_Register ();
		$this->_form->setAction ( $urlHelper->url ( array (
				'controller' => 'user',
				'action' => 'addposition' 
		), 'default' ) );
		return $this->_form;
	}
	public function addpositionAction() {
		$this->view->registerpositionForm = $this->getPositionForm ();
		
		if(!$this->getRequest()->isPost()){
			$this->_helper->redirector('index');
		}
		 
		$form = $this->_form;
		if(!$form->isValid($_POST)){
			$form->setDescription('Attenzione: dati inseriti errati');
			return $this->render('registerposition');
		}
		$values = $form->getValues();
		$data = array('position' => $values['zone_number']);
		$this->_userModel->addPosition($data, $this->_authService->getIdentity()->user );
		$this->_helper->redirector('index');
	}
	
	public function floornumberAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		$param = (int)$this->_getParam('code');
		
		$res = $this->_userModel->getBuildingFloor($param);
		
		
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
	
	public function zonenumberAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		$param = (int)$this->_getParam('code');
		
		$res = $this->_userModel->getFloorZone($param)->toArray();
		
		$floor = $this->_userModel->getFloorByCode($param);
		
		$res['floor_map']= $floor['image'];
		
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
	
	public function deletepositionAction(){
		$this->_userModel->deletePosition($this->_authService->getIdentity()->user);
		$this->_helper->redirector('index');
	}
	
	/**** Fine registra la posizione ****/
	public function escapeAction() {
	}
	
	/**
	 * ** Segnala pericolo ***
	 */
	public function alertAction() {
		$this->view->alertForm = $this->getAlertForm ();
	}
	private function getAlertForm() {
		$urlHelper = $this->_helper->getHelper ( 'url' );
		$this->_form = new Application_Form_User_Alert_Alert ();
		$this->_form->setAction ( $urlHelper->url ( array (
				'controller' => 'user',
				'action' => 'addalert' 
		), 'default' ) );
		return $this->_form;
	}
	public function addalertAction() {
	}
	/**
	 * ** Fine segnala pericolo ***
	 */
	
	/***** Profile ****/
	public function viewprofileAction() {
	}
	public function modifyprofileAction() {
		$this->view->modifyprofileForm = $this->modifyProfileForm ();
		$user = $this->_getparam ( 'user' );
		$user = $this->_userModel->getUserByName ( $user );
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
		$this->_userModel->updateUser ( $values, $code );
		$this->_helper->redirector ( 'viewprofile' );
	}
	private function modifyProfileForm() {
		$urlHelper = $this->_helper->getHelper ( 'url' );
		$this->_form = new Application_Form_User_User_Update ();
		$this->_form->setAction ( $urlHelper->url ( array (
				'controller' => 'user',
				'action' => 'updateuser' 
		), 'default' ) );
		return $this->_form;
	}

	/**** End Profile ****/
}