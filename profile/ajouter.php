<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
<?php
if(isset($_POST['submit'])){

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $sexe = $_POST['sexe'];
  $role = $_POST['role'];
  $login =$_POST['login'];
  $password = $_POST['password'];
  $date_registration =date('Y-m-d', strtotime($_POST['date_registration']));
  $ville_id = $_POST['ville_id'];


  $req = $bd->prepare("insert into profiles(nom, prenom, email, age , sexe, role ,  login, password ,date_registration , ville_id) values(?,?,?,?,?,?,?,?,?,?)");
  $req->execute([$nom, $prenom ,$email ,$age , $sexe, $role, $login, $password, $date_registration, $ville_id]);
//   echo '<pre>';
//   var_dump($req);
//   echo '</pre>';
//   die();
    
    header('location: /learningha/profile/index.php?msg=added');
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
            <h3>Ajouter un profile</h3>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nom">nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="" 
                            aria-describedby="nom">
                        </div>
                        <div class="form-group">
                            <label for="date_registration">date_registration</label>
                            <input  type="date" name="date_registration" id="date_registration" class="form-control" placeholder=""
                                aria-describedby="date_registration"> 
                        </div>
                        <div class="form-group ">
                            <label for="prenom">prenom</label>
                            <input type="text" name="prenom"  class="form-control" placeholder=""
                                aria-describedby="prenom">

                        </div>
                        <div class="form-group ">
                            <label for="age">age</label>
                            <input type="number" name="age"  class="form-control" placeholder=""
                                aria-describedby="age">
                        </div>

                        <div class="form-group">
                            <label for="sexe">sexe</label>
                                <select id="sexe" name="sexe" class="form-control">                           
                                    <option  selected>Selectionez le Seexe : </option>
                                    <option value="admin">Homme</option>
                                    <option value="admin">Femme</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder=""
                                aria-describedby="email">
                        </div>

                        <div class="form-group">
                            <label for="role">role</label>
                                <select id="role" name="role" class="form-control">                           
                                    <option  selected> Selectionez le Role : </option>
                                    <option value="admin">admin</option>
                                    <option value="admin">formateur</option>
                                    <option value="admin">etudient</option>

                                </select>
                        </div>


                        <div class="form-group">
                            <label for="ville_id">Ville</label>

                                <select id="ville_id" name="ville_id" class="form-control">
                                <?php 
                                    $req2 =  $bd->query("select * from villes");
                                    while($data2 = $req2->fetch()):
                                ?>
                                    <option value="<?= $data2['id'] ?>"><?= $data2['nom'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" name="login" id="login" class="form-control" placeholder=""
                                aria-describedby="login">
                        </div>

                        <div class="form-group">
                            <label for="password">PassWord</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder=""
                                aria-describedby="password">
                        </div>

                        <div class="form-group">
                        <button name="" class="btn btn-outline-warning"><a href="/learningha/profile/index.php">Annuler</a></button><button name="submit" class="btn btn-outline-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>
<?php include '../includes/footer.php'; ?>