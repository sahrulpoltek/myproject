<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nodeserver extends CI_Controller {

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
			$data['nodeserver'] = $this->crud->read('tb_node')->result_array();
			$this->load->view('header');
			$this->load->view('V_index',$data);
			$this->load->view('footer');
		}else{
			redirect(base_url('dashboard'));
			// $this->load->view('header_user');
			// $this->load->view('V_index_user');
			// $this->load->view('footer_user');
		}
	}

	public function simpan(){
		$id_node = $this->input->post('id');
		$data = [
			'nama_node' => $this->input->post('name'),
			'password' => $this->input->post('password'),
			'ip_address' => $this->input->post('ip'),
			'os' => $this->input->post('os'),
			'memory' => $this->input->post('memory'),
			'disk' => $this->input->post('disk')			
		];
		// print_r($data);die;
		if($id_node == ""){
			$this->crud->create('tb_node',$data);
			echo '<script>alert("Berhasil ditambahkan")</script>';
			redirect('nodeserver','refresh');
		}else{
			$this->crud->update('tb_node',$data,['id'=>$id_node]);
			echo '<script>alert("Berhasil diupdate")</script>';
			redirect('nodeserver','refresh');
		}
	}

	public function hapus($id){
		$this->crud->delete('tb_node',['id'=>$id]);
		echo '<script>alert("Berhasil dihapus")</script>';
		redirect('nodeserver','refresh');
	}

	public function subs(){
		echo getcwd();
	}
}
