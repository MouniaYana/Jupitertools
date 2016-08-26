<?php
namespace Tools\Model;
use Zend\Db\TableGateway\TableGateway;

class MonitorTable
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
    
    public function getMonitor($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    public function saveMonitor(Monitor $monitor)
    {
        $data = array(
            'ip' => $monitor->ip,
            'hostname'  =>  $monitor->hostname,
            'type' =>  $monitor->type,
            'added'  => $monitor->added,
            'checked' => $monitor->checked,
        );
    
        $id = (int) $monitor->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getMonitor($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Monitor id does not exist');
            }
        }
    }
    
    public function deleteMonitor($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}

