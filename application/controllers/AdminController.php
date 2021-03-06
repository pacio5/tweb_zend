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
    	$alert = $this->_adminModel->viewAlert();
    	// Passo alla view gli edifici
    	$this->view->assign(array('alert' => $alert));
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
    	$floor = $this->_adminModel->getBuildingFloor($code);
    	
    	$zone = $this->_adminModel->getFloorZone((int)$floor->code);
    	
    	foreach ($zone as $zon) {
    		$this->_adminModel->deleteEscapeByZone($zon->code);
    	}
    	
    	foreach ($floor as $fl) {
    		$this->_adminModel->deleteZoneByFloor($fl->code);
    	}
    	 
    	$result = $this->_adminModel->deleteFloorByBuildingCode((int)$code);
    	
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
    
    
    public function associatebuildingAction(){
    	$this->view->associateBuildingForm = $this->associateBuildingForm();
    }
    
    private function associateBuildingForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_Building_Associate();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'associate'),
    			'default'
    			));
    	return $this->_form;
    }
    
    public function associateAction(){
    	$this->view->associateBuildingForm = $this->associateBuildingForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	 
    	$form = $this->_form;
    	 
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('associatebuilding');
    	}
    	 
    	$values = $form->getValues();
    	
    	$staff_code =array('staff_code' => $values['staff_code']);
    	
    	$building = $values['building_code'];
    	
    	$i = 0;
    	while($building[$i]!=NULL){
    		$this->_adminModel->associateBuilding($staff_code, $building[$i++]);
    	}
    	
    	$this->_helper->redirector('viewbuilding');
    }
    
    public function deleteassociationAction(){
    	$code = $this->_getParam('code');
    	$result = $this->_adminModel->deleteAssociationBuilding($code);
    	$this->_helper->redirector('viewbuilding');
    }
    
    /**** End Building ****/
    
    
    /***** Floor *****/
    
    // Action per visualizzare la form di inserimento di un piano
    public function newfloorAction(){
    	$this->view->floorForm = $this->getFloorForm();
    }
    
    // Action per validare e caricare l'edificio
    public function addfloorAction(){
    	$this->view->floorForm = $this->getFloorForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	
    	$form = $this->_form;
    	
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newfloor');
    	}
    	
    	$values = $form->getValues();
    	// Recupero il piano tramite l'edificio e il numero piano, per estrarre il codice per creare le zone
    	$building = $values['building_code'];
    	$floor = $values['number'];
    	$this->_adminModel->newFloor($values);
    	
    	$res = $this->_adminModel->verifyFloor($building, $floor );
    	// Creo automaticamente le zone
    	$zone = $values['zone_number'];
    	
    	
    	for($i = 1; $i <= $zone; $i++){
    		$data = array('floor_code' => $res['code'], 'number' => $i );
    		$this->_adminModel->newZone($data);
    	}
    	$this->_helper->redirector('viewfloor');
    }
    
    // Genera il form per i piani
    private function getFloorForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_Floor_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addfloor'),
    			'default'
    			));
    	return $this->_form;
    }
    
    /* Visualizza Piani */
    public function viewfloorAction(){
    	
    	// Recupera gli edifici dal database
   		$floor = $this->_adminModel->viewFloor();
		$building = $this->_adminModel->viewBuilding();
   		// Passo alla view gli edifici
   		$this->view->assign(array(
   				'floor' => $floor));
		$this->view->assign(array(
		        'building' => $building));
   		
    }
    
    public function deletefloorAction(){
    	$code = $this->_getParam('code');
    	
    	$zone = $this->_adminModel->getFloorZone($code);
    	foreach ($zone as $zon) {
    		$this->_adminModel->deleteEscapeByZone($zon->code);
    	}
    	
    	$this->_adminModel->deleteZoneByFloor($code);
    	
    	$result = $this->_adminModel->deleteFloor($code);
    	$this->_helper->redirector('viewfloor');
    }
    
	public function completefloorAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		
		$param =(int) $this->_getParam('code');
		
		$res = $this->_adminModel->getFloorNumberByCodeBuilding($param);
		
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
	
	
	public function validatefloorAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		
		$floor = (int)$this->_getParam('floor');
		$building = (int)$this->_getParam('building');
		$res = $this->_adminModel->verifyFloor($building, $floor);
		if(count($res) > 0)
			$res = true;
		else $res = false;
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
	
	public function floornumberAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	
		$param = (int)$this->_getParam('code');
	
		$res = $this->_adminModel->getBuildingFloor($param);
	
	
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
	
	public function zonenumberAction(){
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	
		$param = (int)$this->_getParam('code');
	
		$res = $this->_adminModel->getFloorZone($param)->toArray();
	
		$this->getResponse()->setHeader('Content-type','application/json')->setBody(Zend_Json::encode($res));
	}
    
    /**** End Floor ****/
    
    
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
    
    public function modifystaffAction(){
    	$this->view->modifystaffForm = $this->modifyStaffForm();
    	$code = $this->_getParam('user');
    	$user = $this->_adminModel->getStaffByUser($code);
    	$form = $this->_form;
    	$form->populate($user);
    }
    
    public function updatestaffAction(){
    	$this->view->modifystaffForm = $this->modifyStaffForm();
    	$code = $this->_getParam('user');
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	 
    	$form = $this->_form;
    	 
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('modifystaff');
    	}
    	 
    	$values = $form->getValues();
    	$this->_adminModel->updateStaff($values, $code);
    	$this->_helper->redirector('viewstaff');
    }
    
    private function modifyStaffForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_Staff_Add();
    	$this->_form-> setName('updateStaff');
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'updatestaff'),
    			'default'
    			));
    	return $this->_form;
    }
    /**** Fine Staff ****/
    
    /**** Escape ****/
    /* Visualizza Vie di Fuga */
    public function viewescapeAction(){
    
    	// Recupera gli edifici dal database
    	$escape_map = $this->_adminModel->viewEscape();
    	// Passo alla view le vie di fuga
    	$this->view->assign(array(
    			'escape_map' => $escape_map));
    
    }
    public function newescapeAction(){
    	$this->view->escapeForm = $this->getEscapeForm();
    }
    
    // Genera il form per vie di fuga
    private function getEscapeForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_Escape_Add();
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'addescape'),
    			'default'
    			));
    	return $this->_form;
    }
    
    //Action per validare e caricare la via di fuga
    public function addescapeAction(){
    	$this->view->escapeForm = $this->getEscapeForm();
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    	 
    	$form = $this->_form;
    	 
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('newescape');
    	}
    	 
    	$values = $form->getValues();
    	
    	$data = array('zone_code' => $values['zone_code'] , 'image'=> $values['image']);
    	$this->_adminModel->newEscape($data);
    	$this->_helper->redirector('viewescape');
    }
    
    public function deleteescapemapAction(){
    	$param = $this->_getParam('code');
    	$this->_adminModel->deleteEscape($param);
    	$this->_helper->redirector('viewescape');
    }
    
    /**** Fine Escape ****/
    
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
    
    private function modifyUserForm(){
    	$urlHelper = $this->_helper->getHelper('url');
    	$this->_form = new Application_Form_Admin_User_Add();
    	$this->_form-> setName('updateUser');
    	$this->_form->setAction($urlHelper->url(array(
    			'controller' => 'admin',
    			'action' => 'updateuser'),
    			'default'
    			));
    	return $this->_form;
    }
    
    public function modifyuserAction(){
    	$this->view->modifyuserForm = $this->modifyUserForm();
    	$code = $this->_getParam('user');
    	$user = $this->_adminModel->getUserByName($code);
    	$form = $this->_form;
    	$form->populate($user->toArray());
    }
    
    public function updateuserAction(){
    	$this->view->modifyuserForm = $this->modifyUserForm();
    	$code = $this->_getParam('user');
    	if(!$this->getRequest()->isPost()){
    		$this->_helper->redirector('index');
    	}
    
    	$form = $this->_form;
    
    	if(!$form->isValid($_POST)){
    		$form->setDescription('Attenzione: dati inseriti errati');
    		return $this->render('modifyuser');
    	}
    
    	$values = $form->getValues();
    	$this->_adminModel->updateUser($values, $code);
    	$this->_helper->redirector('viewuser');
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
    }
    
    /**** End Profile ****/

}