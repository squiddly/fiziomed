<?php
namespace Procedures\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procedures\Model\Procedures;
use Procedures\Form\ProceduresForm;

class ProceduresController extends AbstractActionController
{
	protected $ProceduresTable;
	public function getProceduresTable()
	{
		if (!$this->ProceduresTable) {
			$sm = $this->getServiceLocator();
			$this->ProceduresTable = $sm->get('Procedures\Model\ProceduresTable');
		}
		return $this->ProceduresTable;
	}
	
	public function indexAction()
	{
     $paginator = $this->getProceduresTable()->fetchAll(true);
     $paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
     $paginator->setItemCountPerPage(10);

     return new ViewModel(array(
         'paginator' => $paginator
     ));
	}

	public function addAction()
	{
		$form = new ProceduresForm();
		$form->get('submit')->setValue('Adaugă');
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$Procedures = new Procedures();
			$form->setInputFilter($Procedures->getInputFilter());
			$form->setData($request->getPost());
			
			if ($form->isValid()) {
				$Procedures->exchangeArray($form->getData());
				$this->getProceduresTable()->saveProcedures($Procedures);
				return $this->redirect()->toRoute('Procedures');
			}
		}
		return array('form' => $form);
	}

	public function editAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		
		if (!$id) {
			return $this->redirect()->toRoute('Procedures', array(
					'action' => 'add'
			));
		}

		try {
			$Procedures = $this->getProceduresTable()->getProcedures($id);
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('Procedures', array(
					'action' => 'index'
			));
		}
		
		$form  = new ProceduresForm();
		$form->bind($Procedures);
		$form->get('submit')->setAttribute('value', 'Editează procedură');
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$form->setInputFilter($Procedures->getInputFilter());
			$form->setData($request->getPost());
		
			if ($form->isValid()) {
				$this->getProceduresTable()->saveProcedures($Procedures);
		
				return $this->redirect()->toRoute('Procedures');
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
			return $this->redirect()->toRoute('Procedures');
		}
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$del = $request->getPost('del', 'Nu');
		
			if ($del == 'Da') {
				$id = (int) $request->getPost('pro_id');
				$this->getProceduresTable()->deleteProcedures($id);
			}
		
			return $this->redirect()->toRoute('Procedures');
		}
		
		return array(
				'id'    => $id,
				'procedures' => $this->getProceduresTable()->getProcedures($id)
		);
	}
}