<?php

namespace Cadastro\Form;

use Zend\Form\Form;

class LinhaForm extends Form {

    public function __construct($name = null) {

        parent::__construct('linha');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'linha',
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
                    '10' => 'Telecontrol',
                ),
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'nome',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Nome',
            ),
        ));
        
        $this->add(array(
            'name' => 'codigo_linha',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Código Linha',
            ),
        ));
        
        $this->add(array(
            'name' => 'marca',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Marca',
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