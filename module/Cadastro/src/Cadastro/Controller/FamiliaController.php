<?php

namespace Cadastro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cadastro\Model\Familia;
use Cadastro\Form\FamiliaForm;

class FamiliaController extends AbstractActionController {

    protected $familiaTable;

    public function getFamiliaTable() {
        if (!$this->familiaTable) {
            $sm = $this->getServiceLocator();
            $this->familiaTable = $sm->get('Cadastro\Model\FamiliaTable');
        }
        return $this->familiaTable;
    }

    public function indexAction() {
        return new ViewModel(array(
                    'familias' => $this->getFamiliaTable()->fetchAll(),
                ));
    }

    public function cadastroAction() {
        $form = new FamiliaForm();
        $form->get('submit')->setValue(' Gravar ');

        $id = (int) $this->params('id', 0);
        if ($id > 0) {
            //$familia = $this->getFamiliaTable()->getFamilia($id);
            //$form->bind($familia);
            //$form->get('submit')->setAttribute('value', 'Editar');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $familia = new Familia();
            $form->setInputFilter($familia->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $familia->exchangeArray($form->getData());
                $this->getFamiliaTable()->saveFamilia($familia);

                return $this->redirect()->toRoute(null, array('controller' => 'familia', 'action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('familia');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getFamiliaTable()->deleteFamilia($id);
            }

            // Redirect to list of familias
            return $this->redirect()->toRoute('familia');
        }

        return array(
            'id' => $id,
            'familia' => $this->getFamiliaTable()->getFamilia($id)
        );
    }

}