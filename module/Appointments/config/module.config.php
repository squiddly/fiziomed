<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Appointments\Controller\Appointments' => 'Appointments\Controller\AppointmentsController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Appointments' => __DIR__ . '/../view',
        ),
    ),
	'router' => array(
			'routes' => array(
					'Appointments' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/Appointments[/][:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Appointments\Controller\Appointments',
											'action'     => 'index',
									),
							),
					),
					'appointments' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/Appointments[/][:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Appointments\Controller\Appointments',
											'action'     => 'index',
									),
							),
					),
			),
	),
);