<?php
namespace Appointments;

use Appointments\Model\Appointments;
use Appointments\Model\AppointmentsTable;
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
    					'Appointments\Model\AppointmentsTable' =>  function($sm) {
    						$tableGateway = $sm->get('AppointmentsTableGateway');
    						$table = new AppointmentsTable($tableGateway);
    						return $table;
    					},
    					'AppointmentsTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Appointments());
    						return new TableGateway('Appointments', $dbAdapter, null, $resultSetPrototype);
    					},
    			),
    	);
    }
    
}
