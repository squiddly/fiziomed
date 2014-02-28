<?php
namespace Patients;
use Patients\Model\Patients;
use Patients\Model\PatientsTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Patients\Model\PatientsTable' =>  function($sm) {
    						$tableGateway = $sm->get('PatientsTableGateway');
    						$table = new PatientsTable($tableGateway);
    						return $table;
    					},
    					'PatientsTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Patients());
    						return new TableGateway('Patients', $dbAdapter, null, $resultSetPrototype);
    					},
    			),
    	);
    }
}
