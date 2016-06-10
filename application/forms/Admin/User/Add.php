<?php
class Application_Form_Admin_User_Add extends App_Form_Abstract {
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'addstaff' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		$this->setAttrib ( 'id', 'adduser' );

		$this->addElement ( 'text', 'user', array (
				'label' => 'Username',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array ( array ('StringLength', true, array ( 1, 30 ) ) ),
		) );

		$this->addElement ( 'text', 'name', array (
				'label' => 'Nome',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array (
						array ('StringLength', true, array ( 1, 30 ) ) ) ,
		) );

		$this->addElement ( 'text', 'surname', array (
				'label' => 'Cognome',
				'filters' => array ('StringTrim'),
				'required' => true ,
				'validators' => array (
						array ('StringLength', true, array ( 1, 30 ) ) ) ,
		) );

		$this->addElement ( 'password', 'password', array (
				'label'  	 => 'Password (min. 3 caratteri)',
				'required' 	 => true,
				'filters'    => array('StringTrim'),
				'validators' => array(
						array('StringLength', true, array(3, 25))),
		) );
		
		$this->addElement ( 'text', 'mail', array (
				'label' => 'Email',
				'filters' => array ('StringTrim'),
				'required' => true,
				'validators' => array ( array ('StringLength', true, array ( 5, 50 ) ) ),
		) );


		$this->addElement ( 'submit', 'registration', array (
				'label' => 'Registra', ));
	}
}