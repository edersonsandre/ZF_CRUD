<?php

namespace Cadastro\Form;

use Zend\Form\Form;

class FamiliaForm extends Form {

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
            'attributes' => array(
                'type' => 'hidden',
                'value' => '10'
            ),
        ));

        $this->add(array(
            'name' => 'linha',
            'attributes' => array(
                'type' => 'text',
                'value' => '1'
            ),
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
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Ativo',
            ),
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