<?php
namespace Tools\Form;
use Zend\Form\Form;
use Zend\Form\Element;
//use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
//use Zend\Db\Sql\Ddl\Column\Date;



class CheckForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('ckeckip');
        
        $this->add(array(
            'name'=>'id',
            'type'=>'text',
            'options'=>array('label' =>'ID')));
        $this->add(array(
            'name'=>'ip',
            'type'=>'text',
            'attributes'=>array(
                'placeholder' =>'IP Address',
                'id'=>'ip'
            ),
                
             
            'options'=>array('label' =>'IP Address')));
        //         $this->add(array(
        //             'name'=>'added',
        //             'type'=>'date',
        //             'attributes'=>array(
        //                 'value' =>'2000-08-17 00:00:00'),
        //             'options'=>array('label' =>'Added')));
        $this->add(array(
            'name'=>'check_ip',
            'type'=>'submit',
            
            'attributes'=>array(
                'value' =>'Add New IP',
                'id'=>'check_ip',
                'onclick'=>'check();'
            )));
        $added = new Element\Text('added');
        $date=date("Y-m-d H:m:s");
        $added->setLabel('Added')
        ->setAttributes(array(
        //             'class' => 'username',
            'value'  => $date,
        ));
        $this->add($added);
    
    }
    
    
    
}

