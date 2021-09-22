<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipblock extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sess = $this->session->userdata('user');
		if(!$sess){
			redirect(base_url('login'));
		}	
	}

	public function index(){
		$sess = $this->session->userdata('user');
		$data['node']=$this->crud->read('tb_node')->result_array();
		if($sess['level'] == 'admin'){
			$data['sess'] = $sess;
			$data['ipblocks'] = $this->crud->read('tb_ipblok')->result_array();
			$this->load->view('header');
			$this->load->view('V_index',$data);
			$this->load->view('footer');
		}else{
			redirect(base_url('dashboard'));
		}
	}

	public function simpan(){
		$id_block = $this->input->post('id');
		$data = [
			'name' => $this->input->post('name'),
			'gateway' => $this->input->post('gateway'),
			'broadcast' => $this->input->post('broadcast'),
			'prefix' => $this->input->post('prefix'),
			'id_node' => $this->input->post('node')
		];
		if($id_block == ""){
			$this->crud->create('tb_ipblok',$data);
			echo '<script>alert("Berhasil ditambahkan")</script>';
			redirect('ipblock','refresh');
		}else{
			$this->crud->update('tb_ipblok',$data,['id'=>$id_block]);
			echo '<script>alert("Berhasil diupdate")</script>';
			redirect('ipblock','refresh');
		}
	}

	public function hapus($id){
		$this->crud->delete('tb_ipblok',['id'=>$id]);
		echo '<script>alert("Berhasil dihapus")</script>';
		redirect('ipblock','refresh');
	}

	public function subs(){
		echo getcwd();
	}
}
