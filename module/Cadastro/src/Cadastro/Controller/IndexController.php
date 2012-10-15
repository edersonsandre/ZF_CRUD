<?php
namespace Cadastro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

use Cadastro\Entity\Cadastro;
use Cadastro\Entity\Registry;
use Cadastro\Form\CadastroForm;

/**
* Cadastro Controller
*/
class CadastroController extends AbstractActionController
{
  /**
* @var EntityManager
*/
  protected $entityManager;

  /**
* Sets the EntityManager
*
* @param EntityManager $em
* @access protected
* @return CadastroController
*/
  protected function setEntityManager(EntityManager $em)
  {
    $this->entityManager = $em;
    return $this;
  }

  /**
* Returns the EntityManager
*
* Fetches the EntityManager from ServiceLocator if it has not been initiated
* and then returns it
*
* @access protected
* @return EntityManager
*/
  protected function getEntityManager()
  {
    if (null === $this->entityManager) {
      $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
    }
    return $this->entityManager;
  }

  /**
* Cadastros list action
*
* Fetches and displays all users.
*
* @return array view variables
*/
  public function indexAction()
  {
    $repository = $this->getEntityManager()->getRepository('Cadastro\Entity\Cadastro');
    $users = $repository->findAll();
    return array(
      'users' => $users
    );
  }

  /**
* Adds new Cadastro
* @return array view variables
*/
  public function addAction()
  {
    // Loading and saving entity manager to Registry
    $em = $this->getEntityManager();
    Registry::set('entityManager', $em);

    $user = new Cadastro();
    $form = new CadastroForm();
    $form->bind($user);
    
    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $em->persist($user);
        $em->flush();

        $this->redirect()->toRoute('user');
      }
    }

    return array(
        'form' => $form
    );
  }

  /**
* Edits Cadastro
* @return array view variables
*/
  public function editAction()
  {
    $request = $this->getRequest();
    // Getting id parameter either from request or POST
    $id = $request->isPost() ? $request->getPost()->user["id"]:
            (int) $this->params('id', null);
    
    if (null === $id) {
      return $this->redirect()->toRoute('user');
    }

    $em = $this->getEntityManager();
    Registry::set('entityManager', $em);

    $user = $em->find('Cadastro\Entity\Cadastro', $id);

    $form = new CadastroForm();
    $form->bind($user);

    if ($request->isPost()) {
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $em->persist($user);
        $em->flush();

        $this->redirect()->toRoute('user');
      }
    }

    return array(
      'form' => $form,
      'id' => $id
    );
  }

  /**
* Deletes an Cadastro
*/
  public function deleteAction()
  {
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('user');
    }

    $em = $this->getEntityManager();

    $user = $em->find('Cadastro\Entity\Cadastro', $id);

    $em->remove($user);
    $em->flush();

    $this->redirect()->toRoute('user');
  }
}


