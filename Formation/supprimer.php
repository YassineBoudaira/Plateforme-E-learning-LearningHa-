<?php include '../includes/session.php'; ?>
<?php
$id= $_GET['id'];
include '../includes/connexion.php';
$req = $bd->prepare('delete from formation where id=?');
$req->execute([$id]);
header('location: /learningha/formation/index.php?msg=deleted');