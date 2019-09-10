<?php
namespace Livraria\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository
{
    public function findByEmailAndPassword($email, $password)
    {
        $user = $this->findOneByEmail($email);
        
        if ($user) {
            $hashPassword = $user->obterHashPassword($password);
            if($user->getPassword() === $hashPassword) {
                return $user;
            } else {
                return false;
            }
        }
        
        return false;
        
    }
    
}
