<?php
namespace Appointments\Model;

use Zend\Db\TableGateway\TableGateway;

class AppointmentsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($where = null)
    {
        $resultSet = $this->tableGateway->select($where = null);
        return $resultSet;
    }

    public function getAppointments($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('app_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveAppointments(Appointments $Appointments)
    {
        $data = array(
        	'app_pro_id'				=> $Appointments->app_pro_id,
        	'app_pat_id'				=> $Appointments->app_pat_id,
        	'app_start_date'			=> $Appointments->app_start_date,
        	'app_pro_pat_number'		=> $Appointments->app_pro_pat_number,
        	'app_pro_normal_duration'	=> $Appointments->app_pro_normal_duration
        );

        $id = (int)$Appointments->app_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAppointments($id)) {
                $this->tableGateway->update($data, array('app_id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteAppointments($id)
    {
        $this->tableGateway->delete(array('app_id' => $id));
    }
}