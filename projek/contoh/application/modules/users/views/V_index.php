	<div class="row">
        <ol class="breadcrumb">
            <li><a href="#"> <em class="glyphicon glyphicon-home"></em></a></li>
            <li class="active">User Management</li>
        </ol>
    </div>
    <div id="page-inner"><br>
        
        <button data-toggle="modal" data-target="#mycreate" class="btn btn-primary create"><i class="fa fa-plus"></i> User</button>
		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Email</th>
					<th>User Type</th>
					<th>Status</th>
					<th>Action</th>
                </tr>
			</thead>
			<tbody>
				<?php 
				$no=1;				
				foreach($users as $user){
				?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $user['nama']; ?></td>
					<td><?php echo $user['email']; ?></td>
					<td><?php echo $user['user_type']; ?></td>
					<td>
						<?php 
							if($user['status'] == 0){
								echo 'Tidak Aktif';
							}else{
								echo 'Aktif';
							}
						?>
					</td>
					<td>
						<?php
							if($user['status'] == 0){
								echo '<a href="'.base_url('auth/setuju/').$user['id'].'" class="btn btn-success">Setuju</a>';
							}else{
								echo '<a href="'.base_url().'" class="btn btn-success" disabled>Setuju</a>';
							}
						?>
						<a href="<?= base_url() ?>users/hapus/<?= $user['id'];?>" onclick="return confirm('Do you want to delete <?php echo $user['nama']?>  ?')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
					</td>
		
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<!-- modal crate -->
		<div id="mycreate" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- modal konten -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" >&times</button>
						<h4 class="modal-title">Create</h4>
					</div>
					<div class="modal-body">
                        <form method="POST" action="<?= base_url() ?>users/simpan" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="">
							<div class="form-group">
								<label for="exampleInputEmaill">name</label>
								<input type="text" class="form-control" name="name" placeholder="name">
							</div>
							<div class="form-group">
								<label for="">User Type</label>
								<select name="user_type" id="" class="form-control" required>
									<option value="">-Pilih User Type-</option>
									<option value="Dosen">Dosen</option>
									<option value="Mahasiswa">Mahasiswa</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Email Address</label>
								<input type="text" class="form-control" name="email" placeholder="Email address">
							</div>
							<div class="form-group">  
								<label for="exampleInputEmaill">NIM/NIP</label>
								<input type="text" class="form-control" name="userid" placeholder="Student ID Number">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Password</label>
								<input type="password" class="form-control" name="password" placeholder="password">
							</div>
							<div class="modal-footer">
								<button class="btn btn-success" name="tambah">Create</button>
								<button class="btn btn-default" data-dismiss="modal" name="close">Close</button>
							</div>
						</form>
					</div>
				</div>
            </div>
		</div>
    </div>
</div>
