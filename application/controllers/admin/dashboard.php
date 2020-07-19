<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller{

		var $section = 'Dashboard';
		function __construct(){
			parent::__construct();
			if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='admin'){$url=base_url('admin/login');redirect($url);};
			$this->load->model('model');

		}
		public function index()
		{
			$data = ['content'=>'admin/v_dashboard',
					 'section'=>$this->section,
					 'pending'=>count($this->model->tValidasi()),
					 'invalid'=>count($this->model->tInvalid())
					];
			$this->load->view('template/template', $data);
		}

	}
 ?>