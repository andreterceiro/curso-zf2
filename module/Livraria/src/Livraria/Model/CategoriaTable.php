<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Livraria\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\Resultset;
use Zend\Db\TableGateway\AbstractTableGateway;

class CategoriaTable extends AbstractTableGateway
{
    protected $table = 'categorias';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Categoria());
        $this->initialize();
    }
}

