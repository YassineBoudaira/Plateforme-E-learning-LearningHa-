<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
$id= $_GET['id'];
$reqa = $bd->prepare('select * from categories where id=:id');
$reqa->execute(['id' => $id]);
$dataa = $reqa->fetch();

if(isset($_POST['submit'])){
  
  $nom = $_POST['nom'];


  $titre = $_POST['titre'];

  $description = $_POST['description'];

    $req = $bd->prepare("UPDATE categories SET nom=?, titre=?, description=? WHERE  id=?");
//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();

    $req->execute([$nom,$titre, $description, $id]);
    header('location: /learningha/categorie/index.php?msg=updated');

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
            <h3>Modifier une Categorie</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group" >
                            <label for="nom">nom</label>
                            <input value="<?= $dataa['nom'] ?>" type="text" name="nom" id="nom" class="form-control" placeholder=""
                            aria-describedby="nom">
                        </div>
                        <div class="form-group" >

                                <label for="titre">titre</label>
                            <input value="<?= $dataa['titre'] ?>" type="text" name="titre" id="titre" class="form-control" placeholder=""
                                aria-describedby="titre">
                        </div>

                        <div class="form-group ">
                            <label for="description">Description</label>
                            <textarea value="<?= $dataa['description']?>" type="text" name="description" id="description" class="form-control" placeholder=""
                                aria-describedby="description" rows="3" ><?= $dataa['description']?></textarea>
                        </div>



                     
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/Categorie/index.php">Annuler</a></button>
                        <button name="submit" class="btn btn-outline-warning"><a href="/learningha/categorie/index.php">Ajouter une Categorie</a></button>
                         <button name="submit" class="btn btn-outline-warning">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>
<?php include '../includes/footer.php'; ?>