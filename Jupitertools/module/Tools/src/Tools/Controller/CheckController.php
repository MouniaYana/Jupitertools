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
        
       
        $this->form = new CheckForm();
        return array('form' => $this->form);
        
    }
    public function checkAction(){
        
//     *************************************    
//         $request = $this->getRequest();
//         if ($request->isPost()) {
//             $checkip = new CheckIp();
//             $checkip->ip="192.168.1.1";
//             $checkip->Check_Ip();
//             return array('tab' =>  $checkip->Check_Ip());}
//             *****************************************
           // $this->form->setInputFilter($checkip->getInputFilter());
         //   $this->form->setData($request->getPost());
//             $this->form = new CheckForm();
//         $this->form->setData(array('ip'=>"192.168.1.1"));
         //   if ($this->form->isValid()) {
               // $checkip->exchangeArray($this->form->getData());
                
             
                
                
             //   $this->getMonitorTable()->saveMonitor($monitor);
        
                // Redirect to list of monitors
               // return $this->redirect()->toRoute('monitor');
              
                  //  $this->redirect()->toRoute('check'),
                
         //   }
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            // ajax is calling
        
            $inputValue = $request->getPost()->ip;
            $checkip = new CheckIp();
            //             $checkip->ip="192.168.1.1";
            $checkip->ip= $inputValue;
            
                    //  $checkip->Check_Ip();
            //             return array('tab' =>  $checkip->Check_Ip());
        
           
        
            // input validation
          
            // exchange conversion
          
        
            // building view for json
         //   if (empty( $errorArray)) {
                $view = new JsonModel(array(
                    'check' => 'here i islol',
                    'success'=>true,
                ));
//             } else {
//                 $view = new JsonModel( $errorArray);
//             }
            $view->setTerminal(true);
        
        } else {
        
            // regular HTTP call
            $view = new ViewModel;
        }
        
        return $view;
        
    }
    public function testAction(){
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            // ajax is calling
        
            $inputValue = $request->getPost()->usd;
            $currencyValue = str_replace(',', '.', $inputValue);
        
            $this->logVisit( $inputValue);
        
            // input validation
            $errorArray = array();
            if ( ! $this->validCurrencyInput( $currencyValue)) {
                $mtmt =  'Unclear: '. $inputValue . '...?' . $currencyValue;
                $errorArray = array(
                    'cny' => 'Unclear: '. $inputValue . '...?',
                    'success'=>false,
                );
        
            }
        
            // exchange conversion
            $valueInCNY = $this->getExchangeRate( $currencyValue);
            if ($valueInCNY == -1) {
                $errorArray = array(
                    'cny' => 'Data unavailable',
                    'success'=>false,
                );
            }
        
            // building view for json
            if (empty( $errorArray)) {
                $view = new JsonModel(array(
                    'cny' => $currencyValue . ' USD = ' . $valueInCNY . ' CNY',
                    'success'=>true,
                ));
            } else {
                $view = new JsonModel( $errorArray);
            }
            $view->setTerminal(true);
        
        } else {
        
            // regular HTTP call
            $view = new ViewModel;
        }
        
        return $view;
        
    }
    function getExchangeRate( $usd) {
    
        // simple json output
        $filename = "http://rate-exchange.appspot.com/currency?from=USD&to=CNY";
        $handle   = fopen($filename, "r");
        if ($handle === false) {
            // this may happen when the server with exhange rates is down
            return -1;
        }
        $contents = fread($handle, 5000);
        fclose($handle);
    
        $val = json_decode($contents);
        $cny = -1;
        if ( is_numeric($val->rate)) {
            $cny = $val->rate * $usd;
            $cny = round($cny,2);
        }
        return  $cny;
    }
   
    
}
