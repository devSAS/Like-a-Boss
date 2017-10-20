<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This product class.
 * @ORM\Entity(repositoryClass="\Application\Repository\ProductsRepository")
 * @ORM\Table(name="product")
 */
class Products
{


    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="status")
     */
    protected $status;

    /**
     * @ORM\Column(name="brand")
     */
    protected $brand;
    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\ProductsInfo", mappedBy="product")
     * @ORM\JoinColumn(name="id", referencedColumnName="product_id")
     */
    protected $productInfo;
    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\Comment", mappedBy="product")
     * @ORM\JoinColumn(name="id", referencedColumnName="product_id")
     */
    protected $comments;

    public function __construct()
    {
        $this->productInfo = new ArrayCollection();
        $this->comments = new ArrayCollection();

    }

    /**
     * Returns user ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets user ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns count.
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Sets count.
     * @param string $count
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * Returns name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets name.
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns status.
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets status.
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    /**
     * Returns info for this product.
     * @return array
     */
    public function getProductInfo()
    {
        return $this->productInfo;
    }

    /**
     * Adds a new info to this product.
     * @param $productInfo
     */
    public function addProductInfo($productInfo)
    {
        $this->productInfo[] = $productInfo;
    }

    /**
     * Returns comments for this product.
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Adds a new comment to this product.
     * @param $comment
     */
    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }


}



