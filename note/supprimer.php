<?php include '../includes/session.php'; ?>
<?php
$id= $_GET['id'];
include '../includes/connexion.php';
$req = $bd->prepare('delete from notes where id=?');
$req->execute([$id]);
header('location: /learningha/note/index.php?msg=deleted');