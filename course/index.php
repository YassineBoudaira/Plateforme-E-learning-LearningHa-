<?php include '../includes/session.php'; ?>
<?php include '../includes/connexion.php'; ?>
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
			<div class="col-md-12">
			<?php if(isset($_GET['msg']) && $_GET['msg']=='added'): ?>
                <div class="alert alert-success">Ajouter avec succes
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>
                <?php endif; ?>
                <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'): ?>
                <div class="alert alert-danger">Supprimer avec succes
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>
                <?php endif; ?>
                <?php if(isset($_GET['msg']) && $_GET['msg']=='updated'): ?>
                <div class="alert alert-warning">modifier avec succes
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>
                <?php endif; ?>

			</div>
		</div>
		<div class="row">
		<h3>Liste des courses</h3>
		<br />
		
		<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			var $table3 = jQuery("#table-3");
			
			var table3 = $table3.DataTable( {
				"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
			} );
			
			// Initalize Select Dropdown after DataTables is created
			$table3.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
				minimumResultsForSearch: -1
			});
			
			// Setup - add a text input to each footer cell
			$( '#table-3 tfoot th' ).each( function () {
				var title = $('#table-3 thead th').eq( $(this).index() ).text();
				$(this).html( '<input type="text" class="form-control" placeholder="Search ' + title + '" />' );
			} );
			
			// Apply the search
			table3.columns().every( function () {
				var that = this;
			
				$( 'input', this.footer() ).on( 'keyup change', function () {
					if ( that.search() !== this.value ) {
						that
							.search( this.value )
							.draw();
					}
				} );
			} );
		} );
		</script>
		
		<table class="table table-bordered datatable" id="table-3">
            <thead>
		     	<tr class="replace-inputs">
				     <th>#</th>
					 <th>nom</th>
					 <th>titre</th>
					 <th>description</th>
					<th>image</th>
					<th>document</th>
					<th>vedio</th>
					<th>Niveau</th>
					<th>date</th>
					<th>test</th>
					<th>Categorie</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php


						$req = $bd ->query('SELECT * FROM courses ');       

						while($data = $req->fetch()):
							$tests_id=$data['test_id'];
							$Categorie_id=$data['Categorie_id'];
							$course_id=$data['id'];
		
							$reqContent = $bd ->query("SELECT * FROM contents where cours_id = $course_id");
							$dataContent = $reqContent->fetch();

						// 	echo '<pre>';
						// 	var_dump($test_id);
						//    echo '</pre>';
						//   die();
							
							$reqtest = $bd ->query("SELECT * FROM tests where id = $tests_id");
							$reqtest ->execute();
							$datatest = $reqtest->fetch();


							$reqcategorie = $bd ->query("SELECT * FROM categories where id = $Categorie_id");
							$reqcategorie ->execute();
						    $datacategorie = $reqcategorie->fetch();


							
						// 	 echo '<pre>';
						// 	     var_dump($restest);
						// 	 echo '</pre>';
						// 	 echo '<pre>';
						// 	 var_dump($resCategorie);
						//  echo '</pre>';
						// 	 die();
		
		
				?>
			
				<tr class="gradeA">
					<td><?= $data['id'] ?></td>
					<td><?= $data['nom'] ?></td>
					<td><div class="td-content product-brand text-danger"><?= $data['titre'] ?></div></td>
					<td><?= substr($data['description'],0,50) ?></td>
					<td><img width="100" hieght="120" src="../upload/imgs/<?= $dataContent['image'] ?>" alt="pas image"></td>
					<td><div class="td-content product-brand text-primary"><?= $dataContent['document'] ?></div></td>
					<td><div class="td-content product-brand text-primary"><?= $dataContent['vedio'] ?></div></td>
					<td><?= $data['niveau'] ?></td>
					<td><?= $data['date'] ?></td>
					<td><?= $datatest['titre'] ?></td>
					<td><?= $datacategorie['titre'] ?></td> 
					
					<td>
						<a href="/learningha/course/modifier.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
							<i class="fa fa-edit"></i>
						</a>
						<a href="/learningha/course/supprimer.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm">
							<i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
				<?php
					endwhile;
				?>
			</tbody>

		</table>
		</div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

</section>
<?php include '../includes/footer.php'; ?>