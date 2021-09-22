<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->session->unset_userdata('user');
		redirect(base_url(), 'login');
	}
    

	public function setuju($id){
		$email = $this->crud->read('tb_akun',['id' => $id])->row_array()['email'];
		if($email){
            $this->_sendEmail($email,'verify');
            echo "<script>
            alert('Berhasil disetujui');
            window.location.href='". base_url('users')."';
            </script>";
            // echo '<script>alert("Berhasil")</script>';
            // redirect('users');
		}else{
            echo '<script>alert("Gagal")</script>';
			redirect('dashboard');
		}
	}

	public function verify(){
        $email = $this->input->get('email');
        $cek = $this->crud->read('tb_akun',['email' => $email]);
        if($cek->num_rows() > 0){
            $blum = $cek->result()[0]->status;
            if($blum == 0){
                $this->crud->update('tb_akun',['status'=>1],['email' => $email]);
                echo '<h1 style="color:green;text-align:center">Akun berhasil diaktifkan</h1>';
                echo '<div style="text-align:center;"><a style="color:blue;" href="'.base_url().'">Login</a></div>';
            }else{
                echo '<h1 style="color:red;text-align:center">Akun telah aktif</h1>';
                echo '<div style="text-align:center;"><a href="'.base_url().'" style="color:blue;">Login</a></div>';
            }
        }else{
            echo '<h1 style="color:red;text-align:center">Email tidak terdaftar</h1>';
            echo '<div style="text-align:center;"><a style="color:blue;" href="'.base_url().'">Login</a></div>';
        }
	}

	private function _sendEmail($email,$type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'panraki@poliupg.ac.id',
            'smtp_pass' => 'adminpanraki',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('panraki@poliupg.ac.id','Registrasi');
        $this->email->to($email);
        // $this->email->to('nurfadli231298@gmail.com'); //untuk tes saja

        if ($type == 'verify'){
            $this->email->subject('Web Management VPS, Verify Your Account..');
            $this->email->message('Klik link ini untuk mengaktifkan akun anda : 
                <a href="' . base_url() . 'auth/verify?email=' . $email.'">Activate</a>');
        }elseif ($type == 'forgot'){
            $this->email->subject('Forgot Password');
            $this->email->message('
            Yth. user,<br><br>

            Kami telah membuatkan password baru kepada anda.<br>
            Silahkan ubah password anda setelah login.<br><br>

            Password baru '.$token.'<br><br>

            Terima Kasih
            ');
        }

        if ($this->email->send()){
            return true;
        }else{
            echo $this->email->print_debugger();
            die;
        }
    }
}
