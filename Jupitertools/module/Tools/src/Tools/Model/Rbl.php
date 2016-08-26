<?php
namespace Tools\Model;

class Rbl
{

    public $id;
    public $url;
    public $urldel;
    public $label;
   
    public function exchangeArray($data)
    {
         
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->url = (!empty($data['url'])) ? $data['url'] : null;
        $this->urldel  = (!empty($data['urldel'])) ? $data['urldel'] : null;
        $this->label     = (!empty($data['label'])) ? $data['label'] : null;
       }
}

?>