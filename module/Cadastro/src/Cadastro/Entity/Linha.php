<?php

namespace Cadastro\Entity;

use Zend\Db\Adapter\Adapter;
use Cadastro\Model\LinhaTable;

class Linha extends LinhaTable {

    public function __construct() {
        $adapter = new Adapter();

        parent::__construct();
    }

    public function teste() {
        echo "AQQQQ";


        //$select =  $this->getFabricaTable()->fetchAll();
    }

}

?>
