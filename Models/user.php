<?php
namespace shoppingCart\models;

use shoppingCart\repositories\UserRepository;

class user
{
    private $id;

    private $username;

    private $password;


    /**
     *  Category[]
     */
    private $categories;

    /**
     * @var UserProduct[]
     */
    private $products;

    public function __construct ($id=null ,$username, $password)

    {
        $this->setId($id);
        $this->setUsername($username);
        $this->setPassword($password);

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return UserProduct[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param UserProduct[] $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }






    public function save()
    {
        return UserRepository::create()->save($this);
    }


}