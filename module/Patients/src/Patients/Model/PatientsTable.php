<?php
namespace Patients\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class PatientsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false)
    {
         if($paginated) {
             $select = new Select('Patients');
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Patients());
             $paginatorAdapter = new DbSelect(
                 $select,
                 $this->tableGateway->getAdapter(),
                 $resultSetPrototype
             );
             $paginator = new Paginator($paginatorAdapter);
             return $paginator;
         }
         $resultSet = $this->tableGateway->select();
         return $resultSet;
    }

    public function getPatients($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('pat_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function savePatients(Patients $Patients)
    {
        $data = array(
            'pat_firstname'	=> $Patients->pat_firstname,
            'pat_lastname'	=> $Patients->pat_lastname,
        	'pat_pnc'		=> $Patients->pat_pnc,
        	'pat_address'	=> $Patients->pat_address,
        	'pat_age'		=> $Patients->pat_age,
        	'pat_zone'		=> $Patients->pat_zone
        );

        $id = (int)$Patients->pat_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPatients($id)) {
                $this->tableGateway->update($data, array('pat_id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deletePatients($id)
    {
        $this->tableGateway->delete(array('pat_id' => $id));
    }
}