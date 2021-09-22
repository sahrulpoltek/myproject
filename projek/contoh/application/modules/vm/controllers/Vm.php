<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vm extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sess = $this->session->userdata('user');
		if(!$sess){
			redirect(base_url('login'));
		}	
	}

	public function index(){
		$sess = $this->session->userdata('user');
		$data['template'] = $this->crud->read('tb_template')->result_array();
		$data['service'] = $this->crud->read('tb_service')->result_array();
		$data['sess'] = $sess;
		if($sess['level'] == 'admin'){
			$data['machine'] = $this->crud->read('tb_vps')->result_array();
			$this->load->view('header');
			$this->load->view('V_index',$data);
			$this->load->view('footer');
		}else{
			$id = $this->crud->read('tb_akun',['email'=>$sess['username']])->result_array()[0]['id'];
			$nm['nma']= $this->crud->read('tb_akun',['id'=>$id])->row_array();//utk tmplkn nm dheader user
			// print_r($nm);die;
			$data['machine'] = $this->crud->read('tb_vps',['user_id'=>$id])->result_array();
						// print_r($data['machine']);die;
			$this->load->view('header_user',$nm);
			$this->load->view('V_index_user',$data);
			$this->load->view('footer_user');
		}
	}

	public function simpan(){
		// $id_vm = $this->input->post('id');
		require(getcwd()."/pve2_api.class.php"); //include API Proxmox
		$pve2 = new PVE2_API("10.0.12.245", "root", "pam", "t425k19j11");

		if ($pve2->login()) {
			//$vmid = $this->input->post('vmid');
			$ip = $this->input->post('ip1');
			$pl = $this->input->post('pl');
			$gw = $this->input->post('gw');
			// $user = $this->input->post('username');
			$user = $this->session->userdata('user')['username'];
			$pass = $this->input->post('password');
			$hostname = $this->input->post('hostname');
			$template = $this->input->post('template');
			// print_r($user);die;	
			$nodes = $pve2->get_node_list();
			$first_node = $nodes[0];
			$template_ = $this->crud->read('tb_template',['id' => $template])->result()[0]->template_name;
			$nextVMID = $pve2->get_next_vmid(); //vmid automatis


			$new_container_settings['ostemplate'] = "local:vztmpl/".$template_;
			$new_container_settings['vmid'] = $nextVMID;
			$new_container_settings['cores'] = "1";
			$new_container_settings['description'] = $user;
			$new_container_settings['hostname'] = $hostname;
			$new_container_settings['memory'] = "512";
			$new_container_settings['swap'] = "600";
			$new_container_settings['rootfs'] = "local-lvm:20";
			$new_container_settings['password'] = $pass;
			$new_container_settings['searchdomain'] = "8.8.8.8";
    		$new_container_settings['nameserver'] = "1.1.1.1";
			$new_container_settings['net0'] = "name=eth0,bridge=vmbr0,gw=".$gw.",ip=".$ip."/".$pl;
			$statu = "start";
			// print_r($new_container_settings['vmid']);die;
			$pve2->post("/nodes/".$first_node."/lxc", $new_container_settings);
			$pve2->post("/nodes/".$first_node."/lxc/".$nextVMID."/status/start", array()); //star otomatis lxc			
			$id = $this->crud->read('tb_akun',['email' => $user])->row_array();
			$disk = explode(':', $new_container_settings['rootfs'])[1];

			$data = [
				'vps_id' => $nextVMID,
				'hostname' => $hostname.".poliupg.ac.id",
				'password' => $pass,
				'template_id' => $template,
				'ip_address' => $ip,
				'memory' => $new_container_settings['memory'],
				'disk' => $disk,
				'status' => '0',
				'created' => date('Y-m-d H:i:s:'),
				'user_id' => $id['id'],
			];
			// print_r($data);die;
			$this->crud->create('tb_vps', $data);
			echo '<script>alert("Berhasil ditambahkan")</script>';
			redirect('vm','refresh');
			//install service pada lxc


		}else{
			print("Login to Proxmox Host failed.\n");
			exit;
		}
		

		// if($id_vm == ""){
		// 	$this->crud->create('machine',$data);
		// 	echo '<script>alert("Berhasil ditambahkan")</script>';
		// 	redirect('vm','refresh');
		// }else{
		// 	$this->crud->update('machine',$data,['id'=>$id_vm]);
		// 	echo '<script>alert("Berhasil diupdate")</script>';
		// 	redirect('vm','refresh');
		// }
	}

	public function install(){
		$ws = $this->input->post('webserver');
		$db = $this->input->post('db');
		$srv= $this->input->post('service');
		$serv = "";
		foreach ($srv as $sr){
			$serv .= $sr." ";//sm dng $serv=$serv.$sr." " yg setiap looping ada spasi (" ")
		}
		// print_r($srv);die;
		$vm = $this->crud->read('tb_vps',['vps_id' => $this->input->post('vps_id')])->row_array();
		$connection = ssh2_connect($vm['ip_address'], 22);
		ssh2_auth_password($connection, 'root', $vm['password']);		
		$stream =ssh2_exec($connection, "apt update -y  && apt upgrade -y && apt install $ws $db $serv -y ");
		stream_set_blocking($stream, true);
		// $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
		$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
		if($stream){
			$this->crud->update('tb_vps', ['stat_webserver' => 1] ,['vps_id' => $this->input->post('vps_id')]);
			$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
			// stream_set_blocking($stream_out, true);
			echo json_encode(stream_get_contents($stream_out));
		}else{
			// echo json_encode(false);
			stream_set_blocking($errorStream, true);
			echo json_encode(stream_get_contents($errorStream));

		}
	
	
	}

	public function log_filter($vps_id=null,$search=null){
		if(empty($vps_id) && empty($search)){
			$data = "nothing";
			echo json_encode($data);
		}
		// print_r($srv);die;
		$vm = $this->crud->read('tb_vps',['vps_id' => $vps_id])->row_array();
		// print_r($vm);die;
		$connection = ssh2_connect($vm['ip_address'], 22);
		ssh2_auth_password($connection, 'root', $vm['password']);
		
		// $stream =ssh2_exec($connection, ' for x in $(ls -1t /var/log/dpkg.log*); do zcat -f $x |tac |grep -e " install " ; done |column -t ');
		$stream =ssh2_exec($connection, " dpkg --get-selections ");
		stream_set_blocking($stream, true);
		$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
		// $data = json_encode(stream_get_contents($stream_out));
		$data = json_encode(stream_get_contents($stream_out));
		// print_r (explode("\\n",$data));die;
		$exdata = explode("\\n",$data);
		$datafix = array();
		foreach ($exdata as $xdata) {
			if (stripos(str_replace("\\t"," ",$xdata), $search) !== false) {
				array_push($datafix,str_replace("\\t"," ",$xdata));
			}
		}
		$datafixx = implode("<br>",$datafix);
		echo json_encode($datafixx);
		// print_r("<pre>".$data."</pre>");die;
	
	
	}
	public function logs($vps_id=null){
		if(empty($vps_id)){
			echo "<script>alert('VPS ID tidak ada')</script>";
			redirect('vm','refresh');
		}
		// print_r($srv);die;
		$vm = $this->crud->read('tb_vps',['vps_id' => $vps_id])->row_array();
		// print_r($vm);die;
		$connection = ssh2_connect($vm['ip_address'], 22);
		ssh2_auth_password($connection, 'root', $vm['password']);
		// $stream =ssh2_exec($connection, ' for x in $(ls -1t /var/log/apt/history.log*); do zcat -f $x |tac |grep -e " install " ; done |column -t ');
		/// $stream =ssh2_exec($connection, " for x in $(ls -1t /var/log/dpkg.log*); do zcat -f $x |tac |grep -e " install " ; done |awk -F ":a" '{print $1 " :a" $2}' |column -t ");

		// $stream =ssh2_exec($connection, " dpkg --get-selections ");
		$stream =ssh2_exec($connection, " cat /var/log/apt/history.log");
		stream_set_blocking($stream, true);
		$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
		$data = stream_get_contents($stream_out);
		// $datalog = str_replace("install",'Telah Di',$data);
		// print_r("<pre>".$datalog."</pre>");die;
		echo json_encode($data);
	
	}
	// publi
	// public function coba(){
	// 	$connection = ssh2_connect('10.0.12.122', 22);
	// 	ssh2_auth_password($connection, 'root', 'sahrul');
    //     $stream =ssh2_exec($connection, 'apt update -y && apt upgrade -y && apt install apache2 -y ');
	// 	stream_set_blocking($stream, true);
	// 	$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
	// 	// $data = "";
	// 	// while ($buf = fread($stream,4096)) {
	// 	// 	$data .= $buf;
	// 	// }
	// 	// fclose($stream);
	// 	echo '<pre>';
	// 	// echo $data;
	// 	echo stream_get_contents($stream_out);
	// }

	public function hapus($id){
		require(getcwd()."/pve2_api.class.php"); //include API Proxmox
		$pve2 = new PVE2_API("10.0.12.245", "root", "pam", "t425k19j11");
		if ($pve2->login()) {
			$nodes = $pve2->get_node_list();
			$first_node = $nodes[0];
			$cek_id = $this->crud->read('tb_vps', ['id' => $id]);
			if ($cek_id->num_rows() > 0) {
				$data_array = $cek_id->result();
				if ($data_array[0]->status == 0) {
					$status = 'stop';
					$vmid = $data_array[0]->vps_id;
					$id_ = $data_array[0]->id;
					$pve2->delete("/nodes/".$first_node."/lxc/".$vmid."");
					$this->crud->delete('tb_vps',['id'=>$id]);
					echo '<script>alert("Berhasil dihapus")</script>';
					redirect('vm','refresh');
				} else {
					redirect(base_url('error'));
					echo "kondisi vm_status = 0";
				}
			} else {
				redirect(base_url('error'));
			}
		}else{
			print("Login to Proxmox Host failed.\n");
			exit;
		}
	}

	public function ubah_status(){
		// $vmid = $this->input->post('vpopmail_del_domain(domain)');
		$vmid = $this->input->post('vps_id');
 		$vm_status = $this->input->post('status');

		require(getcwd()."/pve2_api.class.php"); //include API Proxmox
		$pve2 = new PVE2_API("10.0.12.245", "root", "pam", "t425k19j11");
		// var_dump($pve2->login());die;
		//$pve2->set_debug(true);
		if ($pve2->login()) {
			//Get first node name.
			$nodes = $pve2->get_node_list();
			$first_node = $nodes[0];
			$status_ = $vm_status == '0'? 'stop':'start';
			$pve2->post("/nodes/".$first_node."/lxc/".$vmid."/status/".$status_,array());
			
			$data = array('status' => $vm_status);
			$id_['vps_id'] = $vmid;

			$this->crud->update('tb_vps', $data, $id_);

			$result = $this->crud->read('tb_vps', $id_)->row_array();

			// die(json_encode(array('success' => 1)));
			die(json_encode($result['stat_webserver']));
		} else {
			die(json_encode(array('success' => 0, 'message' => 'Login Proxmox Gagal')));
		}
		redirect('vm','refresh');
	}

	public function subs(){
		echo getcwd();
	}
}
