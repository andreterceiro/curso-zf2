<?php
namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Configurator;

class Usuario extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Livraria\Entity\Usuario';
        parent::__construct($em);
    }
    
    public function insert(array $data)
    {
        return parent::insert($data);
    }
    
    public function update(array $data)
    {
        /*
        $entity = $this->em->getReference(
            $this->entity,
            $data['']
        );
         * 
         */
        
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        }
        return parent::update($data);
    }
}