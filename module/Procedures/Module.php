<?php
namespace Procedures;
use Procedures\Model\Procedures;
use Procedures\Model\ProceduresTable;
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
    					'Procedures\Model\ProceduresTable' =>  function($sm) {
    						$tableGateway = $sm->get('ProceduresTableGateway');
    						$table = new ProceduresTable($tableGateway);
    						return $table;
    					},
    					'ProceduresTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Procedures());
    						return new TableGateway('Procedures', $dbAdapter, null, $resultSetPrototype);
    					},
    			),
    	);
    }
}
