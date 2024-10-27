<?php
if (isset($_POST["email"])) {
    $email=$_POST["email"];
    if (!empty($email)) {
        require_once("../DataBase/db.php");
        $stmt=$con->prepare("select email from news_info_tbl where email=:email");
        $stmt->execute(array(":email"=>$email));
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            echo "exist";
        }else{
            $stmt=$con->prepare("insert into news_info_tbl values (:email)");
            $stmt->execute(array(":email"=>$email));
            echo "done";
        }
    }
}