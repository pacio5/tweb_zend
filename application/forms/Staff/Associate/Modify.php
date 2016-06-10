<?php
class Application_Form_Staff_Associate_Modify extends App_Form_Abstract {
		
	protected $_staffModel;
	
	public function init() {
		$this->setMethod ( 'post' );
		$this->setName ( 'modifyMap' );
		$this->setAction ( '' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
	
		//Estraggo i nomi degli edifici dal model e li inserisco nella SELECT
		$images = array();
		$images['unselected'] = " -- Select --";
		$this->_staffModel = new Application_Model_Staff();
		$image = $this->_staffModel->viewNameMap();
		foreach ($image as $img) {
			$images[$img -> image] = $img->image;
		}
		$this->addElement ( 'select', 'image', array (
				'label' => 'Vie di Fuga',
				'required' => true,
				'multiOptions' => $images,
				'decorators' => $this->elementDecorators,
		) );
	
		
		$this->addElement ( 'submit', 'register', array (
				'label' => 'Registra',
				'decorators' => $this->elementDecorators,  ));
	
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
				'Form'
		));
	}
}