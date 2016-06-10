<?php

class Application_Form_Public_Auth_Login extends App_Form_Abstract
{
	public function init()
    {               
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');
    	
        $this->addElement('text', 'user', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
            ));
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            ));

        $this->addElement('submit', 'login', array(
            'label'    => 'Login',
        ));
    }
}