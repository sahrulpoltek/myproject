	<div class="row">
        <ol class="breadcrumb">
            <li><a href="#"> <em class="glyphicon glyphicon-home"></em></a></li>
            <li class="active">List IP Block </li>
        </ol>
    </div>
	
    <div id="page-inner"><br>
        
        <button data-toggle="modal" data-target="#mycreate" class="btn btn-primary create"><i class="fa fa-plus"></i> IP block</button>
		<br><br>

		<table class="table table-bordered table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th style="text-align:center">Name</td>
					<th style="text-align:center">gateway</td>
					<th style="text-align:center">prefix</td>
					<th style="text-align:center">node</td>
					<th style="text-align:center">Action</td>
                </tr>
			</thead>
			<tbody>
				<?php 
				foreach($ipblocks as $block){
					foreach($node as $nd){
						if($nd['id'] == $block['id_node']) $node_name= $nd['nama_node'];
					}
				?>
				<tr>
					<td style="text-align:center"><?php echo $block['name']; ?></td>
					<td style="text-align:center"><?php echo $block['gateway']; ?></td>
					<td style="text-align:center"><?php echo $block['prefix']; ?></td>
					<td style="text-align:center"><?php echo $node_name; ?></td>
					<td style="text-align:center">
						<!-- modal untuk memicu modal ubah -->
						<!-- <button data-toggle="modal" data-target="#update<?php echo $block['id'];?>" class="btn btn-success btn-sm" ><i class="glyphicon glyphicon-edit"></i></button> -->
						
						<!-- modal untuk memicu modal hapus -->
						<a href="<?= base_url()?>ipblock/hapus/<?php echo $block['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to Delete ?')"><i class="glyphicon glyphicon-trash"></i></a>
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
						<h4 class="modal-title">Create new IP Block</h4>
					</div>
					<div class="modal-body">
                        <form method="POST" action="<?= base_url() ?>ipblock/simpan" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="">
							<div class="form-group">
								<label for="exampleInputEmaill">Name :</label>
								<input type="text" class="form-control" name="name" placeholder="VM name (ex.vm01)">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Gateway :</label>
								<input type="text" class="form-control" name="gateway" placeholder="ex. 192.168.1.1">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Broadcast :</label>
								<input type="text" class="form-control" name="broadcast" placeholder="ex. 192.168.1.255">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Prefix :</label>
								<input type="text" class="form-control" name="prefix" placeholder="ex. 24">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Node Server :</label>
								<select class="form-control" name="node" required type="text" aria-describedby="nameHelp" placeholder="Node Server">
									<option value="">--Pilih Node Server--</option>
										<?php
											foreach ($node as $nd)  {
												echo '<option value="'.$nd['id'].'">'.$nd['nama_node'].'</option>';
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
