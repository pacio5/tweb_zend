<?php
class Application_Form_Admin_Escape_Add extends App_Form_Abstract {

	protected $_adminModel;

	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'addescape' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
			

		//Estraggo i nomi delle vie dal model e li inserisco nella SELECT
		$escape = array('--SELECT--');
		$this->_adminModel = new Application_Model_Admin();
	//	$build = $this->_adminModel->viewBuilding();
		foreach ($escape_map as $esc) {
			$escape[$esc -> code] = $esc->name;
		}
		$this->addElement ( 'select', 'code', array (
				'label' => 'Via Di Fuga',
				'required' => true,
				'multiOptions' => $escape,
				'decorators' => $this->elementDecorators,
		) );

		$this->addElement ( 'text', 'zone_code', array (
				'label' => 'Numero Zona',
				'required' => true,
				'registerInArrayValidator' => false,
				'validators' => array('Int'),
				'decorators' => $this->elementDecorators,
		) );



		$this->addElement ( 'file', 'image', array (
				'label' => 'Planimetria',
				'required' => true,
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