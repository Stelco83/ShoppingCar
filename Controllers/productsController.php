<?php
namespace shoppingCart\Controllers;


class productsController extends shopController
{

    public function index()
    {

      $this->view->userProducts = $this->currentUser->getProducts();

    }


    public function sell()
    {
        
    }

    public function buy(){
        
    }
}