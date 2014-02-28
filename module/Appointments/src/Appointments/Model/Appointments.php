<?php
namespace Appointments\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Appointments
{
	public $app_id;
	public $app_pro_id;
	public $app_pat_id;
	public $app_start_date;
	public $app_pro_pat_number;
	public $app_pro_normal_duration;
	protected $inputFilter;
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	public function exchangeArray($data)
	{
		$this->app_id			= (!empty($data['app_id'])) ? $data['app_id'] : null;
		$this->app_pro_id	= (!empty($data['app_pro_id'])) ? $data['app_pro_id'] : null;
		$this->app_pat_id	= (!empty($data['app_pat_id'])) ? $data['app_pat_id'] : null;
		$this->app_start_date   = (!empty($data['app_start_date'])) ? $data['app_start_date'] : null;
		$this->app_pro_pat_number		= (!empty($data['app_pro_pat_number'])) ? $data['app_pro_pat_number'] : null;
		$this->app_pro_normal_duration   	= (!empty($data['app_pro_normal_duration'])) ? $data['app_pro_normal_duration'] : null;
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();
	
			$inputFilter->add($factory->createInput(array(
					'name'     => 'app_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'app_pro_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'app_pat_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			)));
	
			$inputFilter->add($factory->createInput(array(
					'name'     => 'app_start_date',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'app_pro_pat_number',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'min'      => 1,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'app_pro_normal_duration',
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
									),
							),
					),
			)));
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
}