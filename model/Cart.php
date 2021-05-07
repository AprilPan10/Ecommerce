<?php
namespace justprint\model;
class Cart{
    public function getAllOrders($dbcon)
    {
        $sql = "Select  * FROM orders";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $orders= $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $orders;
    }
    public function addOrder($product_id,$user_id, $name,$price,$dbcon){
        $sql="INSERT INTO orders (product_id, user_id,name,price) VALUE (:product_id, :user_id,:name, :price)";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':product_id',$product_id);
        $pdostm->bindParam(':user_id',$user_id);
        $pdostm->bindParam(':name',$name);
        $pdostm->bindParam(':price',$price);
        $count = $pdostm->execute();
        return $count;
    }
    //delete order
    public function deleteOrder($id,$dbcon){
        $sql = "DELETE FROM orders where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $count = $pdostm->execute();
        return $count;
    }
    public function getOrderByID($id,$dbcon){
        $sql = "SELECT * FROM orders,users where users.id = orders.user_id AND orders.id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        return  $pdostm->fetch(\PDO::FETCH_OBJ);
    }
    public function getNum($id,$dbcon){
        $sql = "SELECT count(orders.id) FROM users, orders where orders.id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        return  $pdostm->fetch(\PDO::FETCH_OBJ);
    }

}