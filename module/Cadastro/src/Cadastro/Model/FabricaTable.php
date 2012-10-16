<?php

namespace Cadastro\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class FabricaTable extends AbstractTableGateway {

    protected $table = 'tbl_fabrica';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Fabrica());

        $this->initialize();
    }

    public function fetchAll() {
        $resultSet = $this->select();
        return  $resultSet;
    }

    public function getFabrica($id) {
        $id = (int) $id;

        $rowset = $this->select(array(
            'fabrica' => $id,
                )
        );

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function saveFabrica(Fabrica $fabrica) {
        $data = array(
            'fabrica' => $fabrica->fabrica,
            'nome' => $fabrica->nome,
            'ativo' => $fabrica->ativo
        );

        $id = (int) $fabrica->fabrica;

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getFabrica($id)) {
            
            $this->update(
                    $data, array(
                'fabrica' => $id,
                    )
            );
        } else {
            throw new \Exception('Form id does not exist');
        }
    }

    public function deleteFabrica($id) {

        $this->delete(array(
            'fabrica' => $id,
        ));
    }

}

?>
