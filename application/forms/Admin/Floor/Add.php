<?php
class Application_Form_Admin_Floor_Add extends App_Form_Abstract {
	
	protected $_adminModel;	
	
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'addfloor' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
			
		
		//Estraggo i nomi degli edifici dal model e li inserisco nella SELECT
		$building = array();
		$this->_adminModel = new Application_Model_Admin();
        $build = $this->_adminModel->viewBuilding();
        foreach ($build as $bui) {
        	$building[$bui -> code] = $bui->name;       
        }
		$this->addElement ( 'select', 'building_code', array (
				'label' => 'Edificio',
				'required' => true,
				'multiOptions' => $building,
				'decorators' => $this->elementDecorators,
		) );

		$this->addElement ( 'select', 'number', array (
				'label' => 'Numero Piano',
				
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'text', 'zone_number', array (
				'label' => 'Numero Zone',
				
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'file', 'image', array (
				'label' => 'Planimetria',
				'destination' => APPLICATION_PATH . '/../public/images',
				'validators' => array (
						array ( 'Count', false, 1 ),
						array ( 'Size', false, 1024000 ),
						array ( 'Extension', false, array ( 'jpg', 'gif', 'png' ) 
						) 
				) , 'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'submit', 'add', array ( 
				'label' => 'Aggiungi Planimetria',
				'decorators' => $this->elementDecorators  ));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
				'Form'
		));
	}
}