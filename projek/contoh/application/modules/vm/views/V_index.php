
		<div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="glyphicon glyphicon-home"></em>
                    </a></li>
                    <li class="active">VM Management</li>
                </ol>
        </div>
    <div id="page-inner">
        <!-- <h2>Data VM</h2> --><br>
        <button data-toggle="modal" data-target="#mycreate" class=" btn btn-success create"><i class="fa fa-plus"></i> Create VM</button>

		<br><br>
		<div class="card-body">
			<table id="example" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="text-align:center">No</th>
						<th style="text-align:center">VMID</th>
						<th style="text-align:center">Hostname</th>
						<th style="text-align:center">Template</th>
						<th style="text-align:center">IP</th>
						<th style="text-align:center">Status</th>
						<th style="text-align:center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					// $machine = $this->crud->get('tb_vps', 'id', 'ASC')->result_array();
					// if($machine->num_rows()>0){
					$no=1;
					// print_r($machine);die;
					foreach($machine as $vm){
						$status = '';
						$status1 = '';
						if($vm['status'] == 0){
							$status = '<span style="color:red">Stop</span>';
							$status1 = '<img src="'.base_url().'assets/images/stop.png" style="width:30px; height:30px" onclick="status_('.$vm["vps_id"].', 1)"/>';
							$console = "<button class='btn btn-sm btn-primary disabled'><i class='fa fa-terminal' aria-hidden='true'></i></button>";
							$disabled = '<a href='. base_url('vm/hapus/').$vm["id"] .' onclick="return confirm("Do you want to Delete ? ")" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';

						}else if($vm['status'] == 1){
							$status = '<span style="color:green">Running</span>';
							$status1 = '<img src="'.base_url().'assets/images/run.png" style="width:30px; height:30px" onclick="status_('.$vm['vps_id'].', 0)"/>';
							$console = '<a href='. base_url('console?vmid=').$vm["vps_id"] .' class="btn btn-sm btn-primary"><i class="fa fa-terminal" aria-hidden="true"></i></a>';
							$disabled = '<a href='. base_url('vm/hapus/').$vm["id"] .' onclick="return confirm("Do you want to Delete ? ")" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
						}

						foreach ($template as $tmp) {
							if($tmp['id'] == $vm['template_id']) $tmp_name = $tmp['template_name'];
							// else $tmp_name = "";
						}
					?>
					<tr>
						<td style="text-align:center"><?php echo $no++?></td>
						<td style="text-align:center"><?php echo $vm['vps_id']?></td>
						<td style="text-align:center"><?php echo $vm['hostname']?></td>
						<td style="text-align:center"><?php echo $tmp_name?></td>
						<td style="text-align:center"><a target="_blank" href="http://<?= $vm['ip_address']?>"><?php echo $vm['ip_address']?></a></td>
						<td style="text-align:center"><?php echo $status?></td>
						<td style="text-align:center">
							<?php echo $status1?>
							<?php echo $console?>
							<?php echo $disabled?>
							<a target="_blank" href="http://<?= $vm['ip_address'].":8000"?>"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>

						</td>
							
					</tr>
					<?php }?>

					</tbody>

			</table>
		</div>
		<div id="modal-html"></div>

			
		<!-- modal crate -->
		<div id="mycreate" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- modal konten -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" >&times</button>
						<h4 class="modal-title">Create VM</h4>
					</div>
					<div class="modal-body">
                        <form method="POST" action="<?= base_url() ?>vm/simpan" enctype="multipart/form-data" name="form1">
                            <input type="hidden" name="id" value="">
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label for="exampleInputName">Template</label>
											<select class="form-control" name="template" required type="text" aria-describedby="nameHelp" placeholder="hostname">
												<option value="">--Pilih Template--</option>
												<?php
												foreach ($template as $tmp)  {
													echo '<option value="'.$tmp['id'].'">'.$tmp['template_name'].'</option>';
												}
												?>
											</select>
									</div>

									<div class="col-md-12">
										<label for="exampleInputName">NIS/Username</label>
										<input class="form-control" type="text" id="username" required aria-describedby="nameHelp" placeholder="NIS/Username" name="username">
									</div>

									<div class="col-md-12">
										<label for="exampleInputName">Password</label>
										<input class="form-control" type="password" id="pass" required aria-describedby="nameHelp" placeholder="Password" name="password">
									</div>

									<!-- <div class="col-md-12">
										<label for="exampleInputName">VMID</label>
										<input class="form-control" type="text" id="vmid" required aria-describedby="nameHelp" placeholder="vmid" name="vmid">
									</div> -->

									<div class="col-md-12">
										<label for="exampleInputName">Hostname</label>
										<input class="form-control" type="text" id="hostname" required aria-describedby="nameHelp" placeholder=".poliupg.ac.id" name="hostname">
									</div>

									<div class="col-md-8">
										<label for="exampleInputName">IP</label>
										<input required name="ip1" type="text" class="form-control" placeholder="192.168.1.100">
									</div> 
									<div class="col-md-4">
										<label for="exampleInputName">Prefix Length</label>
										<input required  name="pl" type="text" class="form-control" id="pl" placeholder="ex: 24" type="number">
									</div>

									<div class="col-md-12">
										<label for="exampleInputName">Gateway</label>
										<input required name="gw" type="text" class="form-control" placeholder="192.168.1.1">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" onclick="ValidateIPaddress(document.form1.ip1, document.form1.gw)" name="tambah">Create</button>
								<button type="submit" style="display: none" id="submit">Create</button>
								<button class="btn btn-default" data-dismiss="modal" name="close">Close</button>
							</div>
						</form>
					</div>
				</div>
            </div>
		</div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	function status_(vps_id, status){
        $.ajax({
            url: "<?php echo base_url()?>vm/ubah_status",
            type: "post",
            data: {
                vps_id: vps_id,
                status: status
            },
            success: function (data) {
				if(status == 0){
					swal({
						title: 'VM shutdown',
						type: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'OK',
						confirmButtonClass: 'btn btn-success',
						buttonsStyling: false
					}).then((result) => {
						location.replace('<?php echo base_url()?>vm');
					})
				}else{
					if(JSON.parse(data) == null){
						modalDataPendukung(vps_id);
					}else{
						swal("Menyalakan vm....", {
							button: false,
							timer:1500,
						}).then(function () {
							location.replace('<?php echo base_url()?>vm');
						})
					}
				}
            }
        })
	}

	function modalDataPendukung(vps_id){
		document.getElementById('modal-html').innerHTML= 
		`<div id="modalDataPendukung" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- modal konten -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" >&times</button>
						<h4 class="modal-title">Data Pendukung</h4>
					</div>
					<div class="modal-body">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#nav-service">Service</a></li>
							<li><a data-toggle="tab" href="#nav-log">Package Installed</a></li>
						</ul>
						<div class="tab-content">
							<div id="nav-service" class="tab-pane fade in active">
                       			 <form method="POST" id="form-data-pendukung">
						
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label for="exampleInputName">Web Server</label></br>
												<fieldset class="form-control">
													<label style="padding-left:10px;" class="">
														<input  type="radio" name="webserver" value="apache2"> Apache
													</label>
													<label style="padding-left:40px;">
														<input  type="radio" name="webserver" value="nginx"> Nginx
													</label>
												</fieldset>
											</div>
											<div class="col-md-6">
												<label for="exampleInputName">Database</label></br>
												<fieldset class="form-control">
													<label style="padding-left:10px;" class="">
														<input  type="radio" name="db" value="mariadb-server mariadb-client"> MariaDB
													</label>
													<label style="padding-left:40px;">
														<input  type="radio" name="db" value="influxdb influxdb-client"> Influxdb
													</label>
												</fieldset>
											</div>
		
											<div class=" col-md-12">		
											<br><label>Other Packages :</label>						
												<fieldset class="koran">
												<div class="d-flex flex-wrap">	
												<?php 
													foreach($service as $srv){
												?>
												<label class="checkbox-inline" style="width:33%; margin-left:0;">
													<input type="checkbox" id="service<?= $srv['id'] ?>" name="service[]" value="<?= $srv['value'] ?>"> <?= $srv['name'] ?>
												</label>
												<?php
														}
												?> 
												</div>
												</fieldset>
												
											</div>
										</div>
										<div class="row" style="margin-top:12px">
											<div class="col-md-12">
												<div id="console-data"></div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" onclick="showConsole(${vps_id})" name="tambah">Install</button>
										<button type="submit" style="display: none" id="submit">Create</button>
										<button class="btn btn-default" data-dismiss="modal" name="close" onclick="javscript:location.replace('<?php echo base_url()?>vm')">Close</button>
									</div>
								</form>				
							</div>
						<div id="nav-log" class="tab-pane fade in ">
						<div class="form-group">
							<div class="input-group">
								<input type="text" id="search_services" placeholder="Search Service..." onkeyup="showLog(${vps_id})" class="form-control">
								<div class="input-group-addon">
								<i class="fa fa-search"></i>
								</div>
							</div>

							<div class="row" style="margin-top:12px">
								<div class="col-md-12">
								<div id="log-data" style="overflow-x: auto;overflow-y: auto;"></div>
								</div>
							</div>  
							</div>			
						</div>
						</div>
					</div>
				</div>
            </div>
		</div>`
		swal("Menyalakan vm....", {
			button: false,
			timer:6000,
		}).then(function () {
			$("#modalDataPendukung").modal();
		})
	}

	function showConsole(vps_id){
		swal("Install package...", {
			button: false,
		})
		let data = new FormData()
		let form = $('#form-data-pendukung').serializeArray()
		$.each(form, function(key, input){
			data.append(input.name, input.value);
		});
		data.append('vps_id', vps_id );
		$.ajax({
			url: "<?php echo base_url()?>vm/install",
			type: "post",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				if(JSON.parse(data)){
					swal("Install selesai", {
						button: false,
						timer: 1500
					})
					let show = `<iframe srcdoc="<pre>${JSON.parse(data)}" scrolling="yes" width="100%" height="300px"></iframe>`
					document.getElementById('console-data').innerHTML= show
				}else{
					swal("VM belum nyala, harap tunggu beberapa saat", {
						button: false,
						timer: 1500
					})
				}
			},
		})
		$.ajax({
			url: "<?php echo base_url()?>vm/logs/"+vps_id,
			type: "GET",
			success: function (data) {
				if(JSON.parse(data)){
					let shows = `<iframe srcdoc="<pre>${JSON.parse(data)}" scrolling="yes" width="100%" height="300px"></iframe>`
					document.getElementById('log-data').innerHTML= shows
				}
			},
		})
	}
	
	function showLog(vps_id){
		var x = document.getElementById("search_services");
		var searchString = x.value.toLowerCase();
		$.ajax({
			url:"<?php echo base_url()?>vm/log_filter/"+vps_id+"/"+searchString,
			method:'GET',
			success:function(data)
			{
				if(JSON.parse(data)){
					let showss = `<iframe srcdoc="<pre>${JSON.parse(data)}</pre>" scrolling="yes" width="100%" height="300px"></iframe>`
					document.getElementById('log-data').innerHTML= showss
				}
			}
		}); 
	}

	function ValidateIPaddress(inputText, gw){
		var ipformat = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;  
		if(inputText.value.match(ipformat) && gw.value.match(ipformat)){  
			if($('#pl').val() < 1 || $('#pl').val() > 32){
				alert("You have entered an invalid Prefix Length!");  
				document.form1.ip1.focus();
			}else{
				var pass = $('#pass').val();
				if(pass.length < 5){
					alert("Password terlalu pendek!");  
					document.form1.pass.focus();
				}else{
					$('#submit').click();  
				}
			}
		}else{  
			alert("You have entered an invalid IP address!");  
			document.form1.ip1.focus();
		}  
	}
</script>