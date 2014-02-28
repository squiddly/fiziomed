<?php
namespace Procedures\Form;

use Zend\Form\Form;

class ProceduresForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('Procedures');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->add(array(
            'name' => 'pro_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'pro_procedure_name',
            'type' => 'Text',
            'options' => array(
	              	'label' => 'Nume procedură',
                ),
        	'attributes' => array(
        		'class' => 'form-control',
        	),
        ));
        $this->add(array(
            'name' => 'pro_normal_duration',
            'type' => 'Text',
            'options' => array(
                'label' => 'Durata normală',
            ),
        	'attributes' => array(
        		'class' => 'form-control',
        	),
        ));
        $this->add(array(
        		'name' => 'pro_priority',
        		'type' => 'Text',
        		'options' => array(
        				'label' => 'Prioritate procedură',
        		),
        		'attributes' => array(
        				'class'	=> 'form-control',
        				'value'	=> '1',
        		),
        ));
        $this->add(array(
        		'name' => 'pro_pat_number',
        		'type' => 'Text',
        		'options' => array(
        				'label' => 'Număr de pacienți/procedură',
        		),
        		'attributes' => array(
        				'class' => 'form-control',
        				'value'	=> '1',
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