<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Restaurant
{
    private $conn, $statement;

    public function getRestaurants()
    {
        $this->conn = Database::connect();
        $sql = "select * from restaurant";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getRestaurantsByMenu($menu_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT r.* 
                FROM restaurant AS r 
                JOIN restaurant_menu AS rm ON r.id = rm.restaurant_id
                WHERE rm.menu_id = :menu_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':menu_id', $menu_id, PDO::PARAM_INT);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function searchRestaurantsByKeyword($keyword)
    {
        $this->conn = Database::connect();
        $sql = "SELECT DISTINCT restaurant.*, restaurant.name AS restaurant_name, restaurant.open_time as open_time
                FROM restaurant
                LEFT JOIN item ON restaurant.id = item.restaurant_id
                LEFT JOIN menu ON item.menu_id = menu.id
                WHERE restaurant.name LIKE :keyword 
                   OR menu.name LIKE :keyword 
                   OR item.name LIKE :keyword";
        $this->statement = $this->conn->prepare($sql);
        $like_keyword = '%' . $keyword . '%';
        $this->statement->bindParam(':keyword', $like_keyword, PDO::PARAM_STR);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } else {
            return [];
        }
    }
}

?>
