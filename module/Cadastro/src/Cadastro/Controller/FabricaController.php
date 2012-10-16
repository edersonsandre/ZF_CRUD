<?php

namespace Cadastro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cadastro\Model\Fabrica;
use Cadastro\Form\FabricaForm;

class FabricaController extends AbstractActionController {

    protected $fabricaTable;

    public function getFabricaTable() {
        if (!$this->fabricaTable) {
            $sm = $this->getServiceLocator();
            $this->fabricaTable = $sm->get('Cadastro\Model\FabricaTable');
        }
        return $this->fabricaTable;
    }

    public function indexAction() {
        return new ViewModel(
                        array(
                            'fabricas' => $this->getFabricaTable()->fetchAll(),
                        )
        );
    }

    public function cadastroAction() {
        $form = new FabricaForm();
        $form->get('submit')->setValue(' Gravar ');

        $id = (int) $this->params('id', 0);
        if ($id) {
            $fabrica = $this->getFabricaTable()->getFabrica($id);
            $form->bind($fabrica);
            $form->get('submit')->setAttribute('value', 'Editar');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $fabrica = new Fabrica();
            $form->setInputFilter($fabrica->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $fabrica->exchangeArray($form->getData());

                $this->getFabricaTable()->saveFabrica($fabrica);

                return $this->redirect()->toRoute(null, array('controller' => 'fabrica', 'action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute(null, array('controller' => 'fabrica', 'action' => 'index'));
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('fabrica');
                $this->getFabricaTable()->deleteFabrica($id);
            }

            // Redirect to list of fabricas
            return $this->redirect()->toRoute(null, array('controller' => 'fabrica', 'action' => 'index'));
        }

        return array(
            'id' => $id,
            'fabrica' => $this->getFabricaTable()->getFabrica($id)
        );
    }

}