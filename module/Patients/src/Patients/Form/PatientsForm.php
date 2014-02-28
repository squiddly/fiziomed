<?php
namespace Patients\Form;

use Zend\Form\Form;

class PatientsForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Patients');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'pat_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'pat_lastname',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nume',
            ),
      		'attributes' => array(
   				'class' => 'form-control',
       		),
        ));
        $this->add(array(
            'name' => 'pat_firstname',
            'type' => 'Text',
            'options' => array(
                'label' => 'Prenume',
            ),
        	'attributes' => array(
        		'class' => 'form-control',
        	),
        ));
        $this->add(array(
        		'name' => 'pat_pnc',
        		'type' => 'Text',
        		'options' => array(
        			'label' => 'CNP',
        		),
        		'attributes' => array(
        				'class' => 'form-control',
        		),
        ));
        $this->add(array(
        		'name' => 'pat_address',
        		'type' => 'Text',
        		'options' => array(
        			'label' => 'Adresa',
        		),
        		'attributes' => array(
        				'class' => 'form-control',
        		),
        ));
        $this->add(array(
        		'name' => 'pat_age',
        		'type' => 'Text',
        		'options' => array(
        			'label' => 'Vârsta',
        		),
        		'attributes' => array(
        				'class' => 'form-control',
        		),
        ));
        $this->add(array(
        		'name' => 'pat_zone',
        		'type' => 'Text',
        		'options' => array(
        				'label' => 'Zona/Cartier',
        		),
        		'attributes' => array(
        				'class' => 'form-control',
        		),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Adaugă',
                'id' => 'submitbutton',
            	'class' => 'btn btn-default',
            ),
        ));
    }
}