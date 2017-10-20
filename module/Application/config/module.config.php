<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
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
            'singup' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/singup',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'singup',
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
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
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
];
