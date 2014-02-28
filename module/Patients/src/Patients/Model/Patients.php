<?php
namespace Patients\Model;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Patients implements InputFilterAwareInterface
{
    public $pat_id;
    public $pat_firstname;
    public $pat_lastname;
    public $pat_pnc;
    public $pat_address;
    public $pat_age;
    public $pat_zone;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->pat_id     = (!empty($data['pat_id'])) ? $data['pat_id'] : null;
        $this->pat_firstname = (!empty($data['pat_firstname'])) ? $data['pat_firstname'] : null;
        $this->pat_lastname  = (!empty($data['pat_lastname'])) ? $data['pat_lastname'] : null;
        $this->pat_pnc  = (!empty($data['pat_pnc'])) ? $data['pat_pnc'] : ((!empty($data['pat_pnc'])?$data['pat_pnc']:null));
        $this->pat_address  = (!empty($data['pat_address'])) ? $data['pat_address'] : null;
        $this->pat_age  = (!empty($data['pat_age'])) ? $data['pat_age'] : null;
        $this->pat_zone  = (!empty($data['pat_zone'])) ? $data['pat_zone'] : null;
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
    	throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
    	if (!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFactory();
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'pat_id',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'Int'),
    				),
    		)));
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'pat_firstname',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 100,
    								),
    						),
    				),
    		)));
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'pat_lastname',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 200,
    								),
    						),
    				),
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'pat_pnc',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 100,
    								),
    						),
    				),
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'pat_pnc',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 300,
    								),
    						),
    				),
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'pat_age',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 4,
    								),
    						),
    				),
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'pat_zone',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 300,
    								),
    						),
    				),
    		)));
    
    		$this->inputFilter = $inputFilter;
    	}
    
    	return $this->inputFilter;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
}