<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->view('welcome_message');
		$this->load->library('ftp');
		$config['hostname'] = '10.0.12.131';
		$config['username'] = 'root';
		$config['password'] = '123456';
		$config['debug'] = TRUE;

		$this->ftp->connect($config);

		$this->ftp->upload(base_url().'assets/images/run.png', '/var/www/html/run.png', 'ascii', 0775);

		$this->ftp->close();
	}
}
