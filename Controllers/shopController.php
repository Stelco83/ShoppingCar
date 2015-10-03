<?php
namespace shoppingCart\Controllers;

use shoppingCart\repositories\CategoryRepository;
use ShoppingCart\Repositories\UserRepository;
class shopController extends Controller
{
    /**
    * @var \ShoppingCart\Models\User
    */
    protected $currentUser = null;
    protected $currentCategory = null;

protected function onLoad()
{
    if (!isset($_SESSION['userid'])) {
        $this->redirect('users', 'login');

    }
    if ($this->currentUser == null) {
        $this->currentUser = UserRepository::create()
            ->getOne($_SESSION['userid']);

    }

    if ($this->currentCategory == null) {
        $this->currentCategory =
            CategoryRepository::create()->getOne($_SESSION['category_id']);

    }

    $this->view->userName = $this->currentUser->getUsername();
    $this->view->partial('authHeader');
    $this->view->partial('adminHeader');
    $this->view->partial('login');



}
    public function index()
    {
        $this->view->categories = $this->currentUser->getCategories();

    }

}