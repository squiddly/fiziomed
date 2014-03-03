<?php
namespace Appointments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procedures\Model\Procedures;
use Procedures\Form\ProceduresForm;
use Appointments\Model\Appointments;
use Appointments\Form\AppointmentsForm;
use Patients\Model\Patients;
use Patients\Form\PatientsForm;

class AppointmentsController extends AbstractActionController
{
	protected $ProceduresTable;
	protected $AppointmentsTable;
	protected $PatientsTable;
	
	public function getProceduresTable()
	{
		if (!$this->ProceduresTable) {
			$sm = $this->getServiceLocator();
			$this->ProceduresTable = $sm->get('Procedures\Model\ProceduresTable');
		}
		return $this->ProceduresTable;
	}
	
	public function getAppointmentsTable()
	{
		if (!$this->AppointmentsTable) {
			$sm = $this->getServiceLocator();
			$this->AppointmentsTable = $sm->get('Appointments\Model\AppointmentsTable');
		}
		return $this->AppointmentsTable;
	}
	
	public function getPatientsTable()
	{
		if(!$this->PatientsTable) {
			$sm = $this->getServiceLocator();
			$this->PatientsTable = $sm->get('Patients\Model\PatientsTable');
		}
		return $this->PatientsTable;
	}
	
    public function indexAction()
    {	
    	$paginator = $this->getProceduresTable()->fetchAll();
    	$Procedures = array();
    	foreach($paginator AS $item)
    		$Procedures[$item->pro_id] = $item;
    	
    	//get tab dates and appointments for each
    	//$today = new \DateTime();
    	$today = new \DateTime("11-12-2013");
    	$todayApp = $this->getAppointmentsOnDate($today->format("Y-m-d")); //de facut mai multe date de intrare (pentru zilele anterioare)
    	$yesterday = new \DateTime($today->format("d.m.Y"));	//d.m.Y format in order to avoit d.m february error
    	$yesterday->add(\DateInterval::createFromDateString('yesterday'));
    	$yesterdayApp = $this->getAppointmentsOnDate($yesterday->format("d.m.Y"));
    	$dayBeforeYesterday = new \DateTime($today->format("d.m.Y"));
    	$dayBeforeYesterday->sub(new \DateInterval('P2D'));
    	$dayBeforeYesterdayApp = $this->getAppointmentsOnDate($dayBeforeYesterday->format("d.m.Y"));
    	$tomorrow = new \DateTime($today->format("d.m.Y"));
    	$tomorrow->add(\DateInterval::createFromDateString('tomorrow'));
    	$tomorrowApp = $this->getAppointmentsOnDate($tomorrow->format("d.m.Y"));
    	$dayAfterTomorrow = new \DateTime($today->format("d.m.Y"));
    	$dayAfterTomorrow->add(new \DateInterval('P2D'));
    	$dayAfterTomorrowApp = $this->getAppointmentsOnDate($dayAfterTomorrow->format("d.m.Y"));
    	$tabDates = array(
    			'dayBeforeYesterday'	=> $dayBeforeYesterday->format("d.m"),
    			'yesteday'				=> $yesterday->format("d.m"),
    			'today'					=> $today->format("d.m"),
    			'tomorrow'				=> $tomorrow->format("d.m"),
    			'dayAfterTomorrow'		=> $dayAfterTomorrow->format("d.m")
    	);
    	
    	return new ViewModel(array(
    			"message"				=> "Appointments page here",
    			"interval"				=> "10",
    			"procedures"			=> htmlentities((\Zend\Json\Encoder::encode($Procedures))),
    			"todayApp"				=> htmlentities((\Zend\Json\Encoder::encode($todayApp))),
    			"yesterdayApp"			=> htmlentities((\Zend\Json\Encoder::encode($yesterdayApp))),
    			"dayBeforeYesterdayApp"	=> htmlentities((\Zend\Json\Encoder::encode($dayBeforeYesterdayApp))),
    			"tomorrowApp"			=> htmlentities((\Zend\Json\Encoder::encode($tomorrowApp))),
    			"dayAfterTomorrowApp"	=> htmlentities((\Zend\Json\Encoder::encode($dayAfterTomorrowApp))),
    			"tabDates"				=> htmlentities((\Zend\Json\Encoder::encode($tabDates)))
    	));
    }
    
    public function addAction()
    {
    	$form = new AppointmentsForm();
    	$form->get('submit')->setValue('Adaugă');
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$Appointments = new Appointments();
    		$form->setInputFilter($Appointments->getInputFilter());
    		$form->setData($request->getPost());
    
    		if ($form->isValid()) {
    			$Appointments->exchangeArray($form->getData());
    			$this->getProceduresTable()->saveProcedures($Appointments);
    
    			return $this->redirect()->toRoute('Appointments');
    		}
    	}
    	return array('form' => $form);
    }
    
    public function editAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return $this->redirect()->toRoute('Appointments', array(
    				'action' => 'add'
    		));
    	}
    
    	try {
    		$Appointments = $this->getAppointmentsTable()->getAppointments($id);
    	}
    	catch (\Exception $ex) {
    		return $this->redirect()->toRoute('Appointments', array(
    				'action' => 'index'
    		));
    	}
    
    	$form  = new AppointmentsForm();
    	$form->bind($Appointments);
    	$form->get('submit')->setAttribute('value', 'Editează');
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setInputFilter($Appointments->getInputFilter());
    		$form->setData($request->getPost());
    
    		if ($form->isValid()) {
    			$this->getAppointmentsTable()->saveAppointments($Appointments);
    
    			return $this->redirect()->toRoute('Appointments');
    		}
    	}
    
    	return array(
    			'id' => $id,
    			'form' => $form,
    	);
    }
    
    public function deleteAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return $this->redirect()->toRoute('Appointments');
    	}
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'Nu');
    
    		if ($del == 'Da') {
    			$id = (int) $request->getPost('id');
    			$this->getAppointmentsTable()->deleteAppointments($id);
    		}
    
    		return $this->redirect()->toRoute('Appointments');
    	}
    
    	return array(
    			'id'    => $id,
    			'appointments' => $this->getAppointmentsTable()->getAppointments($id)
    	);
    }
    
    private function getAppointmentsOnDate($date)
    {
    	$paginator = $this->getProceduresTable()->fetchAll();
    	$Procedures = array();
    	foreach($paginator AS $item)
    		$Procedures[$item->pro_id] = $item;
    	 
    	$pat = $this->getPatientsTable()->fetchAll();
    	$Patients = array();
    	foreach($pat AS $patient)
    		$Patients[$patient->pat_id] = $patient;
    	
    	$AppointmentsDb = $this->getAppointmentsTable()->fetchAll(array("DATE(app_start_date)" => "DATE(". $date .")"));
		
    	$Appointments = array();
    	foreach($AppointmentsDb AS $appointment)
    		$Appointments[$appointment->app_id] = array(
    				"date"		=> $appointment->app_start_date,
    				"pat_nr"	=> $appointment->app_pro_pat_number,
    				"duration"	=> $appointment->app_pro_normal_duration,
    				"pat_data"	=> $Patients[$appointment->app_pat_id],
    				"pro_data"	=> $Procedures[$appointment->app_pro_id],
    	);
    	var_dump(count($Appointments), $date);
    	return $Appointments;
    }

}