<?php
namespace LivrariaAdmin\Controller;

use Zend\View\Model\ViewModel;

class LivrosController extends CrudController
{
    protected $nome = 'Livros';
    
    protected $servicePath = 'Livraria\Service\Livro';
    
    protected $entityPath = 'Livraria\Entity\Livro';    
    
    protected $formClass = 'LivrariaAdmin\Form\Livro';
    
    public function newAction()
    {
        $form = new $this->formClass(null, $this->obterListaCategorias());
        
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
        $form = new $this->formClass(null, $this->obterListaCategorias());
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
    
    /**
     * 
     * @return array
     * 
     */
    private function obterListaCategorias()
    {
        $repositoryCategoria = $this->getEm()->getRepository('Livraria\Entity\Categoria');
        return $repositoryCategoria->fetchPairs();
    }
    
}
