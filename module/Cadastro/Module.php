<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cadastro;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Cadastro\Form\FamiliaForm;
use Cadastro\Model\FamiliaTable;
use Cadastro\Form\LinhaForm;
use Cadastro\Model\LinhaTable;
use Cadastro\Form\FabricaForm;
use Cadastro\Model\FabricaTable;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Cadastro\Model\FamiliaTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new FamiliaTable($dbAdapter);
                    return $table;
                },
                'Cadastro\Model\LinhaTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new LinhaTable($dbAdapter);
                    return $table;
                },
                'Cadastro\Model\FabricaTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new FabricaTable($dbAdapter);
                    return $table;
                },
            ),
        );
    }

}
