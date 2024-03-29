<?php
namespace Livraria\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;


class UserIdentity extends AbstractHelper
{
    
    protected $authService;

    public function getAuthService()
    {
        return $this->authService;
    }
    
    public function __invoke($namespace = null)
    {
        $sessionStorage = new SessionStorage('LivrariaAdmin');
        $this->authService = new AuthenticationService;
        $this->getAuthService()->setStorage($sessionStorage);
        
        if ($this->getAuthService()->hasIdentity()) {
            return $this->getAuthService()->getIdentity();
        } else {
            return false;
        }
    }
}
