<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Procedures\Controller\Procedures' => 'Procedures\Controller\ProceduresController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Procedures' => __DIR__ . '/../view',
        ),
    ),
	'router' => array(
			'routes' => array(
					'Procedures' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/Procedures[/][:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Procedures\Controller\Procedures',
											'action'     => 'index',
									),
							),
					),
					'procedures' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/Procedures[/][:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Procedures\Controller\Procedures',
											'action'     => 'index',
									),
							),
					),
			),
	),
	
);