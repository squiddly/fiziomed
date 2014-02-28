<?php
namespace Procedures\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class ProceduresTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

	public function fetchAll($paginated=false)
     {
         if($paginated) {
             $select = new Select('Procedures');
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Procedures());
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

    public function getProcedures($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('pro_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveProcedures(Procedures $Procedures)
    {
        $data = array(
            'pro_procedure_name'	=> $Procedures->pro_procedure_name,
            'pro_normal_duration'	=> $Procedures->pro_normal_duration,
        	'pro_priority'  		=> $Procedures->pro_priority,
        	'pro_pat_number'		=> $Procedures->pro_pat_number,
        );
		
        $id = (int)$Procedures->pro_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getProcedures($id)) {
                $this->tableGateway->update($data, array('pro_id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteProcedures($id)
    {
        $this->tableGateway->delete(array('pro_id' => $id));
    }
}