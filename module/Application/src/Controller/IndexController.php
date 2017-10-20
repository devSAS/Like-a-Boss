<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Products;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;


class IndexController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function indexAction()
    {
        return new ViewModel();
    }

    public function brandsAction()
    {
        return new ViewModel();
    }
    public function saleAction()
    {
        return new ViewModel();
    }

    public function newAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $query = $this->entityManager->getRepository(Products::class)
                ->findNewProducts();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(1);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'products' => $paginator,
        ]);
    }


    public function catalogAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $query = $this->entityManager->getRepository(Products::class)
            ->findProducts();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(1);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'products' => $paginator,
        ]);
    }

}
