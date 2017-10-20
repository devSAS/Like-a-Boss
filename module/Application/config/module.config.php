<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'brands' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/brands',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'brands',
                    ],
                ],
            ],
            'new' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/new',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'new',
                    ],
                ],
            ],
            'sale' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/sale',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'sale',
                    ],
                ],
            ],
            'catalog' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/catalog',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'catalog',
                    ],
                ],
            ],
            'singin' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/singin',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'singin',
                    ],
                ],
            ],
            'add' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/add',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'add',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'product' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/product[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        'controller'    => Controller\ProductController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\ProductController::class => Controller\Factory\ProductControllerFactory::class,
        ],
    ],

    'access_filter' => [
        'options' => [
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                ['actions' => ['index', 'new','brands','sale','catalog'], 'allow' => '*'],
                ['actions' => ['settings'], 'allow' => '@']
            ],
            Controller\ProductController::class => [
                ['actions' => ['view'], 'allow' => '*'],
                ['actions' => ['index','editInfo','edit','add','delete'], 'allow' => '+user.manage'],
            ],
        ]
    ],
    'rbac_manager' => [
        'assertions' => [Service\RbacAssertionManager::class],
    ],

    'service_manager' => [
        'factories' => [
            Service\NavManager::class => Service\Factory\NavManagerFactory::class,
            Service\ProductManager::class => Service\Factory\ProductManagerFactory::class,
            Service\RbacAssertionManager::class => Service\Factory\RbacAssertionManagerFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => View\Helper\Factory\MenuFactory::class,
            View\Helper\Breadcrumbs::class => InvokableFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class,
            'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',

        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
];
