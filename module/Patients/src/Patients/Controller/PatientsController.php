<?php
namespace Patients\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Patients\Model\Patients;
use Patients\Form\PatientsForm;

class PatientsController extends AbstractActionController
{
	protected $PatientsTable;
	
	public function getPatientsTable()
	{
		if (!$this->PatientsTable) {
			$sm = $this->getServiceLocator();
			$this->PatientsTable = $sm->get('Patients\Model\PatientsTable');
		}
		return $this->PatientsTable;
	}
	
    public function indexAction()
    {
	    $paginator = $this->getPatientsTable()->fetchAll(true);
	    $paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
	    $paginator->setItemCountPerPage(10);
	    return new ViewModel(array(
	        'paginator' => $paginator
	    ));
    }

    public function addAction()
    {
    	$form = new PatientsForm();
    	$form->get('submit')->setValue('Adaugă');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$Patients = new Patients();
    		$form->setInputFilter($Patients->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$Patients->exchangeArray($form->getData());
    			$this->getPatientsTable()->savePatients($Patients);
    	
    			return $this->redirect()->toRoute('Patients');
    		}
    	}
    	return array('form' => $form);
    }

    public function editAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return $this->redirect()->toRoute('Patients', array(
    				'action' => 'add'
    		));
    	}
    	
    	try {
    		$Patients = $this->getPatientsTable()->getPatients($id);
    	}
    	catch (\Exception $ex) {
    		return $this->redirect()->toRoute('Patients', array(
    				'action' => 'index'
    		));
    	}
    	
    	$form  = new PatientsForm();
    	$form->bind($Patients);
    	$form->get('submit')->setAttribute('value', 'Editează');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setInputFilter($Patients->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$this->getPatientsTable()->savePatients($Patients);
    	
    			return $this->redirect()->toRoute('Patients');
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
    		return $this->redirect()->toRoute('Patients');
    	}
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'Nu');
    	
    		if ($del == 'Da') {
    			$id = (int) $request->getPost('pat_id');
    			$this->getPatientsTable()->deletePatients($id);
    		}
    	
    		return $this->redirect()->toRoute('Patients');
    	}
    	
    	return array(
    			'id'    => $id,
    			'patients' => $this->getPatientsTable()->getPatients($id)
    	);
    }
}