<?php
class Application_Form_Staff_Associate_Add extends App_Form_Abstract {
		
	protected $_staffModel;
	protected $_authService;
	
	public function init() {
		$this->_authService = new Application_Service_Auth ();
		$this->setMethod ( 'post' );
		$this->setName ( 'associate' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
	
		//Estraggo i nomi degli edifici dal model e li inserisco nella SELECT
		$building = array();
		$building['unselected'] = " -- Select --";
		$this->_staffModel = new Application_Model_Staff();
		$username = $this->_authService->getIdentity()->user;
		$build = $this->_staffModel->viewBuildingByRole($username);
		foreach ($build as $bui) {
			$building[$bui -> code] = $bui->name;
		}
		$this->addElement ( 'select', 'building_code', array (
				'label' => 'Edificio',
				'required' => true,
				'multiOptions' => $building,
		) );
	
		$this->addElement ( 'select', 'floor_number', array (
				'label' => 'Numero Piano',
				'registerInArrayValidator' => false,
				'validators' => array('Int'),
		) );
	
		$this->addElement ( 'select', 'zone_number', array (
				'label' => 'Numero Zona',
				'registerInArrayValidator' => false,
				'validators' => array('Int'),
		) );

		$this->addElement ('select', 'escape_map', array(
		        'label' => 'Planimetrie',
		        'registerInArrayValidator' => false,
				));
		
		$this->addElement ( 'submit', 'register', array (
				'label' => 'Registra', ));
	}
}