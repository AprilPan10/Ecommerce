<?php
namespace justprint\model;
class Image
{
    //get products
    public function getProducts($dbcon){
        $query = "SELECT *  FROM products";
        $pdostm = $dbcon->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    //get products by id
    public function getImageById($id, $dbcon){
        $sql = "SELECT products.name as name, images.id, images.filename FROM products, images where products.id = images.product_id AND images.id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $c = $pst->fetch(\PDO::FETCH_OBJ);
        return $c;
    }
    //get image function
    public function getAllImages($dbcon)
    {
        $sql = "SELECT * FROM  images";
        //$sql = "SELECT products.name as name, images.id, images.filename FROM products, images where products.id = images.product_id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $images = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $images;
    }
    //add image function
    public function addImage($filename,$name,$dbcon){
        $sql="INSERT INTO images (product_id,filename) VALUE (:name,:filename)";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':name',$name);
        $pdostm->bindParam(':filename',$filename);
        $count = $pdostm->execute();
        return $count;
    }
    //delete image function
    public function deleteImage($id,$dbcon){
        $sql = "DELETE FROM images where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $count = $pdostm->execute();
        return $count;
    }
    //update image function
    public function updateImage($id,$name,$filename,$dbcon){
        $sql = "UPDATE images SET product_id=:name, filename= :filename WHERE id= :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':name',$name);
        $pdostm->bindParam(':filename',$filename);
        $pdostm->bindParam(':id',$id);
        $count = $pdostm->execute();
        return $count;
    }
    //get image function
    /*    public function getImageByID($id,$dbcon){
            $sql = "SELECT * FROM images where id = :id";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->bindParam(':id', $id);
            $pdostm->execute();
            return  $pdostm->fetch(\PDO::FETCH_OBJ);
        }*/
    public function getImagesByID($product_id,$dbcon){
        $sql = "SELECT * FROM images where product_id= :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $product_id);
        $pdostm->execute();
        return  $pdostm->fetch(\PDO::FETCH_OBJ);
    }
}