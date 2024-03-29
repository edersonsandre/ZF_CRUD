<?php

namespace Cadastro\Form;

use Zend\Form\Form;
use Cadastro\Model\LinhaTable;

class FamiliaForm extends Form {
    
    public function linhas(){
        //$linha = new LinhaTable('linha');
//        $_linha->fetchAll();
        
        return array(
            '0' => 'Linha 001'
        );
    }
    
    public function __construct($name = null) {
        
        // we want to ignore the name passed
        parent::__construct('familia');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'familia',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'fabrica',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Fabrica',
                'value_options' => array(
                    '10' => 'Telecontrol'
                )
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'linha',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Linha',
                'value_options' => $this->linhas()
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'descricao',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Descrição',
                
            ),
        ));
        $this->add(array(
            'name' => 'codigo',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Código',
            ),
        ));

        $this->add(array(
            'name' => 'ativo',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Ativo',
                'value_options' => array(
                    '1' => 'Sim',
                    '0' => 'Não',
                ),
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Gravar ',
                'id' => 'submitbutton',
            ),
        ));
    }

}