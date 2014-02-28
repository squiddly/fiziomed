<?php 
namespace Appointments\Form;

use Zend\Form\Form;

class AppointmentsForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('programari');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'app_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'app_pro_id',
            'type' => 'Select',
            'options' => array(
                'label' => 'Procedura',
            ),
        	'attributes' => array(
        		'class' => 'form-control',
        	),
        ));
        $this->add(array(
        	'name' => 'app_pat_id',
        	'type' => 'Select',
        	'options' => array(
        		'label' => 'Pacient',
        	),
       		'attributes' => array(
       			'class' => 'form-control',
        	),
        ));
        $this->add(array(
            'name' => 'app_start_date',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data start',
            ),
        	'attributes' => array(
        		'class' => 'form-control',
        	),
        ));
        $this->add(array(
        	'name' => 'app_pro_pat_number',
        	'type' => 'Text',
        	'options' => array(
        		'label' => 'Nr. pacienti',
        	),
        	'attributes' => array(
        		'class' => 'form-control',
        	),
        ));
        $this->add(array(
        	'name' => 'app_pro_normal_duration',
        	'type' => 'Text',
        	'options' => array(
        		'label' => 'Durata',
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