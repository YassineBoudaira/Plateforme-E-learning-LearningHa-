<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
$id= $_GET['id'];
$reqv = $bd->prepare('select * from villes where id=:id');
$reqv->execute(['id' => $id]);
$datav = $reqv->fetch();

if(isset($_POST['submit'])){
    $nom = $_POST['nom'];
    $req = $bd->prepare("UPDATE villes SET nom=? WHERE  id=?");
    $req->execute([$nom,$id]);
    header('location: /learningha/ville/index.php?msg=updated');
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
            <h3>Modifie une la ville</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" >
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input value="<?= $datav['nom'] ?>" type="text" name="nom" id="nom" class="form-control" placeholder=""
                                aria-describedby="nom">

                        </div> 
                       <div class="form-group">
                            <label for="villes">List des villes</label>
                            <select id="villes" name="villes" class="form-control">
                                <?php 
                                    $req3 =  $bd->query("select * from villes");
                                    while($data3 = $req3->fetch()):
                                ?>
                                    <option  value="<?= $data3['id'] ?>"><?= $data3['nom'] ?></option>
                                <?php endwhile; ?>
                            </select>

                        </div>
                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/ville/index.php">Annuler</a></button><button name="" class="btn btn-outline-warning"><a href="/learningha/ville/ajouter.php">Ajouter un ville</a></button> <button name="submit" class="btn btn-outline-warning">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>
<?php include '../includes/footer.php'; ?>