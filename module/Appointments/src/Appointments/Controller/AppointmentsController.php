<?php
namespace Appointments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procedures\Model\Procedures;
use Procedures\Form\ProceduresForm;
use Appointments\Model\Appointments;
use Appointments\Form\AppointmentsForm;

class AppointmentsController extends AbstractActionController
{
	protected $ProceduresTable;
	protected $AppointmentsTable;
	
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
	
    public function indexAction()
    {	
    	$paginator = $this->getProceduresTable()->fetchAll(true);
    	$paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
    	$paginator->setItemCountPerPage(10);
    	
    	$Procedures = array();
    	foreach($paginator AS $item)
    		$Procedures[$item->pro_id] = $item->pro_procedure_name;
    	
    	$AppointmentsDb = $this->getAppointmentsTable()->fetchAll();
    	$Appointments = array();
    	foreach($AppointmentsDb AS $appointment)
    		$Appointments[$appointment->app_pro_id] = $appointment->app_pro_normal_duration;
    	
    	//get tab dates
    	$today = new \DateTime();
    	$yesterday = new \DateTime($today->format("d.m"));
    	$yesterday->add(\DateInterval::createFromDateString('yesterday'));
    	$dayBeforeYesterday = new \DateTime($today->format("d.m"));
    	$dayBeforeYesterday->sub(new \DateInterval('P2D'));
    	$tomorrow = new \DateTime($today->format("d.m"));
    	$tomorrow->add(\DateInterval::createFromDateString('tomorrow'));
    	$dayAfterTomorrow = new \DateTime($today->format("d.m"));
    	$dayAfterTomorrow->add(new \DateInterval('P2D'));
    	$tabDates = array(
    			'dayBeforeYesterday'	=> $dayBeforeYesterday->format("d.m"),
    			'yesteday'				=> $yesterday->format("d.m"),
    			'today'					=> $today->format("d.m"),
    			'tomorrow'				=> $tomorrow->format("d.m"),
    			'dayAfterTomorrow'		=> $dayAfterTomorrow->format("d.m")
    	);
    	return new ViewModel(array(
    			"message"		=> "Appointments page here",
    			"interval"		=> "10",
    			"procedures"	=> htmlentities((\Zend\Json\Encoder::encode($Procedures))),
    			"appointments"	=> htmlentities((\Zend\Json\Encoder::encode($Appointments))),
    			"tabDates"		=> htmlentities((\Zend\Json\Encoder::encode($tabDates)))
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

}