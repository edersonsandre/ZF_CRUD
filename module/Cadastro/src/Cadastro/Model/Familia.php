<?php

namespace Cadastro\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Familia {
    
    protected $inputFilter;
    
    public $familia;
    public $fabrica;
    public $descricao;
    public $codigo;
    public $linha;
    public $ativo;

    public function exchangeArray($data) {
        $this->familia = (isset($data['familia'])) ? $data['familia'] : null;
        $this->fabrica = (isset($data['fabrica'])) ? $data['fabrica'] : null;
        $this->descricao = (isset($data['descricao'])) ? $data['descricao'] : null;
        $this->codigo = (isset($data['codigo'])) ? $data['codigo'] : null;
        $this->linha = (isset($data['linha'])) ? $data['linha'] : null;
        $this->ativo = (isset($data['ativo'])) ? $data['ativo'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            
            $inputFilter->add($factory->createInput(array(
                        'name' => 'fabrica',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                    )));
            
            $inputFilter->add($factory->createInput(array(
                        'name' => 'familia',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                    )));
            
            $inputFilter->add($factory->createInput(array(
                        'name' => 'linha',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                    )));
            
            $inputFilter->add($factory->createInput(array(
                        'name' => 'ativo',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'descricao',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'codigo',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 50,
                                ),
                            ),
                        ),
                    )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}

?>
