<?php
class Application_Form_Admin_Floor_Add extends App_Form_Abstract {
	
	protected $_adminModel;	
	
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'addfloor' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
			
		
		//Estraggo i nomi degli edifici dal model e li inserisco nella SELECT
		$building = array('--SELECT--');
		$this->_adminModel = new Application_Model_Admin();
        $build = $this->_adminModel->viewBuilding();
        foreach ($build as $bui) {
        	$building[$bui -> code] = $bui->name;       
        }
		$this->addElement ( 'select', 'building_code', array (
				'label' => 'Edificio',
				'required' => true,
				'multiOptions' => $building,
		) );

		$this->addElement ( 'select', 'number', array (
				'label' => 'Numero Piano',
				'required' => true,
				'registerInArrayValidator' => false,
				'validators' => array('Int'),
		) );
		
		$this->addElement ( 'text', 'zone_number', array (
				'label' => 'Numero Zone',
				'required' => true,
				'validators' => array('Int'),
		) );
		
		$this->addElement ( 'file', 'image', array (
				'label' => 'Planimetria',
				'required' => true,
				'destination' => APPLICATION_PATH . '/../public/images/floor',
				'validators' => array (
						array ( 'Count', false, 1 ),
						array ( 'Size', false, 10000000 ),
						array ( 'Extension', false, array ( 'jpg', 'gif', 'png' ) 
						) 
				) ,
		) );
		
		$this->addElement ( 'submit', 'add', array ( 
				'label' => 'Aggiungi Planimetria', ));
	}
}