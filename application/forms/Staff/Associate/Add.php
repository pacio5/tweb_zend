<?php
class Application_Form_Staff_Associate_Add extends App_Form_Abstract {
		
	protected $_staffModel;
	
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'associate' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
	
		//Estraggo i nomi degli edifici dal model e li inserisco nella SELECT
		$building = array();
		$building['unselected'] = " -- Select --";
		$this->_staffModel = new Application_Model_Staff();
		$build = $this->_staffModel->viewBuilding();
		foreach ($build as $bui) {
			$building[$bui -> code] = $bui->name;
		}
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

		$this->addElement ('select', 'escape_map', array(
		        'label' => 'Planimetrie',
		        'registerInArrayValidator' => false,
		        'decorators' => $this->elementDecorators,
				));
		
		$this->addElement ( 'submit', 'register', array (
				'label' => 'Registra',
				'decorators' => $this->elementDecorators,  ));
	
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
				'Form'
		));
	}
}