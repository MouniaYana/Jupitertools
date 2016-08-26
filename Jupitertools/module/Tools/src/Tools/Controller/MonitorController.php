<?php

namespace Tools\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Tools\Model\Monitor;          // <-- Add this import
use Tools\Form\MonitorForm;       // <-- Add this import

use Zend\View\Model\JsonModel;

class MonitorController extends AbstractActionController
{   protected $monitorTable;
    public function indexAction(){ 
//     $form = new MonitorForm();
//         $form->get('ip')->setValue('Add');
//         $request = $this->getRequest();
//         if ($request->isPost()) {
//             $monitor = new Monitor();
//             $form->setInputFilter($monitor->getInputFilter());
//             $form->setData($request->getPost());
        
//             if ($form->isValid()) {
//                 $monitor->exchangeArray($form->getData());
//                 $this->getMonitorTable()->saveMonitor($monitor);
        
//                 // Redirect to list of Montors
                
//                 return $this->redirect()->toRoute('monitor');
//             }
//         }
         return array(
             'monitors' => $this->getMonitorTable()->fetchAll(),
//              'form' => $form,
             
         );
    }

    public function addAction()
    {
    
                $form = new MonitorForm();
//                  $form->get('ip')->setPlaceHolder('IP Address');
    
                 $request = $this->getRequest();
                 if ($request->isPost()) {
                     $monitor = new Monitor();
                     $form->setInputFilter($monitor->getInputFilter());
                     $form->setData($request->getPost());
    
                     if ($form->isValid()) {
                         $monitor->exchangeArray($form->getData());
                         if(strlen($monitor->ip)<15)
                         $monitor->type='IPV4';
                         else 
                             $monitor->type='IPV6';
                         $this->getMonitorTable()->saveMonitor($monitor);
    
                         // Redirect to list of monitors
                         return $this->redirect()->toRoute('monitor');
                     }
                 }
                 return array('form' => $form);
        
//         $this->_helper->layout->disableLayout();
//         $this->_helper->viewRenderer->setNoRender(TRUE);
    
//         $data = $this->_request->getPost();
//         echo Zend_Json::encode(array('name' => $data['name'], 'email' => $data['email']));
    
    }
    public function getMonitorTable()
    {
        if (!$this->monitorTable) {
            $sm = $this->getServiceLocator();
            $this->monitorTable = $sm->get('Tools\Model\MonitorTable');
        }
        return $this->monitorTable;
    }
    
    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('monitor', array(
                'action' => 'edit'
            ));
        }
    
        // Get the monitor with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $monitor = $this->getMonitorTable()->getMonitor($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('monitor', array(
                'action' => 'index'
            ));
        }
    
        $form  = new MonitorForm();
        $form->bind($monitor);
        $form->get('add_ip')->setAttribute('value', 'Edit');
     //   $form->get('added')->setAttribute('value', date("Y-m-d H:m:s"));
     
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($monitor->getInputFilter());
            $form->setData($request->getPost());
    
            if ($form->isValid()) {
                $monitor->added = date("Y-m-d H:m:s");
                $monitor->type='IPV4';
                $this->getMonitorTable()->saveMonitor($monitor);
    
                // Redirect to list of monitors
                return $this->redirect()->toRoute('monitor');
            }
        }
    
        return array(
            'id' => $id,
            'form' => $form,
        );
    }
    public function deleteAction()
    {
        //             $id = (int) $this->params()->fromRoute('id', 0);
        //             if (!$id) {
        //                 return $this->redirect()->toRoute('monitor');
        //             }
    
        //             $request = $this->getRequest();
        //             if ($request->isPost()) {
        //                 $del = $request->getPost('del', 'No');
    
        //                 if ($del == 'Yes') {
        //                     $id = (int) $request->getPost('id');
        //                     $this->getMonitorTable()->deleteMonitor($id);
        //                 }
    
        //                 // Redirect to list of Monitors
        //                 return $this->redirect()->toRoute('monitor');
        //             }
    
        //             return array(
        //                 'id'    => $id,
        //                 'monitor' => $this->getMonitorTable()->getMonitor($id)
        //             );
        $id=(int)$_POST['id'];
        $this->getMonitorTable()->deleteMonitor($id);
        $msg='ok';
        $response=new JsonModel(array('response'=>'ok'));
        return $response;
    }
   
    
}
