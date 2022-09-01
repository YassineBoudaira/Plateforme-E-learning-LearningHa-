<?php include '../includes/session.php'; ?>
<?php
$id= $_GET['id'];
include '../includes/connexion.php';


$reqcontent = $bd->prepare("delete from contents where cours_id=?");
$reqcontent ->execute([$id]);

$reqcours = $bd->prepare("delete from courses where id=?");
$reqcours->execute([$id]);






header('location: /learningha/course/index.php?msg=deleted');