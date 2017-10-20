<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\ProductManager;
use Application\Controller\ProductController;

/**
 * This is the factory for PostController. Its purpose is to instantiate the
 * controller.
 */
class ProductControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $productManager = $container->get(ProductManager::class);
        
        // Instantiate the controller and inject dependencies
        return new ProductController($entityManager, $productManager);
    }
}


