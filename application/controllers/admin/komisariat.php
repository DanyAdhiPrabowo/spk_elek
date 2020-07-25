<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komisariat extends CI_Controller {

	var $table	 = 'komisariat';
	var $folder	 = 'komisariat/';
	var $section = 'Komisariat';


	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='admin'){$url=base_url('admin/login');redirect($url);};
		
		$this->load->model(['model','validation']);
		$this->load->library(['form_validation','encryption']);
	}

	public function index(){
		$data = ['content'	=> $this->folder.('view'),
				 'section'	=> $this->section,
				 'pending'  => count($this->model->tValidasi()),
				 'invalid'  => count($this->model->tInvalid()),
				 'tampil'	=> $this->model->get_all($this->table)->result()
				];
		$this->load->view('template/template', $data);
	}

	public function add(){
		$data = ['content'		=> $this->folder.('post'),
				 'section'		=> $this->section,
				 'pending'		=> count($this->model->tValidasi()),
				 'invalid'		=> count($this->model->tInvalid()),
				];

		$this->load->view('template/template', $data);
	}

	public function save(){
		$post 			= $this->input->post();
		$kodeKomisariat	= $post['kodeKomisariat'];

		$validasi 	= $this->form_validation->set_rules($this->validation->val_komisariat());
		if($validasi->run()==True){
			$cek 	= count($this->model->get_by($this->table, 'kodeKomisariat',$kodeKomisariat)->result());
			if($cek==0){
				$data = [
						'kodeKomisariat'	=> $kodeKomisariat,
						'namaKomisariat'	=> $post['namaKomisariat'],
						'alamatKomisariat'	=> $post['alamatKomisariat'],
						'handphone'			=> $post['handphone'],
						'username'			=> $kodeKomisariat,
						'password'			=> password_hash($kodeKomisariat, PASSWORD_DEFAULT),
						'status'			=> 1
						];
				$this->model->save($this->table, $data);

				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/komisariat/add');

			}else{
				$this->session->set_flashdata('flash',"<div class='alert alert-danger alert-dismissible fade show' role='alert'><b>Gagal!</b> Komisariat sudah terdaftar.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				$data = ['content'		=> $this->folder.('post'),
						 'section'		=> $this->section,
						 'pending'		=> count($this->model->tValidasi()),
				 		 'invalid'		=> count($this->model->tInvalid()),
						];
					$this->load->view('template/template', $data);
			}
		}else{
			$this->session->set_flashdata('flash',"<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data gagal disimpan!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			$data = ['content'		=> $this->folder.('post'),
					 'section'		=> $this->section,
					 'pending'		=> count($this->model->tValidasi()),
				 	 'invalid'		=> count($this->model->tInvalid()),
					];
			$this->load->view('template/template', $data);
		}
	}

	public function edit($id=null){
		if(!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);

		$data = [
					'content'	=> $this->folder.('edit'),
				 	'section'	=> $this->section,
				 	'pending'	=> count($this->model->tValidasi()),
				 	'invalid'	=> count($this->model->tInvalid()),
				 	'tampil'	=> $this->model->get_by($this->table, 'kodeKomisariat', $id)->result(),
				];

		$this->load->view('template/template', $data);
	}

	public function update(){
		$post 				= $this->input->post();
		$id 				= $this->encryption->decrypt(str_replace(['-','_','~'],['=','+','/'],$post['id']));
		$kodeKomisariat		= $post['kodeKomisariat'];

		$validasi 	= $this->form_validation->set_rules($this->validation->val_komisariat());
		if($validasi->run()==true){
			
			$data = [
					'namaKomisariat'	=> $post['namaKomisariat'],
					'alamatKomisariat'	=> $post['alamatKomisariat'],
					'handphone'			=> $post['handphone'],
					];
			$this->model->update($this->table, 'kodeKomisariat', $id, $data);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di Ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/komisariat');
		}else{
			$data = [
						'content'	=> $this->folder.('edit'),
					 	'section'	=> $this->section,
					 	'pending'	=> count($this->model->tValidasi()),
				 		'invalid'	=> count($this->model->tInvalid()),
					 	'tampil'	=> $this->model->get_by($this->table, 'kodeKomisariat', $id)->result(),
					];
			$this->load->view('template/template', $data);

		}
	}


	public function delete($id=null){
		if(!isset($id)) show_404();
		$id = $this->encryption->decrypt(str_replace(['-','_','~'],['=','+','/'],$id));
		$this->model->delete($this->table, 'kodeKomisariat' , $id);
		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data telah di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/komisariat');
	}

}

/* End of file komisariat.php */
/* Location: ./application/controllers/admin/komisariat.php */