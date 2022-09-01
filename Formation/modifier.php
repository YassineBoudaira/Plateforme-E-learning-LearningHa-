<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
$id= $_GET['id'];
$reqa = $bd->prepare('select * from formation where id=:id');
$reqa->execute(['id' => $id]);
$dataa = $reqa->fetch();

if(isset($_POST['submit'])){

  $nom = $_POST['nom'];
  $titre = $_POST['titre'];
  $description = $_POST['description'];
  $date_a =date('Y-m-d', strtotime($_POST['date_debut']));
  $date_fin =date('Y-m-d', strtotime($_POST['date_fin']));
  $profile_id = $_POST['profile_id'];
  $categorie_id = $_POST['categorie_id'];
  $cours_id = $_POST['cours_id'];

    $req = $bd->prepare("UPDATE formation SET nom,? titre=?, description=?, date_debut=?, date_fin=?,cours_id=?, categorie_id=?, profile_id=? WHERE  id=?");
//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();

    $req->execute([$nom, $titre,$description, $date_debut, $date_fin, $cours_id ,$categorie_id,$profile_id, $id]);
    header('location: /learningha/formation/index.php?msg=updated');

}

?>
<?php include '../includes/header.php'; ?>
<header>
  <!-- Start menu -->
  <?php include '../includes/menu.php'; ?>
  <!-- End menu -->
</header>
<section>
  <!-- Start Sidebar -->
  <?php include '../includes/sidebar.php'; ?>
  <!-- End Sidebar -->
  <div class="mainpanel">
    <!--<div class="pageheader">
      <h2><i class="fa fa-home"></i> Dashboard</h2>
    </div>-->
    <div class="contentpanel">
      <div class="row">
            <h3>Modifier une formation</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nom">nom</label>
                            <input value="<?= $dataa['nom'] ?>" type="text" name="nom" id="nom" class="form-control" placeholder="" 
                            aria-describedby="nom">
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input value="<?= $dataa['titre'] ?>" type="text" name="titre" id="titre" class="form-control" placeholder="" 
                            aria-describedby="titre">
                        </div>
                        <div class="form-group ">
                            <label for="description">Description</label>
                            <!-- <input type="text" name="description"   placeholder=""
                                aria-describedby="description"> -->
                                <textarea id="description" name="description" aria-describedby="description" class="form-control" rows="3" > <?= $dataa['description'] ?></textarea>
                        </div>


                        <div class="form-group">
                            <label for="date_debut">date debut</label>
                            <input   value="<?= $dataa['date_debut'] ?>" type="date" name="date_debut" id="date_debut" class="form-control" placeholder=""
                                aria-describedby="date_debut"> 
                        </div>
                        <div class="form-group">
                            <label for="date_fin">date fin</label>
                            <input   value="<?= $dataa['date_fin'] ?>" type="date" name="date_fin" id="date_fin" class="form-control" placeholder=""
                                aria-describedby="date_fin"> 
                        </div>

                         <div class="form-group">
                            <label for="profile_id">Profile</label>
                            <!-- <input type="file"  value=""  name="profile_id" id="profile_id" class="form-control" placeholder=""
                                aria-describedby="test_id"> -->
                                    <select id="profile_id" name="profile_id" class="form-control">
                                    <?php
                                    $reqv=$bd->query("SELECT * from profiles");
                                    while($resv=$reqv->fetch()):

                                    ?>

                                   <option <?= ($dataa['profile_id']==$resv['id'])?'selected' :'' ?> value="<?= $resv['id'] ?>"><?=$resv['nom'].'  '.$resv['prenom'] ?></option> 
 
                                   <?php endwhile; ?>
                                </select>
                        </div> 
                        <div class="form-group">
                            <label for="Categorie_id">Categorie</label>
                            <!-- <input type="file"  value=""  name="Categorie_id" id="Categorie_id" class="form-control" placeholder=""
                                aria-describedby="Categorie_id"> -->
                                  <select id="Categorie_id" name="Categorie_id" class="form-control">
                                    <?php
                                    $reqv=$bd->query("SELECT * from Categories");
                                    while($resv=$reqv->fetch()):

                                    ?>

                                   <option <?= ($dataa['categorie_id']==$resv['id'])?'selected' :'' ?> value="<?= $resv['id'] ?>"><?=$resv['titre'] ?></option> 
 
                                   <?php endwhile; ?>
                                </select>
                        </div>
                         <div class="form-group">
                            <label for="cours_id">cours</label>
                            <!-- <input type="file"  value=""  name="cours_id" id="cours_id" class="form-control" placeholder=""
                                aria-describedby="test_id"> -->
                                    <select id="cours_id" name="cours_id" class="form-control">
                                    <?php
                                    $reqv=$bd->query("SELECT * from courses");
                                    while($resv=$reqv->fetch()):

                                    ?>

                                   <option <?= ($dataa['cours_id']==$resv['id'])?'selected' :'' ?> value="<?= $resv['id'] ?>"><?=$resv['titre'] ?></option> 
 
                                   <?php endwhile; ?>
                                </select>
                        </div> 
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/formation/index.php">Annuler</a></button><button name="submit" class="btn btn-outline-warning">Modifier</button>
                       </div>   
                    </form> 


</section>
<?php include '../includes/footer.php'; ?>