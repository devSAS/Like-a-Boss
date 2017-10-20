<?php
namespace Application\Service;

use User\Entity\User;
use Zend\ServiceManager\ServiceManager;
use Application\Entity\Products;
use Application\Entity\ProductsInfo;
use Application\Entity\Comment;
use Zend\Filter\StaticFilter;


class ProductManager
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
     */
    private $entityManager;

    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;

    /**
     * Constructor.
     */
    public function __construct($entityManager,$authService)
    {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }

    /**
     * This method adds a new product.
     */
    public function addNewProduct($data)
    {
        $product = new Products();
        $info = new ProductsInfo();
        $file = $data['file'];
        $imageName = $file['name'];

        $product->setName($data['name']);
        $product->setBrand($data['brand']);
        $product->setStatus($data['status']);

        $this->entityManager->persist($product);

        $info->setProduct($product);
        $info->setColor($data['color']);
        $info->setCount($data['count']);
        $info->setPrice($data['price']);
        $info->setSize($data['size']);
        $info->setImages($imageName);

        $this->entityManager->persist($info);
        $this->entityManager->flush();
    }

    /**
     * This method allows to update data of a product.
     */
    public function updateProduct($product, $data)
    {
        $product->setName($data['name']);
        $product->setBrand($data['brand']);
        $product->setStatus($data['status']);

        $this->entityManager->flush();
    }

    /**
     * This method allows to update data of a product info.
     */
    public function updateProductInfo($product, $data)
    {
        $product->setColor($data['color']);
        $product->setSize($data['size']);
        $product->setPrice($data['price']);
        $product->setCount($data['count']);

        $this->entityManager->flush();
    }

    /**
     * This method adds a new comment to product.
     */
    public function addCommentToProduct($product, $data)
    {

        $comment = new Comment();
        $comment->setProduct($product);
        $comment->setAuthor($this->authService->getIdentity());

        $comment->setContent($data['comment']);
        $currentDate = date('Y-m-d H:i:s');
        $comment->setDateCreated($currentDate);

        $this->entityManager->persist($comment);

        $this->entityManager->flush();
    }

    /**
     * Removes product and all associated product info and comments.
     */
    public function removeProduct($product)
    {
        $comments = $product->getComments();
        foreach ($comments as $comment) {
            $this->entityManager->remove($comment);
        }

        $productInfo = $product->getProductInfo();
        foreach ($productInfo as $info) {

            $this->entityManager->remove($info);
        }

        $this->entityManager->remove($product);

        $this->entityManager->flush();
    }
}