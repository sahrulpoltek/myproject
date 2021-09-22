<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			$this->load->view('header');
			$this->load->view('V_index');
			$this->load->view('footer');
		}else{
			$id = $this->crud->read('tb_akun',['email'=>$sess['username']])->result_array()[0]['id'];
			$nm['nma']= $this->crud->read('tb_akun',['id'=>$id])->row_array();//utk tmplkn nm dheader user	
			$this->load->view('header_user',$nm);
			$this->load->view('V_index_user');
			$this->load->view('footer_user');
		}
	}

	public function subs(){
		echo getcwd();
	}
}
