<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_auth');
	}
	
	public function index() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('login');
		} else {
			$data['page'] 			= "Home";
			$data['judul'] 			= "Login SIMGAJI P3K";
			$data['deskripsi'] 		= "Login SIMGAJI P3K";
			$this->template->views('home', $data);
		}
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$data 	  = $this->M_auth->login($username, $password);
			$status	  = $this->db->query("SELECT cad from config")->row();
			if($data->oto=='01'){
				$nama = $data->nm_user;
			}
			else if($data->oto=='02'){
				$nm		= $this->db->query("select nm_skpd from mskpd where kd_skpd='".$data->kd_skpd."'")->row();
				//var_dump($nm);
				if(!is_null($nm)){
					$nama = $nm->nm_skpd;
					}else{
					$nama = "";
					}
			}else{
			$nama = $data->nm_user;
			}	
			if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.!');
				redirect('Auth');
			} else {
				$session = array(
					'kode'			=> $data->kode,
					'oto'			=> $data->oto,
					'kd_skpd'		=> $data->kd_skpd,
					'nm_skpd'		=> $nama,
					'kd_unit'		=> $data->kd_unit,
					'nm_user'		=> $data->nm_user,
					'email'			=> $data->email_user,
					'username'		=> $data->username,
					'password'		=> $data->password,
					'status' 		=> $status->cad
				);
				
				$this->session->set_userdata($session);
				//redirect('Home');
				$data1['page'] 			= "Home";
				$data1['judul'] 		= "Login SIMGAJI P3K";
				$data1['deskripsi'] 	= "Login SIMGAJI P3K";
				$this->template->views('home', $data1);
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */