<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sess = $this->session->userdata('user');
		if(!$sess){
			redirect(base_url('login'));
		}	
	}

	public function index(){
		$vmid = $this->input->get('vmid');
		$sess = $this->session->userdata('user');
		$data['sess'] = $sess;
		$data['vmid'] = $vmid;
		if($sess['level'] == 'admin'){
			$this->load->view('header');
			$this->load->view('V_index',$data);
			$this->load->view('footer');
		}else{
			$this->load->view('header_user');
			$this->load->view('V_index',$data);
			$this->load->view('footer_user');
		}
	}

	public function subs(){
		echo getcwd();
	}
}
