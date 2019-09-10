<?php
namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;
use Livraria\Entity\Configurator;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="Livraria\Entity\UsuarioRepository")
 */
class Usuario
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $email;    
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $password;        
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $salt;            

    public function __construct($data = null) {
        Configurator::configure($this, $data);
        $this->configurarSalt(
            base_convert(
                sha1(
                    uniqid(mt_rand(), true  )
                ),
                16,
                36
            )
        );
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;        
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;        
    }

    public function setPassword($password) {
        $this->password = $this->obterHashPassword($password);
        return $this;        
    }

    private function configurarSalt($salt) {
        $this->salt = $salt;
        return $this;        
    }

    public function __toString()
    {
        return $this->nome;
    }
    
    public function obterHashPassword($password)
    {
        return hash(
            'sha512',
            $password . $this->getSalt()
        );
    }
    
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),            
            'salt' => $this->getSalt(),
        );
    }
}

