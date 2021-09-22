<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

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
			$data['service'] = $this->crud->read('tb_service')->result_array();
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
		$id_service= $this->input->post('id');
		$data = [
			'name' => $this->input->post('nama'),
			'value' => $this-> input->post('value')
		];
		if($id_service== ""){
			$this->crud->create('tb_service', $data);
			echo '<script>alert("Service berhasil ditambah")</script>';
			redirect('service', 'refresh');
		}else{
			$this->crud->update('tb_service', $data, ['id'=>$id_service]);
			echo '<script>alert("Service berhasil diupdate")</script>';
			redirect('service','refresh');
		}
	}
	public function hapus($id){
		$this->crud->delete('tb_service',['id'=>$id]);
		echo '<script>alert("Service berhasil dihapus")</script>';
		redirect('service','refresh');
	}
}