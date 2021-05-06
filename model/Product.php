<?php
namespace justprint\model;
class Product
{

    public function getProductById($id, $db)
    {
        $sql = "SELECT * FROM products where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function getAllProducts($dbcon)
    {
        $sql = "SELECT * FROM products";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $products = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $products;
    }

    public function addProduct($name, $type, $description, $price, $url, $db)
    {
        $sql = "INSERT INTO products (name, type, description, price,url) VALUES (:name, :type, :description, :price,:url) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':name', $name);
        $pst->bindParam(':type', $type);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':price', $price);
        $pst->bindParam(':url', $url);

        $count = $pst->execute();
        return $count;
    }

    public function deleteProduct($id, $db)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updateProduct($id, $name, $type, $description, $price, $url, $db)
    {
        $sql = "UPDATE products SET name = :name,type = :type, description = :description, price = :price, url = :url WHERE id = :id";
        $url = $_FILES['image']['name'];
        $pst = $db->prepare($sql);
        $pst->bindParam(':name', $name);
        $pst->bindParam(':type', $type);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':price', $price);
        $pst->bindParam(':url', $url);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();

        return $count;
    }

}