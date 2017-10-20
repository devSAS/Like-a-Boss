<?php

namespace Application\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager
{
    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;

    /**
     * Url view helper.
     * @var Zend\View\Helper\Url
     */
    private $urlHelper;

    /**
     * Constructs the service.
     */
    public function __construct($authService, $urlHelper, $sessionManager)
    {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
        $this->sessionManager = $sessionManager;
    }

    /**
     * This method returns menu items depending on whether user has logged in or not.
     */
    public function getMenuItems()
    {
        $name = $this->sessionManager->username;
        $url = $this->urlHelper;
        $items = [];

        $items[] = [
            'id' => 'brands',
            'label' => 'Brands',
            'link' => $url('brands')
        ];
        $items[] = [
            'id' => 'catalog',
            'label' => 'Catalog',
            'link' => $url('catalog')
        ];
        $items[] = [
            'id' => 'new',
            'label' => 'New',
            'link' => $url('new')
        ];
        $items[] = [
            'id' => 'sale',
            'label' => 'Sale',
            'link' => $url('sale')
        ];

        if (!$this->authService->hasIdentity()) {
            $items[] = [
                'id' => 'login',
                'label' => 'Sign in',
                'link' => $url('login'),
                'float' => 'right'
            ];
        } else {
            $items[] = [
                'id' => 'admin',
                'label' => 'Admin',
                'dropdown' => [
                    [
                        'id' => 'users',
                        'label' => 'Manage Users',
                        'link' => $url('users')
                    ],
                    ['id' => 'products',
                        'label' => 'Manage Products',
                        'link' => $url('product')
                    ],
                    ['id' => 'roles',
                        'label' => 'Manage Roles',
                        'link' => $url('roles')
                    ]

                ]
            ];


            $items[] = [
                'id' => 'logout',
                'label' => $this->authService->getIdentity(),
                'float' => 'right',
                'dropdown' => [
                    [
                        'id' => 'settings',
                        'label' => 'Settings',
                        'link' => $url('application', ['action' => 'settings'])
                    ],
                    [
                        'id' => 'logout',
                        'label' => 'Sign out',
                        'link' => $url('logout')
                    ],
                ]
            ];
        }

        return $items;
    }
}


