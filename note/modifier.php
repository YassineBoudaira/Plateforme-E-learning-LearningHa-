<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
$id= $_GET['id'];
$reqa = $bd->prepare('select * from notes where id=:id');
$reqa->execute(['id' => $id]);
$dataa = $reqa->fetch();

if(isset($_POST['submit'])){


  $titre = $_POST['titre'];
  $description = $_POST['description'];
  $text = $_POST['text'];
  $date =date('Y-m-d', strtotime($_POST['date_note']));
  $profile_id = $_POST['profile_id'];
  $cours_id = $_POST['cours_id'];


$req = $bd->prepare("UPDATE notes set title=?,description=?,text=?,date_note=?,profile_id=?,course_id=? WHERE id=?");
$req->execute([$titre, $description, $text, $date, $profile_id, $cours_id,$id]);
  // echo '<pre>';
  // var_dump($req);
  // echo '</pre>';
  // die();
  
  header('location: /learningha/note/index.php?msg=added');
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
            <h3>Modifier un cours</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

 
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input value="<?= $dataa['title'] ?>" type="text" name="titre" id="titre" class="form-control" placeholder="" 
                            aria-describedby="titre">
                        </div>
                        <div class="form-group ">
                            <label for="description">Description</label>
                            <!-- <input type="text" name="description"   placeholder=""
                                aria-describedby="description"> -->
                                <textarea id="description" name="description" aria-describedby="description" class="form-control" rows="3" ><?= $dataa['description'] ?></textarea>
                        </div>


                        <div class="form-group">
                            <label for="text">Text note</label>
                            <textarea  type="text" name="text" id="text" class="form-control" placeholder=""
                                aria-describedby="text"><?= $dataa['text'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date_note">date</label>
                            <input value="<?= $dataa['date_note'] ?>" type="date" name="date_note" id="date_note" class="form-control" placeholder=""
                                aria-describedby="date_note"> 
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

                                   <option <?= ($resv['id']==$dataa['id'])?'selected' :'' ?> value="<?= $resv['id'] ?>"><?=$resv['titre'] ?></option> 
 
                                   <?php endwhile; ?>
                                </select>
                        </div> 
                        <div class="form-group">

                        <div class="form-group">
                            <label for="profile_id">Profile</label>
                            <!-- <input type="file"  value=""  name="profile_id" id="profile_id" class="form-control" placeholder=""
                                aria-describedby="profile_id"> -->
                                  <select id="profile_id" name="profile_id" class="form-control">
                                    <?php
                                    $reqv=$bd->query("SELECT * from profiles");
                                    while($resv=$reqv->fetch()):

                                    ?>

                                   <option <?= ($resv['id']==$dataa['id'])?'selected' :'' ?> value="<?= $resv['id'] ?>"><?=$resv['nom'].' '.$resv['prenom'] ?></option> 
 
                                   <?php endwhile; ?>
                                </select>
                        </div>
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/note/index.php">Annuler</a></button><button name="submit" class="btn btn-outline-primary">Modifier</button>
                       </div>
                    </form> 
</section>

?>