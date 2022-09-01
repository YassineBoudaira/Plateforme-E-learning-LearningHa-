<?php include '../includes/session.php'; ?>
<?php
$id= $_GET['id'];
include '../includes/connexion.php';
$req = $bd->prepare('delete from tests where id=?');
$req->execute([$id]);
header('location: /learningha/tests/index.php?msg=deleted');