<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
$id= $_GET['id'];
$reqa = $bd->prepare('select * from courses where id=:id');
$reqb = $bd->prepare('select * from content  where cours_id=:id');

$reqa->execute(['id' => $id]);
$reqb->execute(['id' => $id]);
$dataa = $reqa->fetch();
$datab = $reqb->fetch();



if(isset($_POST['submit'])){

  $nom = $_POST['nom'];
  $titre = $_POST['titre'];
  $description = $_POST['description'];
  $date =date('Y-m-d', strtotime($_POST['date_a']));

  $doc = basename($_FILES['doc']['name']);
  $path= '../upload/docs/'.$doc;
  $file= $_FILES['doc']['tmp_name'];
  move_uploaded_file($file,$path);

  $image = basename($_FILES['image']['name']);
  $path= '../upload/imgs/'.$image;
  $file= $_FILES['image']['tmp_name'];
  move_uploaded_file($file,$path);

  $video = basename($_FILES['video']['name']);
  $path= '../upload/imgs/'.$video;
  $file= $_FILES['video']['tmp_name'];
  move_uploaded_file($file,$path);

  // $vedio = $_POST['vedio'];
  $test=$_POST['test_id'];
  $Categorie = $_POST['Categorie_id'];

    $req = $bd->prepare("UPDATE courses SET nom=?, titre=?, description=?, niveau=?, date=?, test_id=? ,categorie_id=?   WHERE  id=?");
    $req->execute([$nom, $titre, $description, $niveau, $date, $test_id, $categorie_id, $id]);


//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();

    $reqq = $bd->prepare("UPDATE contents SET image=?, vedio=?, document=?, cours_id=?  WHERE  id=?");
    $reqq->execute([$image, $vedio, $document,$cours_id, $id]);

    header('location: /learningha/course/index.php?msg=updated');

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
                            <label for="role">Niveau</label>
                                <select id="role" name="role" class="form-control">                           
                                    <option disabled  selected> Choisisier votre Niveau : </option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Avencé">Avencé</option>
                            
                                </select>
                        </div>



                        

                        <div class="form-group">
                            <label for="date">date</label>
                            <input  type="date" name="date" id="date" class="form-control" placeholder=""
                                aria-describedby="date"> 
                        </div>

                        <div class="form-group"  >
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" placeholder=""
                                aria-describedby="image">
                        </div>
                      
                        <div class="form-group">
                            <label for="doc">document</label>
                            <input type="file"  value=""  name="doc" id="doc" class="form-control" placeholder=""
                                aria-describedby="doc">
                        </div>
                        
                        <div class="form-group">
                            <label for="video">videos</label>
                            <input type="file"  value=""  name="video" id="video" class="form-control" placeholder=""
                                aria-describedby="video">
                        </div>
                         <div class="form-group">
                            <label for="test_id">Test</label>
                            <!-- <input type="file"  value=""  name="test_id" id="test_id" class="form-control" placeholder=""
                                aria-describedby="test_id"> -->
                                    <select id="test_id" name="test_id" class="form-control">
                                    <?php
                                    $reqv=$bd->query("SELECT * from tests");
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

       
                        </div>
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/course/index.php">Annuler</a></button>
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/course/ajouter.php">Ajouter une annance</a></button> <button name="submit" class="btn btn-outline-warning">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>
<?php include '../includes/footer.php'; ?>