<?php
namespace shoppingCart\Repositories;

use shoppingCart\Db;
use shoppingCart\models\Category;
use shoppingCart\Models\user;
use shoppingCart\Models\UserProduct;
use shoppingCart\Models\Product;
use shoppingCart\Models\ProductLevel;

class UserRepository
{
    /**
     * @var \shoppingCart \Db
     */
    private $db;

    /**
     * @var UserRepository
     */
    private static $inst = null;

    private function __construct(\shoppingCart\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return UserRepository
     */
    public static function create()
    {
        if (self::$inst == null) {
            self::$inst = new self(Db::getInstance());
        }

        return self::$inst;
    }

    /**
     * @param $user
     * @param $pass
     * @return bool|user
     */
    public function getOneByDetails($user, $pass)
    {
        $query = "SELECT id,username,cash password FROM users
                          WHERE username = ? AND password = ? ";

        $this->db->query($query, [htmlspecialchars($user), md5($pass)]);
        $result = $this->db->row();

        if (empty($result)) return false;

        return $this->getOne($result['id']);
    }


    public function getOne($id)
    {
        $query = "SELECT id,username, password,cash
                  FROM users WHERE id = ?";

        $this->db->query($query, [$id]);
        $result = $this->db->row();

        if (empty($result)) return false;

        $user = new user
        (
            $result['id'],
            $result['username'],
            $result['password'],
            $result['cash']
        );

        $this->db->query("SELECT id, name,cart_money ,user_id
        FROM categories WHERE user_id = ?", [$id]);
        $categoriesResult = $this->db->fetchAll();
        $categories = [];
        foreach ($categoriesResult as $categoryResult) {
            $categories[] = new Category(
                $categoryResult['id'],
                $categoryResult['name'],
                $categoryResult['cart_money'],
                $user

            );
        }
//New------------------------------------------------
        $this->db->query("SELECT id, user_id, category_id, product_id, level_id
        FROM user_products WHERE user_id = ?", [$id]);
        $userProductsResult = $this->db->fetchAll();
        $userProductsCollection = [];
        foreach ($userProductsResult as $userProductResult) {
            $this->db->query("SELECT id, name ,price FROM products WHERE id = ?",
                [$userProductResult['product_id']]);
            $productResult = $this->db->row();
            $product = new Product($productResult['id'],
                $productResult['name'],
                $productResult['price']);
            $productLevelsCollection = [];
            $this->db->query("SELECT product_id, level_id, cash_consume,
quantity_consume, cash_income,quantity_income
FROM product_level WHERE product_id = ? AND level_id = ?",
                [$product->getId(), $userProductResult['level_id']]);
            $productLevelsResult = $this->db->fetchAll();
            $category = current(array_filter($categories, function(category $u) use ($userProductResult) {
                return $u->getId() == $userProductResult['category_id'];
            }));
            foreach ($productLevelsResult as $productLevelResult) {
                $productLevel = new ProductLevel(
                    $product,
                    $productLevelResult['level_id'],
                    $productLevelResult['cash_consume'],
                    $productLevelResult['quantity_consume'],
                    $productLevelResult['cash_income'],
                    $productLevelResult['quantity_income']
                );
                $productLevelsCollection[] = $productLevel;
                $userProductsCollection[] = new userProduct(
                    $user,
                    $product,
                    $productLevel,
                    $category
                );
            }
        }

// END--
        $user->setCategories($categories);
        $user->setProducts($userProductsCollection);


        return $user;
    }


    /**
     * @return user[]
     */
    public function getAll()
    {
        $query = "SELECT id, username,password,cash FROM users ";

        $this->db->query($query);
        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row) {
            $collection[] = new User(
                $row['id'],
                $row['username'],
                $row['password'],
                $row['cash']

            );
        }
        return $collection;

    }


    public function save(user $user)
    {
        $query = "INSERT INTO users (username,password) VALUES(?,?)";
        $params =[$user->getUsername(),$user->getPassword()];



        if($user->getId()){
            $query = "UPDATE users SET username = ?, password = ?  WHERE id = ?";
            $params[]  = $user->getId();

        }


        $this->db->query($query, $params);
        return $this->db->rows() > 0;
    }


    public function delete(user $user)
    {

        $query = "DELETE FROM users WHERE id = 13; ";
        $this->db->query($query);
        return $this->db->rows() > 0;

    }


}
