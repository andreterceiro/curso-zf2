<?php
namespace LivrariaAdmin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Doctrine\ORM\EntityManager;

class Livro extends Form
{
    public function __construct($name=null, $listaCategorias)
    {
        parent::__construct('livro');
        
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

        $categoria = new Select;
        $categoria->setLabel('Categoria')
            ->setName('categoria')       
            ->setOptions(
                array(
                    'value_options' => $listaCategorias
                )
            );                
        
        $this->add($categoria);
        
        $this->add(
            array(
                'name' => 'autor',
                'options' => array(
                    'type' => 'text',
                    'label' => 'Autor'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o autor'
                ),
            )
        );                
        
        $this->add(
            array(
                'name' => 'isbn',
                'options' => array(
                    'type' => 'text',
                    'label' => 'ISBN'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o isbn'
                ),
            )
        );        
        
        $this->add(
            array(
                'name' => 'valor',
                'options' => array(
                    'type' => 'text',
                    'label' => 'Valor'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o valor'
                ),
            )
        );                        
        
        $this->add(
            array(
                'name' => 'paginas',
                'options' => array(
                    'type' => 'text',
                    'label' => 'Páginas'
                ),
                'attributes' => array(
                    'id' => 'nome',
                    'placeholder' => 'Entre com o número de páginas'
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