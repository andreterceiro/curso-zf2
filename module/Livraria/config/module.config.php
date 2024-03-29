<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Livraria;

return array(
    'module_layouts' => array(
        'Livraria' => 'layout/layout',
        'LivrariaAdmin' => 'layout/layout-admin',        
    ),
    'router' => array(
        'routes' => array(
            'raiz' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Livraria\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),            
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/livraria',
                    'defaults' => array(
                        'controller' => 'Livraria\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'livraria-admin-interna' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller[/:action]][/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                ),
            ),                        
            'livraria-admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller[/:action][/page/:page]]',
                    'defaults' => array(
                        'action'     => 'index',
                    ),
                ),
            ),            
            'livraria-admin-auth' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/auth',
                    'defaults' => array(
                        'controller' => 'LivrariaAdmin\Controller\Auth',
                        'action'     => 'index',
                    ),
                ),
            ),
            'livraria-admin-auth-logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/auth/logout',
                    'defaults' => array(
                        'controller' => 'LivrariaAdmin\Controller\Auth',
                        'action'     => 'logout',
                    ),
                ),
            ),            
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array( 
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),            
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Livraria\Controller\Index' => 'Livraria\Controller\IndexController',
            'categorias' => 'LivrariaAdmin\Controller\CategoriasController',
            'livros' => 'LivrariaAdmin\Controller\LivrosController',            
            'usuarios' => 'LivrariaAdmin\Controller\UsuariosController',
            'LivrariaAdmin\Controller\Auth' => 'LivrariaAdmin\Controller\AuthController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/externa'           => __DIR__ . '/../view/layout/externa.phtml',            
            'livraria/index/index' => __DIR__ . '/../view/livraria/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
