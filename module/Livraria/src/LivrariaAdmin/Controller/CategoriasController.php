<?php
namespace LivrariaAdmin\Controller;

class CategoriasController extends CrudController
{
    protected $nome = 'Categorias';
    
    protected $servicePath = 'Livraria\Service\Categoria';
    
    protected $entityPath = 'Livraria\Entity\Categoria';    
    
    protected $formClass = 'LivrariaAdmin\Form\Categoria';
}
