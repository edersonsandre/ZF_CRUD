<?php
namespace Cadastro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Cadastro\Entity\Registry;

/**
* Sandbox Controller
*/
class SandboxController extends AbstractActionController {

    public function indexAction()
    {
        Registry::set("a", "b");

        echo Registry::get("a");
        die();
    }
}