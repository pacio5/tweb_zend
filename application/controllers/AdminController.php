 <?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_authService;
	protected $_formBuilding, $_formStaff, $_formUser, $_formfaq;
	

    public function init()
    {
    	$this->_helper->layout->setLayout('admin');
    	$this->_adminModel = new Application_Model_Admin();
    	$this->view->buildingForm = $this->getBuildingForm();
    	$this->view->newstaffForm = $this->getStaffForm();
    	$this->view->newuserForm = $this->getUserForm();
    	$this->view->newfaqForm = $this->getFaqForm();
    	
    	$this->_authService = new Application_Service_Auth();
  
    }

    public function indexAction()
    {
    	
    }
    
    // Action per effettuare il logout
    public function logoutAction()
    {
    	$this->_authService->clear();
    	return $this->_helper->redirector('index','public');
    }
    
    /***** Building *****/
    
    // Action per visualizzare la form di inserimento di un edificio
    public function newbuildingAction(){
    	
    }
    
    // Action per validare e caricare l'edificio
    public function addbuildingAction(){
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_formBuilding;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newbuilding');
    	}
    	
    	$values = $form->getValues();
    	$this->_adminModel->newBuilding($values);
    	$this->_helper->redirector('index');
    }
    
    // Genera il form per gli edifici
    private function getBuildingForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_formBuilding = new Application_Form_Admin_Building_Add();
    	$this->_formBuilding->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addbuilding'),
    			'default'
    			));
    	return $this->_formBuilding;
    }
    
    /* Visualizza Edifici */
    public function viewbuildingAction(){
    	
    	// Recupera gli edifici dal database
   		$building = $this->_adminModel->viewBuilding();
   		// Passo alla view gli edifici
   		$this->view->assign(array(
   				'building' => $building));
   		
    }
    
    public function deletebuildingAction(){
    	$code = $this->_getParam('code');
    	$result = $this->_adminModel->deleteBuilding($code);
    	$this->_helper->redirector('viewbuilding');
    }
    
    /**** End Building ****/
    
    
    /**** Staff ****/
    // Action per visualizzare la form di inserimento dello staff
    public function newstaffAction(){
    	 
    }
    
    // Action per validare e caricare lo staff
    public function addstaffAction(){
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	 
    	$form = $this->_formStaff;
    	 
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newstaff');
    	}
    	 
    	$values = $form->getValues();
    	$values['role'] = 'staff';
    	$this->_adminModel->newStaff($values);
    	$this->_helper->redirector('viewstaff');
    }
    
    public function viewstaffAction(){
    	$staff = $this->_adminModel->viewStaff();
    	$this->view->assign(array('staff' => $staff));
    }
    
    public function deletestaffAction(){
    	$staff_user = $this->_getParam('user');
    	$this->_adminModel->deleteStaff($staff_user);
    	$this->_helper->redirector('viewstaff');
    	
    }
    
    private function getStaffForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_formStaff = new Application_Form_Admin_Staff_Add();
    	$this->_formStaff->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addstaff'),
    			'default'
    			));
    	return $this->_formStaff;
    }
    
    /**** Fine Staff ****/
    
    /**** Utente registrato ****/
   
    public function newuserAction(){
    	
    }
    
    public function adduserAction(){
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_formUser;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newuser');
    	}
    	
    	$values = $form->getValues();
    	$values['role'] = 'user';
    	$this->_adminModel->newUser($values);
    	$this->_helper->redirector('viewuser');
    	
    }
    
    public function viewuserAction(){
    	$user = $this->_adminModel->viewUser();
    	$this->view->assign(array('user' => $user));
    }
    
    public function deleteuserAction(){
    	$user = $this->_getParam('user');
    	$this->_adminModel->deleteUser($user);
    	$this->_helper->redirector('viewuser');
    }
    
    private function getUserForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_formUser = new Application_Form_Admin_User_Add();
    	$this->_formUser->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'adduser'),
    			'default'
    	));
    	return $this->_formUser;
    }
    
    /**** Fine Utente Registrato ****/
    
    /**** Faq ****/
    // Visualizza la form di inserimento di una faq
    public function newfaqAction(){
    	
    }
    
    // Action per caricare una faq
    public function addfaqAction(){
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	 
    	$form = $this->_formFaq;
    	 
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newfaq');
    	}
    	 
    	$values = $form->getValues();
    	$this->_adminModel->newFaq($values);
    	$this->_helper->redirector('index');
    	
    }
    
    // Visualizza tutte le faq inserite
    public function viewfaqAction(){
    	$faq = $this->_adminModel->viewFaq();
    	$this->view->assign(array('faq' => $faq));
    }
    
    public function deletefaqAction(){
    	$faq = $this->_getParam('code');
    	$this->_adminModel->deleteFaq($faq);
    	$this->_helper->redirector('viewfaq');
    }
    
    private function getFaqForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_formFaq = new Application_Form_Admin_Faq_Add();
    	$this->_formFaq->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addfaq'),
    			'default'
    			));
    	return $this->_formFaq;
    }
    
    /**** End Faq ****/
    
    /**** Profile ****/
    
    public function viewprofileAction(){
    	
    	$profile = $this->_adminModel->getUserByName($info);
    }
    
    
    /**** End Profile ****/

}