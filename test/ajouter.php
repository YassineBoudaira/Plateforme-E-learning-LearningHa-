<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
if(isset($_POST['submit'])){
  
  $titre = $_POST['titre'];
  $description = $_POST['description'];

  $doc  = basename($_FILES['doc']['name']);
  $path= '../upload/docs/'.$doc;
  $file= $_FILES['doc']['tmp_name'];
  move_uploaded_file($file,$path);

  $image = basename($_FILES['image']['name']);
  $path= '../upload/imgs'.$image;
  $file= $_FILES['image']['tmp_name'];
  move_uploaded_file($file,$path);
  

  $date =date('Y-m-d', strtotime($_POST['date']));

  $req = $bd->prepare("insert into tests (titre, description, document, image, date) values(?,?,?,?,?)");
  $req->execute([$titre, $description, $doc,$image, $date]);
//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();
    
    header('location: /learningha/test/index.php?msg=added');
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
            <h3>Ajouter un test</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">



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
                        <div class="form-group"  >
                            <label for="doc">Document</label>
                            <input type="file" name="doc" id="doc" class="form-control" placeholder=""
                                aria-describedby="doc">
                        </div>
                        <div class="form-group"  >
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" placeholder=""
                                aria-describedby="image">
                        </div>
                      
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" placeholder=""
                                aria-describedby="date">

                        </div>
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/test/index.php">Annuler</a></button><button name="submit" class="btn btn-outline-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>
<?php include '../includes/footer.php'; ?>