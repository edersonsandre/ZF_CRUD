<?php

namespace Cadastro\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class LinhaTable extends AbstractTableGateway {

    protected $table = 'tbl_linha';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Linha());

        $this->initialize();
    }

    public function fetchAll() {
        $resultSet = $this->select();
        return  $resultSet;
    }
    
    public function combo() {
        $resultSet = $this->select();
        return  $resultSet;
    }

    public function getLinha($id) {
        $id = (int) $id;

        $rowset = $this->select(array(
            'linha' => $id,
                )
        );

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function saveLinha(Linha $linha) {
        $data = array(
            'linha' => $linha->linha,
            'fabrica' => $linha->fabrica,
            'nome' => $linha->nome,
            'codigo_linha' => $linha->codigo_linha,
            'marca' => $linha->marca,
            'ativo' => $linha->ativo
        );

        $id = (int) $linha->linha;

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getLinha($id)) {
            $this->update(
                    $data, array(
                'linha' => $id,
                    )
            );
        } else {
            throw new \Exception('Form id does not exist');
        }
    }

    public function deleteLinha($id) {

        $this->delete(array(
            'linha' => $id,
        ));
    }

}

?>
