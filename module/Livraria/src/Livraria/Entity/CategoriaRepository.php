<?php
namespace Livraria\Entity;

use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends EntityRepository
{
    
    public function fetchPairs()
    {
        $entitiesCategorias = $this->findAll();
        
        $arrayRetorno = array();
        foreach ($entitiesCategorias as $entityCategoria) {
            $arrayRetorno[$entityCategoria->getId()]  = $entityCategoria->getNome();
        }
        
        return $arrayRetorno;
    }
}
