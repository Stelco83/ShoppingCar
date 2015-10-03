<?php
namespace shoppingCart\models;

class Category
{

    private $id;

    private $name;

    /**
     * @var user
     */
    private $user;


    public function __construct( $id, $name, user $user){
        $this->setId($id);
        $this->setName($name);
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




}