<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Livraria\Model;

class Categoria
{
    public $id;
    public $nome;
    
    public function exchangeArray($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->nome = isset($data['nome']) ? $data['nome'] : null;        
    }
    
    
}

