<?php
namespace justprint\model;
class Review
{
    //grt all products
    public function getProducts($dbcon){
        $query = "SELECT *  FROM products";
        $pdostm = $dbcon->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    //get products by id
    public function getReviewById($id, $dbcon){
        $sql = "SELECT products.name as name, reviews.id, reviews.rate,reviews.nickname,reviews.title,reviews.review FROM reviews, products where products.id = reviews.product_id AND reviews.id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $c = $pst->fetch(\PDO::FETCH_OBJ);
        return $c;
    }
    // get all review function
    public function getAllReviews($dbcon)
    {
        $sql = "Select  * FROM reviews";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $reviews = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $reviews;
    }
    //add a review function
    public function addReview($name,$user,$rate,$nickname,$title,$review,$status,$dbcon){
        $sql="INSERT INTO reviews (product_id,user_id,rate,nickname,title,review,status) VALUE (:name,:user_id,:rate, :nickname, :title, :review,:status)";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':name',$name);
        $pdostm->bindParam(':user_id',$user);
        $pdostm->bindParam(':rate',$rate);
        $pdostm->bindParam(':nickname', $nickname);
        $pdostm->bindParam(':title',$title);
        $pdostm->bindParam(':review',$review);
        $pdostm->bindParam(':status',$status);
        $count = $pdostm->execute();
        return $count;
    }
    //delete review function
    public function deleteReview($id,$dbcon){
        $sql = "DELETE FROM reviews where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $count = $pdostm->execute();
        return $count;
    }
    //update review function
    public function updateReview($id, $name,$rate, $nickname, $title, $review, $dbcon){
        $sql = "UPDATE reviews SET product_id=:name,rate= :rate, nickname = :nickname, title = :title, review = :review WHERE id= :id";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':name',$name);
        $pdostm->bindParam(':rate',$rate);
        $pdostm->bindParam(':nickname', $nickname);
        $pdostm->bindParam(':title',$title);
        $pdostm->bindParam(':review',$review);
        $pdostm->bindParam(':id',$id);
        $count = $pdostm->execute();
        return $count;
    }
    //get review function
    /*    public function getReviewByID($id,$dbcon){
            $sql = "SELECT * FROM reviews where id = :id";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->bindParam(':id', $id);
            $pdostm->execute();
            return  $pdostm->fetch(\PDO::FETCH_OBJ);
        }*/
    public function approveReview($id,$status,$dbcon){
        $sql = "UPDATE reviews SET  status = :status WHERE id= :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->bindParam(':status',$status);
        $count = $pdostm->execute();
        return $count;
    }
}