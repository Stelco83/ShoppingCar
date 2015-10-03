<?php
namespace shoppingCart\repositories;

use shoppingCart\Db;
use shoppingCart\models\Category;
use shoppingCart\models\products;
use shoppingCart\Models\user;

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

        $this->db->query($query, [$user, md5($pass)]);
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

        $this->db->query("SELECT id, name, user_id
        FROM categories WHERE user_id = ?", [$id]);
        $categoriesResult = $this->db->fetchAll();
        $categories = [];
        foreach ($categoriesResult as $categoryResult) {
            $categories[] = new Category(
                $categoryResult['id'],
                $categoryResult['name'],
                $user
            );
        }
        $user->setCategories($categories);

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
