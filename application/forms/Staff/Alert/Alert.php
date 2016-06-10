<?php
class Application_Form_Staff_Alert_Alert extends App_Form_Abstract {
	
	protected $_staffModel;
	protected $_authService;
	
	public function init() {
		$this->_authService = new Application_Service_Auth ();
		$this->setMethod ( 'post' );
		$this->setName ( 'registrer' );
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
		
		$alert = array("terremoto"=>"Terremoto", "incendio"=>"Incendio", "allagamento"=>"Allagamento");
		$this->addElement ( 'select', 'building_code', array (
				'label' => 'Edificio',
				'required' => true,
				'multiOptions' => $building,
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'select', 'floor_number', array (
				'label' => 'Numero Piano',
				'registerInArrayValidator' => false,
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'select', 'zone_number', array (
				'label' => 'Numero Zona',
				'registerInArrayValidator' => false,
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'select', 'alert', array (
				'label' => 'Tipo Pericolo',
				'multiOptions' => $alert,
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'submit', 'register', array (
				'label' => 'Registra',
				'decorators' => $this->elementDecorators  ));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
				'Form'
		));
	}
}