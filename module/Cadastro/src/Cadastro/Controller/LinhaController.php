<?php

namespace Cadastro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cadastro\Model\Linha;
use Cadastro\Form\LinhaForm;

class LinhaController extends AbstractActionController {

    protected $linhaTable;

    public function getLinhaTable() {
        if (!$this->linhaTable) {
            $sm = $this->getServiceLocator();
            $this->linhaTable = $sm->get('Cadastro\Model\LinhaTable');
        }
        return $this->linhaTable;
    }

    public function indexAction() {
        return new ViewModel(array(
                    'linhas' => $this->getLinhaTable()->fetchAll(),
                        )
        );
    }

    public function cadastroAction() {
        $form = new LinhaForm();
        $form->get('submit')->setValue(' Gravar ');

        $id = (int) $this->params('id', 0);
        if ($id) {
            $linha = $this->getLinhaTable()->getLinha($id);
            $form->bind($linha);
            $form->get('submit')->setAttribute('value', 'Editar');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $linha = new Linha();
            $form->setInputFilter($linha->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $linha->exchangeArray($form->getData());
                $this->getLinhaTable()->saveLinha($linha);

                return $this->redirect()->toRoute(null, array('controller' => 'linha', 'action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute(null, array('controller' => 'linha', 'action' => 'index'));
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('linha');
                $this->getLinhaTable()->deleteLinha($id);
            }

            // Redirect to list of linhas
            return $this->redirect()->toRoute(null, array('controller' => 'linha', 'action' => 'index'));
        }

        return array(
            'id' => $id,
            'linha' => $this->getLinhaTable()->getLinha($id)
        );
    }

}