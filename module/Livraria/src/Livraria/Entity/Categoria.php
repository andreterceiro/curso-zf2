<?php
namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Livraria\Entity\Configurator;

/**
 * @ORM\Entity
 * @ORM\Table(name="categorias")
 * @ORM\Entity(repositoryClass="Livraria\Entity\CategoriaRepository")
 */
class Categoria
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     *@ORM\OneToMany(targetEntity="Livraria\Entity\Livro", mappedBy="categoria")
     */
    protected $livros;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    public function __construct($options = null)
    {
        Configurator::configure($this, $options);
        $this->livros = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function __toString()
    {
        return $this->nome;
    }
    
    public function getLivros()
    {
        return $this->livros;
    }
    
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
        );
    }
}

