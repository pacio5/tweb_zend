<?php

class PublicController extends Zend_Controller_Action
{
	protected $_publicModel;
	protected $_authService;
	protected $_form;
	
    public function init(){
    	$this->_helper->layout->setLayout('main');
    	$this->_publicModel = new Application_Model_Public();
    	$this->_authService = new Application_Service_Auth();
    }

    public function indexAction(){
    	if($this->_authService->getIdentity())
    		return $this->_helper->redirector('index', $this->_authService->getIdentity()->role);
    }
    
    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
    }
    /**** Login ****/
    public function loginAction(){
    	$this->view->loginForm = $this->getLoginForm();
    }
    
    public function authenticateAction(){
    	$this->view->loginForm = $this->getLoginForm();
    	$request = $this->getRequest();
    	if(!$request->isPost()){
    		return $this->_helper->redirector('login');
    	}
    	$form = $this->_form;
    	if (!$form->isValid($request->getPost())) {
    		$form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
    		return $this->render('login');
    	}
    	if (false === $this->_authService->authenticate($form->getValues())) {
    		$form->setDescription('Autenticazione fallita. Riprova');
    		return $this->render('login');
    	}
    	$role = $this->_authService->getIdentity()->role;
    	return $this->_helper->redirector('index', $this->_authService->getIdentity()->role);
    }
    
    private function getLoginForm()
    {
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Public_Auth_Login();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'public',
    			'action' => 'authenticate'),
    			'default'
    			));
    	return $this->_form;
    }
    
    /**** Fine Login ****/
    
    /**** Registrazione ****/
    public function registrationAction(){
    	$this->view->registrationForm = $this->getRegistrationForm();
    }
    
    public function entryAction(){
    	$this->view->registrationForm = $this->getRegistrationForm();
    	$request = $this->getRequest();
    	if(!$request->isPost()){
    		return $this->_helper->redirector('registration');
    	}
    	$form = $this->_form;
    	if (!$form->isValid($request->getPost())) {
    		$form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
    		return $this->render('registration');
    	}
    	
    	$values = $form->getValues();
    	$values['role'] = 'user';
    	$this->_publicModel->newUser($values);
    	$this->_helper->redirector('index');
    }
    
    private function getRegistrationForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Public_Registration_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'public',
    			'action' => 'entry'),
    			'default'
    	));
    	return $this->_form;
    }
    /**** Fine Registrazione ****/
    
    /**** Contatti ****/
    
    public function contactAction(){
    }
    /**** Fine Contatti ****/
    
    /**** F.A.Q ****/
    
    public function faqAction(){
    	$faq = $this->_publicModel->viewFaq();
    	$this->view->assign(array('faq' => $faq));
    }
    
    /**** Fine F.A.Q ****/
    
    /**** Visualizza Edifici ****/
    public function viewbuildingAction(){
    	$building = $this->_publicModel->getBuilding();
    	$this->view->assign(array('building' => $building));
    }

}

