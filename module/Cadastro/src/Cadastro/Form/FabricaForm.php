<?php

namespace Cadastro\Form;

use Zend\Form\Form;
use Cadastro\Entity\Linha;


class FabricaForm extends Form {

    public function __construct($name = null) {
        
        parent::__construct('fabrica');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'fabrica',
            'attributes' => array(
                'type' => 'hidden',
            ),
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
            'name' => 'codigo_fabrica',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Código Fabrica',
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