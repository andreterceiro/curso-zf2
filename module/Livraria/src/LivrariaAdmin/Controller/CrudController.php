<?php
namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

abstract class CrudController extends AbstractActionController
{
    /**
     *
     * @var EntityManager
     */
    protected $em;
    
    protected $nome;
    
    protected $servicePath;    
    
    protected $entityPath;
    
    protected $formClass;    
    
    public function indexAction()
    {
        $list = $this->getEm()
                ->getRepository($this->entityPath)
                ->findAll();

        $page = $this->params()->fromRoute('page');
        
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(5);
        
        return new ViewModel(
            array(
                'data' => $paginator,
                'page' => $page
            )
        );
    }
    
    public function newAction()
    {
        $form = new $this->formClass();
        
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->servicePath);
                $service->insert($this->getRequest()->getPost()->toArray());
                
                return $this->redirect()->toRoute(
                    'livraria-admin',
                    array(
                        'controller' => $this->nome,
                        'action' => 'index'
                    )
                );
            }
        }
        
        return new ViewModel(
            array(
                'form' => $form,
                'teste' => array(1,2)
            )
        );
    }
    
    public function editAction()
    {
        $form = new $this->formClass;
        $request = $this->getRequest();
        $repository = $this->getEm()->getRepository($this->entityPath);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
        
        if ($this->params()->fromRoute('id', 0)) {
            $form->setData($entity->toArray());
        }
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $categoriaService = $this->getServiceLocator()->get($this->servicePath);
                $categoriaService->update(
                    $this->getRequest()->getPost()->toArray()
                );
                
                $this->redirect()->toRoute(
                    'livraria-admin', 
                    array(
                        'controller' => $this->nome,
                        'action' => 'index'
                    )
                );
            }
        }
        
        return new ViewModel(
            array(
                'form' => $form
            )
        );
    }
    
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', false);
        
        if ($id) {
            $categoriaService = $this->getServiceLocator()->get($this->servicePath);
            $categoriaService->delete($id);
            $this->redirect()->toRoute(
                'livraria-admin',
                array(
                    'controller' => $this->nome,
                    'action' => 'index'
                )
            );
        }
    }
    
    /**
     * @return EntityManager
     */
    protected function getEm()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        
        return $this->em;
    }
}
