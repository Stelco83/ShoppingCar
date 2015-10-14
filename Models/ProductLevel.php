<?php
namespace shoppingCart\Models;

class ProductLevel{

    /**
     * @var product
     */
    private $product;
    private $levelId;
    private $cashConsume;
    private $quantityConsume;
    private $cashIncome;
    private $quantityIncome;
    public function __construct(
        Product $product,
        $levelId,
        $cashConsume,
        $quantityConsume,
        $cashIncome,
        $quantityIncome
    )
    {
        $this->product = $product;
        $this->levelId = $levelId;
        $this->cashConsume = $cashConsume;
        $this->quantityConsume = $quantityConsume;
        $this->cashIncome = $cashIncome;
        $this->quantityIncome = $quantityIncome;
    }

    /**
     * @return product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getLevelId()
    {
        return $this->levelId;
    }

    /**
     * @return mixed
     */
    public function getCashConsume()
    {
        return $this->cashConsume;
    }

    /**
     * @return mixed
     */
    public function getQuantityConsume()
    {
        return $this->quantityConsume;
    }

    /**
     * @return mixed
     */
    public function getCashIncome()
    {
        return $this->cashIncome;
    }

    /**
     * @return mixed
     */
    public function getQuantityIncome()
    {
        return $this->quantityIncome;
    }




}