<?php
class Application_Form_Admin_Building_Add extends App_Form_Abstract {
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'addbuilding' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		
		$this->addElement ( 'text', 'name', array (
				'label' => 'Nome',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array ( array ('StringLength', true, array ( 1, 30 ) ) ),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'text', 'address', array (
				'label' => 'Via',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array (
					array ('StringLength', true, array ( 1, 50 ) ) ) ,
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'text', 'floor_number', array (
				'label' => 'Numero Piani',
				'required' => true ,
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );
		$this->addElement ( 'file', 'image', array (
				'label' => 'Immagine',
				'destination' => APPLICATION_PATH . '/../public/images/building',
				'validators' => array (
						array ( 'Count', false, 1 ),
						array ( 'Size', false, 1024000 ),
						array ( 'Extension', false, array ( 'jpg', 'gif', 'png' ) 
						) 
				) , 'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'text', 'desc_short', array (
				'label' => 'Descrizione Breve',
				'required' => true,
				'filters' => array (
						'StringTrim' 
				),
				'validators' => array (
						array ('StringLength', true, array ( 1, 150 ) ) ) ,
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'submit', 'add', array ( 
				'label' => 'Aggiungi Immobile',
				'decorators' => $this->elementDecorators  ));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
				'Form'
		));
	}
}