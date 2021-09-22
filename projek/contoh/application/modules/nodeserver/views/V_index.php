<!-- <div id="page-wrapper" > -->
		<div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="glyphicon glyphicon-home"></em>
                    </a></li>
                    <li class="active">Node Server</li>
                </ol>
        </div>
		
	<div id="page-inner"><br>
		<button data-toggle="modal" data-target="#mycreate" class="btn btn-primary create"><i class="fa fa-plus"></i> Node Server</button>
			
		<br><br>
	
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="text-align:center">Node Name</td>
						<th style="text-align:center">Password</td>
						<th style="text-align:center">IP Address</td>
						<th style="text-align:center">OS</td>
						<th style="text-align:center">Momory Size (MB)</td>
						<th style="text-align:center">Disk size (GB)</td>
						
						<!-- <td>Location</td> -->
						<th>Action</td>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($nodeserver as $node){
					?>
					<tr>
						<td style="text-align:center"><?php echo $node['nama_node']; ?></td>
						<td style="text-align:center"><?php echo $node['password']; ?></td>
						<td style="text-align:center"><?php echo $node['ip_address']; ?></td>
						<td style="text-align:center"><?php echo $node['os']; ?></td>
						<td style="text-align:center"><?php echo $node['memory']; ?></td>
						<td style="text-align:center"><?php echo $node['disk']; ?></td>
						
						<!-- <td><?php //echo $node['id_location']; ?></td> -->
						<td style="text-align:center">
							<!-- modal untuk memicu modal ubah -->
							<button data-toggle="modal" data-target="#update<?php echo $node['id'];?>" class="btn btn-success btn-sm" ><i class="glyphicon glyphicon-edit"></i></button>
							
							<!-- modal untuk memicu modal hapus -->
							<a href="<?= base_url()?>nodeserver/hapus/<?php echo $node['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to Delete ?')"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
							<div id="update<?= $node['id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<!-- modal konten -->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" >&times</button>
											<h4 class="modal-title">Update Data User</h4>
										</div>
										<div class="modal-body">
											<form method="POST" action="<?= base_url() ?>nodeserver/simpan" enctype="multipart/form-data">
												<input type="hidden" name="id" value="<?= $node['id']; ?>">
												<div class="form-group">
													<label for="exampleInputEmaill">Name :</label>
													<input type="text" class="form-control" name="name" value="<?= $node['nama_node']; ?>" placeholder="VM name (ex.vm01)">
												</div>
												<div class="form-group">
													<label for="exampleInputEmaill">Password :</label>
													<input type="text" class="form-control" name="password" value="<?= $node['password']; ?>" placeholder="ex.server-tkj">
												</div>
												<div class="form-group">
													<label for="exampleInputEmaill">Operating System :</label>
													<input type="text" class="form-control" name="os" value="<?= $node['os']; ?>" placeholder="--choose OS--">
												</div>
												<div class="form-group">
													<label for="exampleInputEmaill">Memory Size :</label>
													<input type="text" class="form-control" name="memory" value="<?= $node['memory']; ?>" placeholder="ex.1024 MB">
												</div>
												<div class="form-group">
													<label for="exampleInputEmaill">Disk Size :</label>
													<input type="text" class="form-control" name="disk" value="<?= $node['disk']; ?>" placeholder="ex. 1000 GB">
												</div>
												<div class="form-group">
													<label for="exampleInputEmaill">IP Address :</label>
													<input type="text" class="form-control" name="ip" value="<?= $node['ip_address']; ?>" placeholder="ex.102.168.1.1">
												</div>
												<div class="modal-footer">
													<button class="btn btn-success" name="update">Update</button>
													<button class="btn btn-default" data-dismiss="modal" name="close">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /modal update -->
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
		


		<!-- modal crate -->
		<div id="mycreate" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- modal konten -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" >&times</button>
						<h4 class="modal-title">Create new node server</h4>
					</div>
					<div class="modal-body">
                        <form method="POST" action="<?= base_url() ?>nodeserver/simpan" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="">
							<div class="form-group">
								<label for="exampleInputEmaill">Name :</label>
								<input type="text" class="form-control" name="name" placeholder="ex.tugas_akhir">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Password :</label>
								<input type="text" class="form-control" name="password" placeholder="Password server">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Operating System :</label>
								<input type="text" class="form-control" name="os" placeholder="--choose OS--">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Memory Size :</label>
								<input type="text" class="form-control" name="memory" placeholder="ex.8 GB">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Disk Size :</label>
								<input type="text" class="form-control" name="disk" placeholder="ex. 1000 GB">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">IP Address :</label>
								<input type="text" class="form-control" name="ip" placeholder="ex.102.168.1.1">
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
