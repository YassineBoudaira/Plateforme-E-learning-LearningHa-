<?php include '../includes/session.php'; ?>
<?php
$id= $_GET['id'];
include '../includes/connexion.php';
$req = $bd->prepare("delete from profiles where id=?");
$req->execute([$id]);
header('location: /learningha/profile/index.php?msg=deleted');