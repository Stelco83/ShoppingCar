<?php
namespace shoppingCart\Models;


class UserProduct
{
    private $id;
    /**
     * @var User
     */
    private $User;
    /**
     * @var Product
     */
    private $Product;
    /**
     * @var ProductLevel
     */
    private $level;
    /**
     * @var category
     */
    private $category;
    public function __construct(User $User, Product $Product,
             ProductLevel $level, category $category)
    {
        $this->User = $User;
        $this->Product = $Product;
        $this->level = $level;
        $this->category = $category;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->User;
    }
    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->Product;
    }
    /**
     * @return ProductLevel
     */
    public function getLevel()
    {
        return $this->level;
    }
    public function setLevel(ProductLevel $level)
    {
        $this->level = $level;
    }
    /**
     * @return category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @param category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


//    public function save()
//    {
//        return ProductRepository::create()->save($this);
//    }
}