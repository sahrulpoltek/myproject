<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$sess = $this->session->userdata('user');
		if($sess){
			redirect(base_url('dashboard'));
		}
	}

	public function index()
	{
		$submit = $this->input->post('submit');
		$data['error'] = '';
		
		if($submit){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			// $password = md5($this->input->post('password'));
			$cek = $this->crud->read('tb_akun', ['email' => $username, 'password' => md5($password)]);
			if($cek->num_rows()>0){
				$result = $cek->result()[0];
				if($result->status == 0){
					$data['error'] = 'Akun belum aktif';
					$this->load->view('login', $data);
				}else{
					$sess_array = array('username'=>$result->email, 'name'=>$result->nama, 'level'=>$result->level);
					$this->session->set_userdata('user', $sess_array);
					redirect(base_url());
				}
			}else{
				$data['error'] = '<br><b>Email atau password salah</b>';
				$this->load->view('login', $data);
			}
		}else{
			$data['error'] = '';
			$this->load->view('login', $data);
		}
	}

	public function registration(){
		$regis = $this->input->post('submit');
		$data['error'] = '';

		if($regis){
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$induk = $this->input->post('no_induk'); 
			$type = $this->input->post('user_type');
			$pass = $this->input->post('password');
			$cek = $this->crud->read('tb_akun', ['email' => $email]);
			if($cek->num_rows()>0){
				$data['error'] = 'Email telah terdaftar';
				$this->load->view('register', $data);
			}else{
				$this->crud->create('tb_akun',['nama' => $nama, 'email' => $email, 'no_induk'=> $induk, 'user_type'=>$type, 'password'=>md5($pass), 'pswrd'=>$pass, 'level'=>'user', 'status'=>0, 'created'=>date('d-m-Y')]);
				$data['error'] = 'Cek email untuk mengaktifkan akun';
				$this->load->view('register', $data);
			}
		}else{
			$data['error'] = '';
			$this->load->view('register',$data);
		}
	}

	public function forgot(){
		$forgot = $this->input->post('submit');
		$data['error'] = '';

		if($forgot){
			$email = $this->input->post('email');
			$cek = $this->crud->read('tb_akun', ['email' => $email]);
			if($cek->num_rows()>0){
				$this->_sendEmail($email);
				$data['error'] = 'Cek email anda';
				$this->load->view('forgot', $data);
			}else{
				$data['error'] = 'Email anda tidak terdaftar, silahkan mendaftar terlebih dahuluh.';
				$this->load->view('forgot', $data);
			}
		}else{
			$data['error'] = '';
			$this->load->view('forgot',$data);
		}
	}
// 'smtp_pass' => 'kasa12345',
	private function _sendEmail($email)
    {
        $config = [
            'protocol' => 'smtp',
            'useragent' => 'Codeigniter',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'panraki@poliupg.ac.id',
            'smtp_pass' => 'adminpanraki',
            'smtp_port' => 465,
            'smtp_timeout' => 5,
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'wordwrap' => TRUE,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from($config['smtp_user'],'Kasa App');
        $this->email->to($email);

		$this->email->subject(' Web Management VPS, Verify Your Account..');
		$this->email->message('Klik link ini untuk membuat password baru : 
			<a href="' . base_url() . 'login/newpass?email=' . base64_encode($email).'">New Passsword</a>');

        if ($this->email->send()){
            return true;
        }else{
            echo $this->email->print_debugger();
            die;
        }
	}
	
	public function newpass(){
		$email = base64_decode($this->input->get('email'));
		$cek = $this->crud->read('tb_akun',['email' => $email]);
        if($cek->num_rows() > 0){
			$data['error'] = '';
			$data['email'] = $email;
			$this->load->view('newpass',$data);
        }else{
			$data['error'] = 'Email tidak terdaftar';
			$data['email'] = '';
			$this->load->view('forgot', $data);
        }
	}

	public function updatenewpass(){
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		$cek = $this->crud->read('tb_akun',['email' => $email]);
		if($cek->num_rows() > 0){
			$this->crud->update('tb_akun',['password' => md5($pass), 'pswrd'=>$pass],['email'=>$email]);
			$data['error'] = 'Berhasil ganti password';
			$this->load->view('login',$data);
		}else{
			$data['error'] = 'Email tidak terdaftar';
			$this->load->view('login', $data);
		}
	}
}
