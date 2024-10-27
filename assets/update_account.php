<?php
session_start();
if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
    exit("denied");
}

if (!isset($_POST["nom"]) || !isset($_POST["prenom"]) || !isset($_POST["sexe"]) || !isset($_POST["date_naiss"]) || !isset($_POST["tel"]) || !isset($_POST["adresse"])) {
    exit("error");
}

$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$sexe=$_POST["sexe"];
$date_naiss = $_POST["date_naiss"];
$adresse=$_POST["adresse"];
$date_naiss = DateTime::createFromFormat('d/m/Y', $date_naiss);


if (empty($nom) || empty($prenom) || empty($sexe) || empty($date_naiss) || $date_naiss === false || empty($adresse)) {
    exit("error");
}

$tel=$_POST["tel"];
if (!empty($tel) && !preg_match("/(\+212|0(6|7|5))\d{8}/", $tel)) {
    exit("error");
}

$date_naiss = $date_naiss->format('Y-m-d');

require_once("../DataBase/db.php");

$q=$con->prepare("call update_account (:nom, :prenom, :sexe, :date_naiss, :tel, :adresse, :id)");
$q->execute(array(":nom"=>$nom, ":prenom"=>$prenom, ":sexe"=>$sexe, ":date_naiss"=>$date_naiss, ":tel"=>$tel, ":adresse"=>$adresse, ":id"=>$_SESSION["user"]));