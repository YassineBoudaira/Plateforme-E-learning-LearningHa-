<?php include '../includes/session.php'; ?>
<?php
$id= $_GET['id'];
include '../includes/connexion.php';
$req = $bd->prepare('delete from villes where id=?');
$req->execute([$id]);
header('location: /learningha/ville/index.php?msg=deleted');