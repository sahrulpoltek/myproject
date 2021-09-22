<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipaddress extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sess = $this->session->userdata('user');
		if(!$sess){
			redirect(base_url('login'));
		}	
	}

	public function index(){
		$sess = $this->session->userdata('user');
		$data['blok']=$this->crud->read('tb_ipblok')->result_array();
		$data['vps']=$this->crud->read('tb_vps')->result_array();
		if($sess['level'] == 'admin'){
			$data['sess'] = $sess;
			$data['ipaddress'] = $this->crud->read('tb_ipaddress')->result_array();
			$this->load->view('header');
			$this->load->view('V_index',$data);
			$this->load->view('footer');
		}else{
			redirect(base_url('dashboard'));
		}
	}

	function ip_range($start, $end) {
		$start = ip2long($start);
		$end = ip2long($end);
		return array_map('long2ip', range($start, $end) );
	}
	public function simpan(){
		// $id_ip = $this->input->post('id');
		// $ip1 = $this->input->post('ip1');
		// $ip2 = $this->input->post('ip2');

		$ipblk= $this->input->post('block');
		$range_one = $this->input->post('ip1');
		$range_two = $this->input->post('ip2');
		$ips=$this->ip_range($range_one, $range_two); 
		
		foreach($ips as $ip){
			$data = [
				'ip_address' => $ip,
				'id_blok' => $ipblk,
				'id_vps' => 0,
				'status' => 0
			];

			// print_r($data);die;
			$this->crud->create('tb_ipaddress',$data);
			
		}
		echo '<script>alert("Berhasil ditambahkan")</script>';
			redirect('ipaddress','refresh');

		// $data = [
		// 	'ip_address' => $ips,
		// 	'id_blok' => $ipblk
		// ];
		// print_r($data);die;
		// if($id_ip == ""){
		// 	$this->crud->create('tb_ipaddress',$data);
		// 	echo '<script>alert("Berhasil ditambahkan")</script>';
		// 	redirect('ipaddress','refresh');
		// }else{
		// 	$this->crud->update('tb_ipaddress',$data,['id'=>$id_ip]);
		// 	echo '<script>alert("Berhasil diupdate")</script>';
		// 	redirect('ipaddress','refresh');
		// }
	}

	public function hapus($id){
		$this->crud->delete('tb_ipaddress',['id'=>$id]);
		echo '<script>alert("Berhasil dihapus")</script>';
		redirect('ipaddress','refresh');
	}

	public function subs(){
		echo getcwd();
	}
}
