<?php
namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use LivrariaAdmin\Form\Login as LoginForm;
use Livraria\Auth\Adapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

class AuthController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout('layout/externa');
        $error = true;
        $form = new LoginForm;
        
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            
            if ($form->isValid()) {
                $data = $this->getRequest()->getPost()->toArray();
                $auth = new AuthenticationService;
                $sessionStorage = new SessionStorage('LivrariaAdmin');
                $auth->setStorage($sessionStorage);
                
                $authAdapter = new AuthAdapter(
                    $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                );
                
                $authAdapter->setUsername($data['email'])->
                    setPassword($data['password']);
                
                $resultadoAutenticacao = $auth->authenticate($authAdapter);
                
                if ($resultadoAutenticacao->isValid()) {
                    $sessionStorage->write($auth->getIdentity()['user'], null);
                    $this->redirect()->toRoute(
                        'livraria-admin', 
                        array('controller' => 'livros', 'action' => 'index') 
                    );
                }
            }
        } else {
            $error = false;
        }
        
        return new ViewModel(
            compact('error', 'form')
        );
    }
    
    public function logoutAction()
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('LivrariaAdmin'));
        $auth->clearIdentity();
        
        return $this->redirect()->toRoute('livraria-admin-auth');
    }
    
}    
        