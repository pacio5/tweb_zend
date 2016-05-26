<?php
class Application_Form_Public_Contact_Send extends App_Form_Abstract {
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'contact' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		
		$this->addElement ( 'text', 'name', array (
				'label' => 'Nome',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array ( array ('StringLength', true, array ( 1, 60 ) ) ),
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'text', 'email', array (
				'label' => 'Email',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array (
					array ('StringLength', true, array ( 1, 30 ) ) ) ,
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'textarea', 'message', array (
				'label' => 'Messaggio',
				'cols' => '70', 'rows' => '10',
				'filters' => array ('StringTrim'),
				'required' => true ,
				'validators' => array (
					array ('StringLength', true, array ( 1, 2500 ) ) ) ,
				'decorators' => $this->elementDecorators,
		) );
		
		$this->addElement ( 'submit', 'send', array ( 
				'label' => 'Invia',
				'decorators' => $this->elementDecorators  ));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
				'Form'
		));
	}
}