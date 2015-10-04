<?php
namespace shoppingCart\Controllers;

use shoppingCart\Db;
use shoppingCart\models\user;
use shoppingCart\repositories\UserRepository;

class UsersController extends Controller
{
    public function login()
    {
        $this->view->error = false;
        $this->view->user = false;
        $this->view->partial('guestHeader');

        if(isset($_POST['login']) ) {
            $username = htmlspecialchars ($_POST ['username']);
            $password = $_POST['password'];
            $user = UserRepository::create()
                ->getOneByDetails($username, $password);

            if (!$user) {
                $this->view->error = "Invalid details;";
                return;
            }

            $_SESSION['userid'] = $user->getId();
            $_SESSION['category_id'] = $user->getCategories();
            $this->view->user = $user->getUsername();
            $this->redirect('shop');

        }

        if(isset($_POST['toRegister']) ){
            $this->redirect('users','register');
        }
    }

    public function register()
    {
        $this->view->error = false;
        if (isset($_POST['register'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST[('password')];
            $user = new user($id=null,$username, md5($password),$products=null);
            if (!$user->save()) {
                $this->view->error = "duplicate users";
                echo "Try again!";

            }else{
                $this->redirect('users','login');
            }

            $this->login();

        }

        if(isset($_POST['toLogin']) ){
            $this->redirect('users','login');
        }
    }


    public function delete()
    {

            $user = UserRepository::create()->getOne($_SESSION['userid']);

           if(!isset($_SESSION['userid']) || $_SESSION['userid'] != 1 ){
            $this->redirect('shop');
          }
            echo ucfirst($user->getUsername()) . ' is deleted';
    }



    public function logout()
    {
        session_destroy();
        $this->redirect('users', 'login');
        die;

    }



}