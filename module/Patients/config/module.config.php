<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Patients\Controller\Patients' => 'Patients\Controller\PatientsController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Patients' => __DIR__ . '/../view',
        ),
    ),
	'router' => array(
			'routes' => array(
					'Patients' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/Patients[/][:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Patients\Controller\Patients',
											'action'     => 'index',
									),
							),
					),
					'patients' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/Patients[/][:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Patients\Controller\Patients',
											'action'     => 'index',
									),
							),
					),
			),
	),
);