<?php

namespace Application\Controller;

use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Products;
use Application\Entity\ProductsInfo;
use User\Entity\User;
use Application\Form\ProductForm;
use Application\Form\CommentForm;


class ProductController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Post manager.
     * @var Application\Service\ProductManager
     */
    private $productManager;

    /**
     * Constructor is used for injecting dependencies into the controller.
     */
    public function __construct($entityManager, $productManager)
    {
        $this->entityManager = $entityManager;
        $this->productManager = $productManager;
    }

    public function indexAction()
    {
        $products = $this->entityManager->getRepository(Products::class)
            ->findBy([], ['id' => 'ASC']);

        return new ViewModel([
            'products' => $products
        ]);
    }

    /**
     * Add new Product
     */
    public function addAction()
    {

        $form = new ProductForm('create');

        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray());

            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->productManager->addNewProduct($data);
                return $this->redirect()->toRoute('product');
            }
        }
        return new ViewModel([
            'form' => $form
        ]);
    }

    /**
     * This action displays the "View Product" page allowing to see the product info
     * and content. The page also contains a form allowing
     * to add a comment to product.
     */
    public function viewAction()
    {
        $productId = (int)$this->params()->fromRoute('id', -1);

        if ($productId < 0) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $product = $this->entityManager->getRepository(Products::class)
            ->findOneById($productId);

        if ($product == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new CommentForm();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->productManager->addCommentToProduct($product, $data);
                return $this->redirect()->toRoute('product', ['action' => 'view', 'id' => $productId]);
            }
        }

        // Render the view template.
        return new ViewModel([
            'product' => $product,
            'form' => $form,
            'postManager' => $this->productManager
        ]);
    }

    /**
     * The "edit" action displays a page allowing to edit user.
     */
    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id < 1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $product = $this->entityManager->getRepository(Products::class)
            ->find($id);

        if ($product == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new ProductForm('update');
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->productManager->updateProduct($product, $data);
                return $this->redirect()->toRoute('product');
            }
        } else {
            $form->setData(array(
                'name' => $product->getName(),
                'brand' => $product->getBrand(),
                'status' => $product->getStatus(),
            ));
        }

        return new ViewModel(array(
            'product' => $product,
            'form' => $form
        ));
    }


    /**
     * The "editInfo" action displays a page allowing to edit product info.
     */
    public function editInfoAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id < 1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $product = $this->entityManager->getRepository(ProductsInfo::class)
            ->findByProductId($id);
        if ($product == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $form = new ProductForm('updateInfo');
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->productManager->updateProductInfo($product, $data);
                return $this->redirect()->toRoute('product');
            }
        } else {
            $form->setData(array(/*
                'color'=>$product->getColor(),
                'size'=>$product->getSize(),
                'price'=>$product->getPrice(),
                'count'=>$product->getCount(),*/
            ));
        }
        return new ViewModel(array(
            'product' => $product,
            'form' => $form
        ));
    }

    /**
     * This "delete" action deletes the given product.
     */
    public function deleteAction()
    {
        $productId = (int)$this->params()->fromRoute('id', -1);

        // Validate input parameter
        if ($productId < 0) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $product = $this->entityManager->getRepository(Products::class)
            ->findOneById($productId);
        if ($product == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $this->productManager->removeProduct($product);

        // Redirect the user to "admin" page.
        return $this->redirect()->toRoute('product', ['action' => 'index']);

    }


}
