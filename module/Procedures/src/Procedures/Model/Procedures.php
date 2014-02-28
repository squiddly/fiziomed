<?php
namespace Procedures\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Procedures implements InputFilterAwareInterface
{
	public $pro_id;
	public $pro_procedure_name;
	public $pro_normal_duration;
	public $pro_priority;
	public $pro_pat_number;
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->pro_id    = (!empty($data['pro_id'])) ? $data['pro_id'] : null;
		$this->pro_procedure_name = (!empty($data['pro_procedure_name'])) ? $data['pro_procedure_name'] : null;
		$this->pro_normal_duration  = (!empty($data['pro_normal_duration'])) ? $data['pro_normal_duration'] : null;
		$this->pro_priority  = (!empty($data['pro_priority'])) ? $data['pro_priority'] : null;
		$this->pro_pat_number  = (!empty($data['pro_pat_number'])) ? $data['pro_pat_number'] : null;
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
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
					'name'     => 'pro_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			)));
	
			$inputFilter->add($factory->createInput(array(
					'name'     => 'pro_procedure_name',
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
											'max'      => 500,
									),
							),
					),
			)));
	
			$inputFilter->add($factory->createInput(array(
					'name'     => 'pro_normal_duration',
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
											'max'      => 50,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'pro_priority',
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
											'max'      => 50,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'pro_pat_number',
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
											'max'      => 50,
									),
							),
					),
			)));
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
}