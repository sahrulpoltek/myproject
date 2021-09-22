<div id="page-wrapper" >
    <div id="page-inner">

        <h2>VM Management</h2>
        <button data-toggle="modal" data-target="#mycreate" class="btn btn-primary create"><i class="fa fa-plus"></i> Add VPS</button>
		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<td>No</td>
					<td>VMID</td>
					<td>Hostname</td>
					<td>OS</td>
					<td>Vcore</td>
					<td>Memory(MB)</td>
					<td>Disk(GB)</td>
					<td>Node</td>
					<td>Status</td>
					<td>Action</td>
                </tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				foreach($allvps as $vps){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $vps['id_vps']; ?></td>
					<td>x</td>
					<td><?php echo $vps['os']; ?></td>
					<td><?php echo $vps['vcore']; ?></td>
					<td><?php echo $vps['memory']; ?></td>
					<td><?php echo $vps['disk']; ?></td>
					<td><?php echo $vps['id_node']; ?></td>
					<td><?php echo $vps['status']; ?></td>
					<td>
						<!-- modal untuk memicu modal ubah -->
						<!-- <button data-toggle="modal" data-target="#update<?php echo $vps['id_vps'];?>" class="btn btn-success btn-sm" ><i class="glyphicon glyphicon-edit"></i></button> -->
						
						<!-- modal untuk memicu modal hapus -->
						<a href="<?= base_url()?>vps/hapus/<?php echo $vps['id_vps'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to Delete ?')"><i class="glyphicon glyphicon-trash"> Delete</i></a>
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
                        <form method="POST" action="<?= base_url() ?>vps/simpan" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="">
							<div class="form-group">
								<label for="exampleInputEmaill">Name :</label>
								<input type="text" class="form-control" name="name" placeholder="VM name (ex.vm01)">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Operating System :</label>
								<select class="form-control" name="os" required type="text" aria-describedby="nameHelp" placeholder="hostname">
									<option value="">--Pilih Template--</option>
									<?php
									foreach($templates as $tmp) {
										echo '<option value="'.$tmp['id'].'">'.$tmp['template_name'].'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Password</label>
								<input type="password" class="form-control" name="password" placeholder="password">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Number of Core :</label>
								<input type="text" class="form-control" name="core" placeholder="Number of core(s)">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Memory :</label>
								<input type="text" class="form-control" name="memory" placeholder="ex.1024 MB">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Hard Disk :</label>
								<input type="text" class="form-control" name="disk" placeholder="ex. 1000 GB">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">IP Address :</label>
								<select class="form-control" name="ip" required type="text" aria-describedby="nameHelp" placeholder="hostname">
									<option value="">--pilih IP address--</option>
									<?php
									foreach($ip_address as $ip) {
										echo '<option value="'.$ip['id'].'">'.$ip['address'].'</option>';
									}
									?>
								</select>
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
