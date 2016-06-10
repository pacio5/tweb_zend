<?php
class Application_Form_Admin_Faq_Add extends App_Form_Abstract {
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'addfaq' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		$this->setAttrib ( 'id', 'addfaq' );
		
		$this->addElement ( 'text', 'question', array (
				'label' => 'Domanda',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array ( array ('StringLength', true, array ( 1, 200 ) ) ),
		) );
		
		$this->addElement ( 'textarea', 'answer', array (
				'label' => 'Risposta',
				'cols' => '70', 'rows' => '10',
				'filters' => array ('StringTrim'),
				'required' => true ,
				'validators' => array (
						array ('StringLength', true, array ( 1, 2500 ) ) ) ,
		) );
		
		$this->addElement ( 'submit', 'add', array ( 
				'label' => 'Aggiungi', ));
	}
}