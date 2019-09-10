<?php
namespace Livraria\Service;

use Doctrine\ORM\EntityManager;

class Categoria extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Livraria\Entity\Categoria';
        parent::__construct($em);
        //return $this;
    }
}