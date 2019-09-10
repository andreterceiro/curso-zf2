<?php
namespace LivrariaAdmin\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class Login extends Form
{
    public function __construct($name=null)
    {
        parent::__construct('usuario');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new LivroFilter);
        
        $this->add(
            array(
                'name' => 'email',
                'options' => array(
                    'type' => 'email',
                    'label' => 'E-mail'
                ),
                'attributes' => array(
                    'id' => 'email',
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
                    'id' => 'password',
                    'placeholder' => 'Entre com o password'
                ),
            )
        );        
        
        $this->add(
            array(
                'name' => 'submit',
                'type' => 'Zend\Form\Element\Submit',
                'attributes' => array(
                    'value' => 'Fazer login',
                    'class' => 'btn-success'
                )
            )
        );
    }
}