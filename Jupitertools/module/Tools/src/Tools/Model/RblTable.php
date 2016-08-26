<?php
namespace Tools\Model;
use Zend\Db\TableGateway\TableGateway;

class RblTable
{
    
    
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getRbl($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
   
    public function saveRbl(Rbl $rbl)
    {
        $data = array(
            
            'url'  =>  $rbl->url,
            'urldel' =>  $rbl->urldel,
            'label'  => $rbl->label,
            
        );
    
        $id = (int) $rbl->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getRbl($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Monitor id does not exist');
            }
        }
    }
    
    public function deleteRbl($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
    }


?>