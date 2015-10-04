<?php
namespace shoppingCart\models;

class Category
{

    private $id;

    private $name;

    private $cart_money;

    /**
     * @var user
     */
    private $user;


    public function __construct( $id, $name, $cart_money ,user $user){
        $this->setId($id);
        $this->setName($name);
        $this->setCartMoney($cart_money);
        $this->setUser($user);

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param user $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCartMoney()
    {
        return $this->cart_money;
    }

    /**
     * @param mixed $cart_money
     */
    public function setCartMoney($cart_money)
    {
        $this->cart_money = $cart_money;
    }




}