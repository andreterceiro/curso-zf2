<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Livraria\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        /*
        $categoriaService = $this->getServiceLocator()->get('Livraria\Model\CategoriaService');
        $categorias = $categoriaService->fetchAll();
        
        return new ViewModel(
            array(
                'categorias' => $categorias
            )
        );
        */
        
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repo = $em->getRepository('Livraria\Entity\Categoria');
        
        $categorias = $repo->findAll();
        
        return new ViewModel(
            array(
                'categorias' => $categorias
            )
        );        
    }
}
