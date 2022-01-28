<!-- Aksi Insert Data dalam DB -->
<?php 

		$koneksi = mysqli_connect("localhost", "root", "", "nofryanti");

		if (isset($_REQUEST['simpan'])) {
			$nim = $_REQUEST['nim'];
			$nama = $_REQUEST['nama'];
			$email = $_REQUEST['email'];
			$nilai = $_REQUEST['nilai'];


			$result = mysqli_query($koneksi,"INSERT INTO mahasiswa (nama, NIM, email, nilai) 
										values ('$nama','$nim','$email','$nilai')");
			if ($result) {
				echo "<script>alert('Data berhasil ditambahkan.');window.location='index.php';</script>";
			}else{
				echo "<br><div class='alert alert-danger'><strong>Perhatian !!</strong> Data gagal disimpan</div>";
			}
		}

		// Script edit data
		if (isset($_REQUEST['edit'])) {
			$id = $_REQUEST['id'];
			$nim = $_REQUEST['nim'];
			$nama = $_REQUEST['nama'];
			$email = $_REQUEST['email'];
			$nilai = $_REQUEST['nilai'];

			$result = mysqli_query($koneksi,"UPDATE mahasiswa SET 
										nama='$nama', 
										NIM='$nim', 
										email='$email', 
										nilai = '$nilai'
										WHERE id='$id'");
			if ($result) {
				echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
			}else{
				echo "<br><div class='alert alert-danger'><strong>Perhatian !!</strong> Data gagal disimpan</div>";
			}
		}


		// Akhir hapus data
		if (isset($_REQUEST['hapus'])) {
			$id=$_REQUEST['id'];

			$result = mysqli_query($koneksi,"DELETE FROM mahasiswa WHERE id='$id'");
			if ($result) {
				echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>";
			}else{
				echo "<br><div class='alert alert-danger'><strong>Perhatian !!</strong> Data gagal dihapus</div>";
			}
		}
?>
<!-- Akhir insert data -->




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>CRUD Data Mahasiswa</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>


<body style="font-family: Times, serif;">
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Data Mahasiswa</h2>
					</div>
					<div class="col-sm-6">
						<a href="#tambah" class="btn btn-dark" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Data</span></a>
					</div>
				</div>
			</div>

			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>NIM</th>
						<th>Email</th>
						<th>Nilai</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
                                  $query = mysqli_query($koneksi ,"SELECT * FROM mahasiswa ORDER BY id desc");             
                                  $no = 1;
                                  while ($data=mysqli_fetch_array($query)) {
                                  {
                                  ?>
					<tr>
		
						<td><?php echo $no; ?></td>
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['NIM']; ?></td>
						<td><?php echo $data['email']; ?></td>
						<td><?php echo $data['nilai']; ?></td>
						<td>
							<a href="#editEmployeeModal<?php echo $data['id']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteEmployeeModal<?php echo $data['id']; ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Hapus">&#xE872;</i></a>
					</tr>
					
									<!-- ADD Modal HTML -->
									<div id="tambah" class="modal fade">
														<div class="modal-dialog">
															<div class="modal-content">
																<form method="post" action="">
																	<div class="modal-header">						
																		<h4 class="modal-title">Tambah data</h4>
																		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	</div>
																	<div class="modal-body">					
																		<div class="form-group">
																			<label>Nama</label>
																			<input type="text" name="nama" class="form-control" required>
																		</div>
																		<div class="form-group">
																			<label>NIM</label>
																			<input type="text" name="nim"class="form-control" required>
																		</div>
																		<div class="form-group">
																			<label>Email</label>
																			<input type="email" name="email"class="form-control" required>
																		</div>
																		<div class="form-group">
																			<label>Nilai</label>
																			<input type="text" name="nilai"class="form-control" required>
																		</div>					
																	</div>
																	<div class="modal-footer">
																		<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
																		<input type="submit" name="simpan" class="btn btn-success" value="simpan">
																	</div>
																</form>
															</div>
														</div>
													</div>
					        		<!-- EDIT -->
										<div id="editEmployeeModal<?php echo $data['id']; ?>"  class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<form method="post" action="">
														<div class="modal-header">						
															<h4 class="modal-title">Edit Data Mahasiswa</h4>
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														</div>
														<div class="modal-body">		
														<input type="hidden" name="id" value="<?php echo $data['id']; ?>">			
															<div class="form-group">
																<label>Nama</label>
																<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>">
															</div>
															<div class="form-group">
																<label>NIM</label>
																<input type="text" name="nim" class="form-control" value="<?php echo $data['NIM']; ?>">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input type="email" name="email"class="form-control" value="<?php echo $data['email']; ?>">
															</div>
															<div class="form-group">
																<label>Nilai</label>
																<input type="text" name="nilai" class="form-control" value="<?php echo $data['nilai']; ?>">
															</div>					
														</div>
														<div class="modal-footer">
															<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
															<input type="submit" name="edit" class="btn btn-success" value="Save">
														</div>
													</form>
												</div>
											</div>
										</div>

											<!-- Delete Modal HTML -->
											<div id="deleteEmployeeModal<?php echo $data['id']; ?>" class="modal fade"  tabindex="-1" >
											<div class="modal-dialog">
												<div class="modal-content">
													<form action="" method="POST">
														<div class="modal-header">						
															<h4 class="modal-title">Hapus Data Mahasiswa</h4>
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														</div>
														<div class="modal-body">					
															<p>Apakah anda yakin untuk menghapus data ini?</p>
															<p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
																<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
														</div>
														<div class="modal-footer">
															<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
															<input type="submit" name="hapus" class="btn btn-danger" value="Delete">
														</div>
													</form>
												</div>
											</div>
										</div>
									</td>
               
                    <?php
                      $no++; //untuk nomor urut terus bertambah 1
                    }}
                    ?>
				</tbody>
			</table>
		</div>
	</div>        
</div>	
</body>
</html>


	

