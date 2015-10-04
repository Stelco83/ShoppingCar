<?php
namespace shoppingCart\repositories;

use shoppingCart\Db;
use shoppingCart\models\Category;
use shoppingCart\models\products;
use shoppingCart\Models\user;

class CategoryRepository
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
     * @param $id
     * @return bool|Category
     */

    public function getOne($id)
    {
        $query = "SELECT id, name, cart_money ,user_id
        FROM categories WHERE id = ?";

        $this->db->query($query);
        $result = $this->db->row();

        if (empty($result)) return false;

        $user = UserRepository::create()->getOne($result['user_id']);

        $category = new Category(
            $result['id'],
            $result['name'],
            $result['cart_money'],
            $user
        );

        return $category;
    }


    /**
     * @return Category[]
     */

   public function getAll()
   {
       $query = "SELECT id, name,cart_money, user_id
        FROM categories ";

       $this->db->query($query);
       $result = $this->db->fetchAll();

       $collection = [];

       foreach ($result as $row) {

           $user = UserRepository::create()->getOne($row['user_id']);

           $collection[] = new Category(
               $row['id'],
               $row['name'],
               $row['cart_money'],
               $user
           );
       }

       return $collection;
   }


    public function save(Category $category)
    {
        $query = "INSERT INTO categories (name,user_id) VALUES(?,?)";
        $params =[$category->getName(),$category->getUser()->getId()];



        if($category->getId()){
            $query = "UPDATE categories SET name = ?, user_id = ?  WHERE id = ?";
            $params[]  = $category->getId();

        }


        $this->db->query($query, $params);
        return $this->db->rows() > 0;
    }




}
