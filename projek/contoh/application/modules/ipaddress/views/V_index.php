	<div class="row">
        <ol class="breadcrumb">
            <li><a href="#"> <em class="glyphicon glyphicon-home"></em></a></li>
            <li class="active">IP Address </li>
        </ol>
    </div>
    <div id="page-inner"><br>
        <button data-toggle="modal" data-target="#mycreate" class="btn btn-primary create"><i class="fa fa-plus"></i> IP address</button>
		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="text-align:center">IP Address</td>
					<th style="text-align:center">Assigned to VPS</td>
					<th style="text-align:center">Block</td>
					<th style="text-align:center">Action</td>
                </tr>
			</thead>
			<tbody>
				<?php 
				foreach($ipaddress as $ip){
					foreach($blok as $blk){
						if($blk['id'] == $ip['id_blok']) $blok_name = $blk['name'];
					}
				?>
				<tr>
					<td style="text-align:center"><?php echo $ip['ip_address']; ?></td>
					<td style="text-align:center"><?php echo $ip['id_vps']; ?></td>
					<td style="text-align:center"><?php echo $blok_name; ?></td>
					<td style="text-align:center">
						<!-- modal untuk memicu modal ubah -->
						<!-- <button data-toggle="modal" data-target="#update<?php echo $ip['id_ip'];?>" class="btn btn-success btn-sm" ><i class="glyphicon glyphicon-edit"></i></button> -->
						
						<!-- modal untuk memicu modal hapus -->
						<a href="<?= base_url()?>ipaddress/hapus/<?php echo $ip['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to Delete ?')"><i class="glyphicon glyphicon-trash"></i></a>
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
						<h4 class="modal-title">Create new IP Address</h4>
					</div>
					<div class="modal-body">
                        <form method="POST" action="<?= base_url() ?>ipaddress/simpan" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="">
							<div class="form-group">
								<label for="exampleInputEmaill">Start IP  :</label>
								<input type="text" class="form-control" name="ip1" placeholder="ex.192.168.1.3">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">End IP:</label>
								<input type="text" class="form-control" name="ip2" placeholder="ex. 192.168.1.7">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">IP Block :</label>
								<select class="form-control" name="block" required type="text" aria-describedby="nameHelp" placeholder="Node Server">
									<option value="">--Pilih IP_block--</option>
										<?php
											foreach ($blok as $blk)  {
												echo '<option value="'.$blk['id'].'">'.$blk['name'].'</option>';
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
