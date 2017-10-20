<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This product class.
 * @ORM\Entity()
 * @ORM\Table(name="product_info")
 */
class ProductsInfo
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;


    /**
     * @ORM\Column(name="product_id")
     */
    protected $productId;

    /**
     * @ORM\Column(name="color")
     */
    protected $color;

    /**
     * @ORM\Column(name="size")
     */
    protected $size;

    /**
     * @ORM\Column(name="price")
     */
    protected $price;
    /**
     * @ORM\Column(name="count")
     */
    protected $count;
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Products", inversedBy="productsInfo")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ORM\Column(name="images")
     */
    protected $images;


    /**
     * Returns product ID.
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Sets product ID.
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * Returns color.
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Sets color.
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color= $color;
    }

    /**
     * Returns size.
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets name.
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * Returns price.
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets status.
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Returns count.
     * @return int
     */
    public function getCount()
    {
        return $this->price;
    }

    /**
     * Sets count.
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * Return images
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets images.
     * @param string $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }
    /**
     * Returns associated product.
     * @return \Application\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Sets associated product.
     * @param \Application\Entity\Products $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
        $product->addProductInfo($this);
    }


}



