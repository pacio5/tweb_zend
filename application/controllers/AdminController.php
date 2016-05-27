 <?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_authService;
	protected $_form;
	

    public function init(){
    	$this->_helper->layout->setLayout('admin');
    	$this->_adminModel = new Application_Model_Admin();
    	$this->_authService = new Application_Service_Auth();
  
    }

    public function indexAction(){
    	
    }
    
    // Action per effettuare il logout
    public function logoutAction(){
    	$this->_authService->clear();
    	return $this->_helper->redirector('index','public');
    }
    
    /***** Building *****/
    
    // Action per visualizzare la form di inserimento di un edificio
    public function newbuildingAction(){
    	$this->view->buildingForm = $this->getBuildingForm();
    }
    
    // Action per validare e caricare l'edificio
    public function addbuildingAction(){
    	$this->view->buildingForm = $this->getBuildingForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_form;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newbuilding');
    	}
    	
    	$values = $form->getValues();
    	$this->_adminModel->newBuilding($values);
    	$this->_helper->redirector('viewbuilding');
    }
    
    public function modifybuildingAction(){
    	$this->view->modifybuildingForm = $this->modifyBuildingForm();
    	$code = $this->_getParam('code');
    	$building = $this->_adminModel->getBuildingByCode($code);
    	$form = $this->_form;
    	$form->populate($building);
    } 
    
    public function updatebuildingAction(){
    	$this->view->modifybuildingForm = $this->modifyBuildingForm();
    	$code = $this->_getParam('code');
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_form;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('modifybulding');
    	}
    	
    	$values = $form->getValues();
    	$this->_adminModel->updateBuilding($values, $code);
    	$this->_helper->redirector('viewbuilding');
    }
    
    // Genera il form per gli edifici
    private function getBuildingForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_Building_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addbuilding'),
    			'default'
    			));
    	return $this->_form;
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
    
    private function modifyBuildingForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_Building_Add();
    	$this->_form-> setName('updateBuilding');
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'updatebuilding'),
    			'default'
    			));
    	return $this->_form;
    }
    
    /**** End Building ****/
    
    
    /**** Staff ****/
    // Action per visualizzare la form di inserimento dello staff
    public function newstaffAction(){
    	$this->view->newstaffForm = $this->getStaffForm();
    }
    
    // Action per validare e caricare lo staff
    public function addstaffAction(){
    	$this->view->newstaffForm = $this->getStaffForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	 
    	$form = $this->_form;
    	 
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
    	$this->_form = new Application_Form_Admin_Staff_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addstaff'),
    			'default'
    			));
    	return $this->_form;
    }
    
    /**** Fine Staff ****/
    
    /**** Utente registrato ****/
   
    public function newuserAction(){
    	$this->view->newuserForm = $this->getUserForm();
    }
    
    public function adduserAction(){
    	$this->view->newuserForm = $this->getUserForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_form;
    	
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
    	$this->_form = new Application_Form_Admin_User_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'adduser'),
    			'default'
    	));
    	return $this->_form;
    }
    
    /**** Fine Utente Registrato ****/
    
    /**** Faq ****/
    // Visualizza la form di inserimento di una faq
    public function newfaqAction(){
    	$this->view->newfaqForm = $this->getFaqForm();
    }
    
    // Action per caricare una faq
    public function addfaqAction(){
    	$this->view->newfaqForm = $this->getFaqForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	 
    	$form = $this->_form;
    	 
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newfaq');
    	}
    	 
    	$values = $form->getValues();
    	$this->_adminModel->newFaq($values);
    	$this->_helper->redirector('viewfaq');
    	
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
    	$this->_form = new Application_Form_Admin_Faq_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addfaq'),
    			'default'
    			));
    	return $this->_form;
    }
    
    public function modifyfaqAction(){
    	$this->view->modifyfaqForm = $this->modifyFaqForm();
    	$code = $this->_getParam('code');
    	$faq = $this->_adminModel->getFaqByCode($code);
    	$form = $this->_form;
    	$form->populate($faq);
    }
    
    public function updatefaqAction(){
    	$this->view->modifyfaqForm = $this->modifyFaqForm();
    	$code = $this->_getParam('code');
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_form;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('modifyfaq');
    	}
    	
    	$values = $form->getValues();
    	$this->_adminModel->updateFaq($values, $code);
    	$this->_helper->redirector('viewfaq');
    }
    

    private function modifyFaqForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_Faq_Add();
    	$this->_form-> setName('updateFaq');
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'updatefaq'),
    			'default'
    			));
    	return $this->_form;
    }
    
    /**** End Faq ****/
    
    /**** Profile ****/
    
    public function viewprofileAction(){
    	
    	$profile = $this->_adminModel->getUserByName($info);
    }
    
    
    /**** End Profile ****/

}