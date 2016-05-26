<?php

class Application_Model_Acl extends Zend_Acl
{
	public function __construct()
	{
		//ACL utente non registrato
		$this->addRole(new Zend_Acl_Role('unregistered'))
			 ->add(new Zend_Acl_Resource('public'))
			 ->add(new Zend_Acl_Resource('error'))
			 ->allow('unregistered', array('public', 'error'));
			 
		
		//ACL utente registrato
		$this->addRole(new Zend_Acl_Role('user'), 'unregistered')
			 ->add(new Zend_Acl_Resource('user'))
			 ->allow('user', 'user');
			 
		
		//ACL staff
		$this->addRole(new Zend_Acl_Role('staff'), 'user')
			 ->add(new Zend_Acl_Resource('staff'))
			 ->allow('staff', 'staff');
			 
			 
		//ACL amministratore
		$this->AddRole(new Zend_Acl_Role('admin'), 'staff')
			 ->add(new Zend_Acl_Resource('admin'))
			 ->allow('admin', 'admin');
	}
}