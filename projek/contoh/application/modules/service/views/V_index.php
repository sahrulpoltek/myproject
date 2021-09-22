<!-- <div id="page-wrapper" > -->
<div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="glyphicon glyphicon-home"></em>
                    </a></li>
                    <li class="active">Packages</li>
                </ol>
        </div>
		
	<div id="row"><br>
    <!-- <div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Add Packages</h3>
			</div>
		</div> -->
        <div class="panel panel-container">
			<div class="row">
                <div class="panel-body">
                    <div class="col-md-12">
                    <h4>Add Packages</h4>  
                        <form method="POST" action="<?= base_url() ?>service/simpan" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="">
                            <div class=" form-group ">            
                                <label class="col-md-3">Name :
                                <input type="text"  class=" form-control" name="nama"  placeholder="apache">
                                </label>
                            </div>              
                            <div class="form-group" >
                                <label class="col-md-9">Package Name on System :
                                <input type="text"  class="form-control " name="value" placeholder=" apache2 ">
                                </label>
                            </div>
                            
                            <button class="btn btn-success" style="float: right" name="tambah">Create</button>
                    
                        </form>                        
                    </div>                    
                </div>
            </div>
        </div>
        <div class="panel panel-container">
            <div class="row">	
            <div class="panel-body">
            <div class="col-md-12">
            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">No.</th>
                            <th style="text-align:center">Packages Name</th>
                            <th style="text-align:center">Package Name on System</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no=1;
                        foreach($service as $srv){
                        ?>
                        <tr>
                        <td style="text-align:center"><?php echo $no++?></td>
                            <td style="text-align:center"><?php echo $srv['name']; ?></td>
                            <td style="text-align:center"><?php echo $srv['value']; ?></td>
                            <td style="text-align:center">
                                <!-- modal untuk memicu modal ubah -->
                                <button data-toggle="modal" data-target="#update<?php echo $srv['id'];?>" class="btn btn-success btn-sm" ><i class="glyphicon glyphicon-edit"></i></button>
                                <!-- modal untuk memicu modal hapus -->
                                <a href="<?= base_url()?>service/hapus/<?php echo $srv['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to Delete ?')"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>

                                <div id="update<?= $srv['id']; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- modal konten -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" >&times</button>
                                                <h4 class="modal-title">Update Data Packages</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?= base_url() ?>service/simpan" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $srv['id']; ?>">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmaill">Name :</label>
                                                        <input type="text" class="form-control" name="nama" value="<?= $srv['name']; ?>" placeholder="apache">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmaill">Value :</label>
                                                        <input type="text" class="form-control" name="value" value="<?= $srv['value']; ?>" placeholder="apt install apache2 -y">
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
            </div>
            </div>
            </div>
        </div>


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
                        <form method="POST" action="<?= base_url() ?>service/simpan" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="">
							<div class="form-group">
								<label for="exampleInputEmaill">Name :</label>
								<input type="text" class="form-control" name="nama" placeholder="ex.tugas_akhir">
							</div>
							<div class="form-group">
								<label for="exampleInputEmaill">Password :</label>
								<input type="text" class="form-control" name="value" placeholder="Password server">
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
