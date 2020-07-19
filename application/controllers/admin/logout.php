<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {



	public function index()
	{
		$this->session->unset_userdata('masuk');
		$this->session->unset_userdata('access');
		redirect('admin/login');
	}

}

/* End of file logout.php */
/* Location: ./application/controllers/admin/logout.php */