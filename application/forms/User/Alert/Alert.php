<?php
class Application_Form_User_Alert_Alert extends App_Form_Abstract {
	
	protected $_userModel;
	
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'registrer' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );

		//Estraggo i nomi degli edifici dal model e li inserisco nella SELECT
		$building = array();
		$this->_userModel = new Application_Model_User();
		$build = $this->_userModel->viewBuilding();
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
		
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'select', 'zone_number', array (
				'label' => 'Numero Zona',
		
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'select', 'alert', array (
				'label' => 'Tipo Pericolo',
				'multiOptions' => $alert,
				'validators' => array('Int'),
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