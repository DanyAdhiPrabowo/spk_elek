<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


Class Login extends CI_Controller{


	var $table 		= 'admin';
	var $section 	= 'Login';
	var $i 			= 'admin/';

	function __construct()
		{
			parent::__construct();
			if($this->session->userdata('masuk')==TRUE && $this->session->userdata('access')=='admin'){ $url=base_url('admin/dashboard');redirect($url); };
			if($this->session->userdata('masuk')==TRUE && $this->session->userdata('access')=='user'){ $url=base_url('user');redirect($url); };

			$this->load->model('model');
			$this->load->model('validation', 'val');
			$this->load->library('form_validation');

		}

		public function index()
		{			
			$this->load->view('admin/v_login');
		}
	
		public function auth()
		{

			$post 	= $this->input->post();
			$user 	= $post['username'];
			$pass	= $post['password'];
			$cek 	= $this->model->get_by($this->table, 'username' ,$user)->row_array();
			$validasi = $this->form_validation->set_rules($this->val->val_login());
			if($validasi->run()==false)
			{
				$this->load->view('admin/v_login');
			}else{
				if($cek){
					if(password_verify($pass, $cek['password'])){
						$data = [
							'masuk'		=> true,
							'access'	=> 'admin',
							'username'	=> $cek['username'],
							];
						$this->session->set_userdata($data);
						redirect('admin/dashboard');
					}else{
						
						$this->session->set_flashdata('flash','<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' );
				$this->load->view('admin/v_login');

					}
				}else{
					$this->session->set_flashdata('flash','<div class="alert alert-danger alert-dismissible fade show" role="alert">username belum terdaftar.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' );
				$this->load->view('admin/v_login');

				}
			};
		}

}



 ?>