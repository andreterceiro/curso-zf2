<?php
namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;
use Livraria\Entity\Configurator;

/**
 * @ORM\Entity
 * @ORM\Table(name="livros")
 * @ORM\Entity(repositoryClass="Livraria\Entity\LivroRepository")
 */
class Livro
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Livraria\Entity\Categoria", inversedBy="livro")
     * @orm\JoinColumn(name="categoria_id", referencedColumnName="id")
     * @var string
     */
    protected $categoria;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $autor;    
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $isbn;
    
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $valor;    

    /**
     * @ORM\Column(type="integer")
     * @var float
     */
    protected $paginas;  

    public function __construct($options = null)
    {
        Configurator::configure($this, $options);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getValor() {
        return $this->valor;
    }
    
    public function getPaginas() {
        return $this->paginas;
    }    
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
    
    public function setPaginas($paginas) {
        $this->paginas = $paginas;
    }    

    public function __toString()
    {
        return $this->nome;
    }
    
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'autor' => $this->getAutor(),
            'isbn' => $this->getIsbn(),            
            'valor' => $this->getValor(),
            'paginas' => $this->getPaginas(),            
            'categoria' => $this->getCategoria(), /* No do wesley foi necessário ser um $this->getCategoria()->getId()*/
        );
    }
}

