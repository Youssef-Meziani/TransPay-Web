<?php
$email=$_POST["email"];

require_once("../DataBase/db.php");

$data=$con->query("select count(idClt) from clnt_info_tbl where email='$email'")->fetch(PDO::FETCH_NUM);

if ($data[0]!=0) {
    echo "exist";
}