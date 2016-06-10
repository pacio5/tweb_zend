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
		$building['unselected'] = " -- Select --";
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
		
		$this->addElement ( 'select', 'alert', array (
				'label' => 'Tipo Pericolo',
				'multiOptions' => $alert,
		) );
		
		$this->addElement ( 'submit', 'register', array (
				'label' => 'Registra',  ));
	}
}