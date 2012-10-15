<?php

namespace Cadastro\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class FamiliaTable extends AbstractTableGateway {

    protected $table = 'tbl_familia';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Familia());

        $this->initialize();
    }

    public function fetchAll() {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getFamilia($id) {
        $id = (int) $id;

        $rowset = $this->select(array(
            'id' => $id,
                ));

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function saveFamilia(Familia $familia) {
        $data = array(
            'familia' => $familia->familia,
            'fabrica' => $familia->fabrica,
            'descricao' => $familia->descricao,
            'codigo' => $familia->codigo,
            'linha' => $familia->linha,
            'ativo' => $familia->ativo
        );


        $id = (int) $familia->familia;

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getFamilia($id)) {
            $this->update(
                    $data, array(
                'familia' => $id,
                    )
            );
        } else {
            throw new \Exception('Form id does not exist');
        }
    }

    public function deleteFamilia($id) {
        $this->delete(array(
            'familia' => $id,
        ));
    }

}

?>
