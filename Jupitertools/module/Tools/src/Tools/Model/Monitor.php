<?php
namespace Tools\Model;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator;
//use Zend\Validator\Ip;
class Monitor implements InputFilterAwareInterface
{

    public $id;
    public $ip;
    public $hostname;
    public $report;
    public $type;
    public $added;
    public $checked;
    protected $inputFilter;
    public function exchangeArray($data)
    {
         
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->ip = (!empty($data['ip'])) ? $data['ip'] : null;
        $this->hostname  = (!empty($data['hostname'])) ? $data['hostname'] : null;
        $this->report     = (!empty($data['report'])) ? $data['report'] : 0;
        $this->type     = (!empty($data['type'])) ? $data['type'] : null;
        $this->added = (!empty($data['added'])) ? $data['added'] : null;
        $this->checked  = (!empty($data['checked'])) ? $data['checked'] : null;
    }
    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
    
            $ip=new Input('ip');
            $ip->getValidatorChain()->attach(new Validator\Ip(array('allowipv4' => true,'allowipv6' => true)));
            $inputFilter->add($ip);
    
            $inputFilter->add(array(
                'name'     => 'ip',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                     
                     
    
    
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 39,
                             
    
    
                        ),
                         
    
                         
                         
    
                    ),
                ),
            ));
    
             
    
            $this->inputFilter = $inputFilter;
        }
    
        return $this->inputFilter;
    }
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    }
    
    
   

?>
