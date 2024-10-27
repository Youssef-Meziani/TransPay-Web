<?php
session_start();
if (isset($_POST["password"]) && !empty($_POST["password"])) {

    $password=md5($_POST["password"]);

    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        
        $email=$_POST["email"];
        
        require_once("../DataBase/db.php");
        
        $q=$con->prepare("update clnt_info_tbl set password=:password where email=:email");
        $q->execute(array(":password"=>$password, ":email"=>$email));
        echo "done";
    }else{
        if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
            if (isset($_POST["current_password"]) && !empty($_POST["current_password"])) {
                $current_password=md5($_POST["current_password"]);
                require_once("../DataBase/db.php");
                
                $stmt=$con->prepare("select password from clnt_info_tbl where idClt=:id");
                $stmt->execute(array(":id"=>$_SESSION["user"]));
                $data=$stmt->fetch(PDO::FETCH_ASSOC);
                
                if($data["password"]===$current_password){
                    $q=$con->prepare("update clnt_info_tbl set password=:password where idClt=:id");
                    $q->execute(array(":password"=>$password, ":id"=>$_SESSION["user"]));
                    echo "done";
                }else{
                    echo "wrong";
                }

            }
        }else{
            header("Location:login.php");
        }
    }
}