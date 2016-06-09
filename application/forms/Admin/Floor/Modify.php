<?php
class Application_Form_Admin_Floor_Modify extends App_Form_Abstract {
	
	protected $_adminModel;	
	
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'modifyfloor' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
			
		
		$this->addElement ( 'text', 'zone_number', array (
				'label' => 'Numero Zone',
				'required' => true,
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'file', 'image', array (
				'label' => 'Planimetria',
				'required' => true,
				'destination' => APPLICATION_PATH . '/../public/images/floor',
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