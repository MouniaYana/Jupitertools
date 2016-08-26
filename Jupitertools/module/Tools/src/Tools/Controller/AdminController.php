<?php

namespace Tools\Controller;

use Zend\Mvc\Controller\AbstractActionController;
          // <-- Add this import
use Tools\Form\CheckForm;       // <-- Add this import
use Tools\Model\CheckIp;
//use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CheckController extends AbstractActionController
{   
      public $form ; 
         
     
     
      
    public function indexAction(){ 
        
        $users = $this->getEntityManager()->getRepository('CsnUser\Entity\User')->findall();
        return new ViewModel(array('users' => $users));
      
        
    }
   
  
   
    
}
