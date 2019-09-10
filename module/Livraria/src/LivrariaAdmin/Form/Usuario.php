<?php
namespace LivrariaAdmin\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class Usuario extends Form
{
    public function __construct($name=null)
    {
        parent::__construct('usuario');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new LivroFilter);
        
        $this->add(
            array(
                'name' => 'id',
                'attributes' => array(
                    'type' => 'hidden'
                )
            )
        );
        
        $this->add(
            array(
                'name' => 'nome',
                'options' => array(
                    'type' => 'text',
                    'label' => 'Nome'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o nome'
                ),
            )
        );

        $this->add(
            array(
                'name' => 'email',
                'options' => array(
                    'type' => 'email',
                    'label' => 'E-mail'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o e-mail'
                ),
            )
        );                
        
        $this->add(
            array(
                'name' => 'password',
                'options' => array(
                    'type' => 'password',
                    'label' => 'Password'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o password'
                ),
            )
        );        
        
        $this->add(
            array(
                'name' => 'salt',
                'options' => array(
                    'type' => 'text',
                    'label' => 'Salt'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o salt'
                ),
            )
        );                        
        
        $this->add(
            array(
                'name' => 'submit',
                'type' => 'Zend\Form\Element\Submit',
                'attributes' => array(
                    'value' => 'Salvar',
                    'class' => 'btn-success'
                )
            )
        );
    }
}