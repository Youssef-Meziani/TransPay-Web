<?php
session_start();

if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
    header("Location:../account.php");
}

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
    exit;
}

$email=$_POST["email"];
$password=$_POST["password"];

if (empty($email) || empty($password) || !preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $email)) {
    exit;
}

// hash the password if not hashed
if (!preg_match('/^[a-f0-9]{32}$/', $password)) {
    $password=md5($password);
}

require_once("../DataBase/db.php");

$q=$con->prepare("call login (:email, :password);");
$q->execute(array(":email"=>$email, ":password"=>$password));
$data=$q->fetch(PDO::FETCH_ASSOC);

if ($data) {
    $_SESSION['user'] = $data["idClt"];
    echo "exists";
}
$con=null;