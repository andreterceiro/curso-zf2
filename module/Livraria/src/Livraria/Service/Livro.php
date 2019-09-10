<?php
namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Configurator;

class Livro extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Livraria\Entity\Livro';
        parent::__construct($em);
    }
    
    public function insert(array $data)
    {
        $entityLivro = new $this->entity($data);
        $entityLivro->setCategoria(
            $this->em->getReference('Livraria\Entity\Categoria', $data['categoria'])
        );
        $this->em->persist($entityLivro);
        $this->em->flush();
        
        return $entityLivro;
    }
    
    public function update(array $data)
    {
        $entityLivro = $this->em->getReference($this->entity, $data['id']);
        Configurator::configure($entityLivro, $data);
        $entityLivro->setCategoria(
            $this->em->getReference('Livraria\Entity\Categoria', $data['categoria'])
        );
        $this->em->persist($entityLivro);
        $this->em->flush();    
        
        return $entityLivro;        
    }
}