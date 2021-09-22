<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
			$data['users'] = $this->crud->read('tb_akun',['level' => 'user'])->result_array();
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
		$id_user = $this->input->post('id');
		$pass= $this->input->post('password');
		$data = [
			'nama' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' =>md5($pass),
			'pswrd'	=> $pass,
			'no_induk' => $this->input->post('userid'),
			'user_type' => $this->input->post('user_type'),
			'level'=>'user',
			'status'=>0, 
			'created'=>date('d-m-Y')
		];
		if($id_user == ""){
			// $data['username'] = $this->input->post('fullname').date("ymdhis");
			$this->crud->create('tb_akun',$data);
			echo '<script>alert("Berhasil ditambahkan")</script>';
			redirect('users','refresh');
		}else{
			$this->crud->update('tb_akun',$data,['id_user'=>$id_user]);
			echo '<script>alert("Berhasil diupdate")</script>';
			redirect('users','refresh');
		}
	}

	public function hapus($id){
		$this->crud->delete('tb_akun',['id'=>$id]);
		echo '<script>alert("Berhasil dihapus")</script>';
		redirect('users','refresh');
	}

	public function subs(){
		echo getcwd();
	}
}
