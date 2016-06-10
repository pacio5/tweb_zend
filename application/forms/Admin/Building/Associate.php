<?php
class Application_Form_Admin_Building_Associate extends App_Form_Abstract {
	protected $_adminModel;
	
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'buildingassociate' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		$this->setAttrib('id', 'building_ass');
		
		$select = array('--SELECT--');
		$this->_adminModel = new Application_Model_Admin();
		$staff = $this->_adminModel->viewStaff();
		foreach ($staff as $user) {
			$select[$user -> user] = $user->name.' '.$user->surname;
		}
		
		$this->addElement ( 'select', 'staff_code', array (
				'label' => 'Edificio',
				'required' => true,
				'multiOptions' => $select,
				'decorators' => $this->elementDecorators,
		) );
		
		
		$building = array();
		
		$build = $this->_adminModel->viewBuildingUnAssociate();
		
		foreach ($build as $bui) {
			$building[$bui -> code] = $bui->name;
		}
		
		$this->addElement ( 'MultiCheckbox', 'building_code', array (
				'label' => 'Edificio',
				'required' => true,
				'multiOptions' => $building,
				'decorators' => $this->elementDecorators,
		) );
		
		
		$this->addElement ( 'submit', 'associate', array (
				'label' => 'Associa',
				'decorators' => $this->elementDecorators  ));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
				'Form'
		));
		
	}
	
	
}