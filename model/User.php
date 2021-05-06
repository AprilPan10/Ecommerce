<?php
namespace justprint\model;
class User
{
    //get all users function
    public function getAllUsers($dbcon)
    {
        $sql = "Select  * FROM users";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $users = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $users;
    }
    //add user profile function
    public function addUser($first_name,$last_name,$role,$email,$username,$password,$address,$bio, $image,$dbcon){
        $sql="INSERT INTO users (first_name,last_name,role,email,username,password,address,bio,image) VALUE (:first_name,:last_name,:role,:email,:username,:password,:address,:bio,:image)";
        $pdostm = $dbcon->prepare($sql);
        $databasepass = password_hash($password, PASSWORD_DEFAULT);
        $image = $_FILES['image']['name'];
        $pdostm->bindParam(':first_name',$first_name);
        $pdostm->bindParam(':last_name',$last_name);
        $pdostm->bindParam(':role',$role);
        $pdostm->bindParam(':email',$email);
        $pdostm->bindParam(':username',$username);
        $pdostm->bindParam(':password', $databasepass);
        $pdostm->bindParam(':address',$address);
        $pdostm->bindParam(':bio',$bio);
        $pdostm->bindParam(':image',$image);
        $count = $pdostm->execute();
        return $count;
    }
    //delete user profile function
    public function deleteUser($id,$dbcon){
        $sql = "DELETE FROM users where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $count = $pdostm->execute();
        return $count;
    }
    //update user profile
    public function updateUser($id,$first_name,$last_name,$email,$username,$password,$address,$bio,$image,$dbcon){
        $sql = "UPDATE users SET first_name= :first_name, last_name= :last_name, email=:email,username=:username,password=:password,address=:address,bio=:bio, image=:image WHERE id= :id";
        $databasepass = password_hash($password, PASSWORD_DEFAULT);
        $image = $_FILES['image']['name'];
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':first_name',$first_name);
        $pdostm->bindParam(':last_name',$last_name);
        $pdostm->bindParam(':email',$email);
        $pdostm->bindParam(':username',$username);
        $pdostm->bindParam(':password',$databasepass);
        $pdostm->bindParam(':address',$address);
        $pdostm->bindParam(':bio',$bio);
        $pdostm->bindParam(':image',$image);
        $pdostm->bindParam(':id',$id);
        $count = $pdostm->execute();
        return $count;
    }
    //get one user function
    public function getUserByID($id,$dbcon){
        $sql = "SELECT * FROM users where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        return  $pdostm->fetch(\PDO::FETCH_OBJ);
    }
}
