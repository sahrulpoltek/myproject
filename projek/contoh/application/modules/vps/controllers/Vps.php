<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vps extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sess = $this->session->userdata('user');
		if(!$sess){
			redirect(base_url('login'));
		}	
	}

	public function index(){
		$sess = $this->session->userdata('user');
		if($sess['level'] == 'admin'){
			$data['sess'] = $sess;
			$data['allvps'] = $this->crud->read('tb_vps')->result_array();
			$data['templates'] = $this->crud->read('tb_template')->result_array();
			$data['ip_address'] = $this->crud->read('tb_ipaddress')->result_array();
			$this->load->view('header');
			$this->load->view('V_index',$data);
			$this->load->view('footer');
		}else{
			redirect(base_url('dashboard'));
		}
	}

	public function simpan(){
		$id_vps = $this->input->post('id');
		$data = [
			'name' => $this->input->post('name'),
			'os' => $this->input->post('os'),
			'vm_pass' => $this->input->post('password'),
			'vcore' => $this->input->post('core'),
			'memory' => $this->input->post('memory'),
			'disk' => $this->input->post('disk')
		];
		if($id_vps == ""){
			$this->crud->create('vps',$data);
			echo '<script>alert("Berhasil ditambahkan")</script>';
			redirect('vps','refresh');
		}else{
			$this->crud->update('vps',$data,['id_vps'=>$id_vps]);
			echo '<script>alert("Berhasil diupdate")</script>';
			redirect('vps','refresh');
		}
	}

	public function hapus($id){
		$this->crud->delete('vps',['id_vps'=>$id]);
		echo '<script>alert("Berhasil dihapus")</script>';
		redirect('vps','refresh');
	}

	public function subs(){
		echo getcwd();
	}
}
