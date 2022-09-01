<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
if(isset($_POST['submit'])){
  $titre = $_POST['titre'];
//   $date_a = $_POST['date_a'];
  $date_a =date('Y-m-d', strtotime($_POST['date_a']));
  $description = $_POST['description'];

  $image = basename($_FILES['image']['name']);
  $path= '../upload/'.$image;
  $file= $_FILES['image']['tmp_name'];
  move_uploaded_file($file,$path);
  
  $telephone = $_POST['telephone'];
  $email = $_POST['email'];
  $entreprise = $_POST['entreprise'];
  $entreprise_detaile = $_POST['entreprise_detaile'];
  
  $siteweb = $_POST['siteweb'];
  $date_fin =date('Y-m-d', strtotime($_POST['date_fin']));
  $profile_id =$_POST['profile_id'];
  $contrat_id = $_POST['contrat_id'];
  $ville_id = $_POST['ville_id'];
  $domaine_id = $_POST['domaine_id'];
  $req = $bd->prepare("insert into annonces(titre, date_a, description, image, telephone, email, entreprise,entreprise_detaile, siteweb, date_fin, profile_id, contrat_id, ville_id, domaine_id) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $req->execute([$titre, $date_a, $description, $image, $telephone, $email, $entreprise, $entreprise_detaile, $siteweb, $date_fin, $profile_id, $contrat_id, $ville_id, $domaine_id]);
//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();
    
    header('location: /emploiDB/annonce/index.php?msg=added');
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
            <h3>Ajouter un cours</h3>
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


                        <div class="form-group">
                            <label for="date">date debut</label>
                            <input  type="date" name="date" id="date" class="form-control" placeholder=""
                                aria-describedby="date"> 
                        </div>
                        <div class="form-group">
                            <label for="date">date fin</label>
                            <input  type="date" name="date" id="date" class="form-control" placeholder=""
                                aria-describedby="date"> 
                        </div>


                         <div class="form-group">
                            <label for="cours_id">cours</label>
                            <!-- <input type="file"  value=""  name="cours_id" id="cours_id" class="form-control" placeholder=""
                                aria-describedby="test_id"> -->
                                    <select id="cours_id" name="cours_id" class="form-control">
                                    <?php
                                    $reqv=$bd->query("SELECT * from cours");
                                    while($resv=$reqv->fetch()):

                                    ?>

                                   <option value="<?= $resv['id'] ?>"><?=$resv['titre'] ?></option> 
 
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

                                   <option value="<?= $resv['id'] ?>"><?=$resv['titre'] ?></option> 
 
                                   <?php endwhile; ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="Categorie_id">Profile</label>
                            <!-- <input type="file"  value=""  name="Categorie_id" id="Categorie_id" class="form-control" placeholder=""
                                aria-describedby="Categorie_id"> -->
                                  <select id="Categorie_id" name="Categorie_id" class="form-control">
                                    <?php
                                    $reqv=$bd->query("SELECT * from profiles");
                                    while($resv=$reqv->fetch()):

                                    ?>

                                   <option value="<?= $resv['id'] ?>"><?=$resv['nom'].' '.$resv['prenom'] ?></option> 
 
                                   <?php endwhile; ?>
                                </select>
                        </div>
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/formation/index.php">Annuler</a></button><button name="submit" class="btn btn-outline-primary">Ajouter</button>
                       </div>
                    </form> 
</section>
<?php include '../includes/footer.php'; ?>