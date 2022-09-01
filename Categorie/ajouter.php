<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
if(isset($_POST['submit'])){
  
  $nom = $_POST['nom'];


  $titre = $_POST['titre'];

  $description = $_POST['description'];

  $req = $bd->prepare("INSERT into categories (nom,titre, description ) values(?,?,?)");
  $req->execute([$nom, $titre, $description]);
//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();
    
    header('location: /learningha/categorie/index.php?msg=added');
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
            <h3>Ajouter une Categorie</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nom">nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" placeholder=""
                                aria-describedby="nom">
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control" placeholder="" 
                            aria-describedby="titre">
                        </div>

                        <div class="form-group ">
                            <label for="description">Description</label>
                            <!-- <input type="text" name="description"   placeholder=""
                                aria-describedby="description"> -->

                                <textarea id="description" name="description" aria-describedby="description" class="form-control" rows="3" ></textarea>


                        </div>

 
                       
                        </div>
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/Categorie/index.php">Annuler</a></button><button name="submit" class="btn btn-outline-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>
<?php include '../includes/footer.php'; ?>