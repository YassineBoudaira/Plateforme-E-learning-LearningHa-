<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
$id= $_GET['id'];
$reqa = $bd->prepare('select * from tests where id=:id');
$reqa->execute(['id' => $id]);
$dataa = $reqa->fetch();

if(isset($_POST['submit'])){

  $nom = $_POST['nom'];
  $titre = $_POST['titre'];
  $description = $_POST['description'];

  $doc  = basename($_FILES['document']['name']);
  $path= '../upload/docs'.$doc;
  $file= $_FILES['document']['tmp_name'];
  move_uploaded_file($file,$path);

  $image = basename($_FILES['image']['name']);
  $path= '../upload/imgs'.$image;
  $file= $_FILES['image']['tmp_name'];
  move_uploaded_file($file,$path);
  $date =date('Y-m-d', strtotime($_POST['date']));

    $req = $bd->prepare("UPDATE tests SET  titre=?,document=?, image=?,   description=? ,date=? WHERE  id=?");
//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();

    $req->execute([$nom, $titre, $description,$doc,$image, $date, $id]);
    header('location: /learningha/test/index.php?msg=updated');

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
            <h3>Modifier une test</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input value="<?= $dataa['titre'] ?>" type="text" name="titre" id="titre" class="form-control" placeholder="" 
                            aria-describedby="titre">
                        </div>

                        <div class="form-group ">
                            <label for="description">Description</label>
                            <!-- <input type="text" name="description"   placeholder=""
                                aria-describedby="description"> -->

                                <textarea id="description" name="description" aria-describedby="description" class="form-control" rows="3" ><?= $dataa['description'] ?></textarea>

                       </div>
                        <div class="form-group"  >
                            <label for="doc">Document</label>
                            <input type="file"  value="<?= $dataa['document'] ?>" name="doc" id="doc" class="form-control" placeholder=""
                                aria-describedby="doc"></div>
                        </div>
                        <div class="form-group"  >
                            <label for="image">Image</label>
                            <input type="file"  value="<?= $dataa['image'] ?>" name="image" id="image" class="form-control" placeholder=""
                                aria-describedby="image">
                              </div>
                      
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date"  value="<?= $dataa['date'] ?>" name="date" id="date" class="form-control" placeholder=""
                                aria-describedby="date">

                        </div>
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/test/index.php">Annuler</a></button> <button name="submit" class="btn btn-outline-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>

<?php include '../includes/footer.php'; ?>