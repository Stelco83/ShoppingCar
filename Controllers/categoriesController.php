<?php
namespace shoppingCart\Controllers;

use shoppingCart\repositories\CategoryRepository;
use ShoppingCart\Repositories\UserRepository;
class categoriesController extends shopController
{


    public function change()
    {

      $hasCategory = false;

       foreach ($this->currentUser->getCategories() as $category)
       {

           if($category->getId() == $this->request->id ) {

               $hasCategory = true;

               break;
           }

       }

           if(!$hasCategory ){
              $this->redirect('shop');
           }

           $_SESSION['category_id'] = $this->request->id;
           $this->redirect('shop');



    }




}