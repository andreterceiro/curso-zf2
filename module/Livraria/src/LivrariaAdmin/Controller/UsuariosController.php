<?php
namespace LivrariaAdmin\Controller;

class UsuariosController extends CrudController
{
    protected $nome = 'Usuarios';
    
    protected $servicePath = 'Livraria\Service\Usuario';
    
    protected $entityPath = 'Livraria\Entity\Usuario';    
    
    protected $formClass = 'LivrariaAdmin\Form\Usuario';
}
