<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Livraria;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;

use Livraria\Service\Categoria as CategoriaService;
use Livraria\Service\Livro as LivroService;
use Livraria\Service\Usuario as UsuarioService;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }, 100);
    }    

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ . 'Admin' => __DIR__ . '/src/' . __NAMESPACE__ . 'Admin',
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Livraria\Model\CategoriaService' => function ($service) {
                    $dbAdapter = $service->get('Zend\Db\Adapter\Adapter');
                    $categoriaTable = new Model\CategoriaTable($dbAdapter);
                    $categoriaService = new Model\CategoriaService($categoriaTable);
                    return $categoriaService;
                },
                'Livraria\Service\Categoria' => function ($service) {
                    return new CategoriaService(
                        $service->get('Doctrine\ORM\EntityManager')
                    );
                },
                'Livraria\Service\Livro' => function ($service) {
                    return new LivroService(
                        $service->get('Doctrine\ORM\EntityManager')
                    );
                },
                'Livraria\Service\Usuario' => function ($service) {
                    return new UsuarioService(
                        $service->get('Doctrine\ORM\EntityManager')
                    );
                }
            )
        );
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'UserIdentity' => new View\Helper\UserIdentity
            )
        );
    }
    
    public function init(ModuleManager $moduleManager)
    {
        $sharedEvent = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvent->attach(
            'LivrariaAdmin', 
            'dispatch', 
            function($e) {
                $auth = new \Zend\Authentication\AuthenticationService;
                $auth->setStorage(new \Zend\Authentication\Storage\Session('LivrariaAdmin'));
                $controller = $e->getTarget();
                $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
                
                $rotasProibidas = array('livraria-admin', 'livraria-admin-interna');

                if ((! $auth->hasIdentity()) && (in_array($matchedRoute, $rotasProibidas))) {
                    return $controller->redirect()->toRoute('livraria-admin-auth');
                }
            },
            99
        );
    }
}
