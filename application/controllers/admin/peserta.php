<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

	var $table 		= 'peserta';
	var $folder 	= 'peserta/';
	var $section 	= 'Peserta';


	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='admin'){$url=base_url('admin/login');redirect($url);};
		$this->load->model(['model','validation']);
		$this->load->library(['form_validation', 'encryption']);

	}

	public function index()
	{
		$data = ['content'	=> $this->folder.('view'),
				 'section'	=> $this->section,
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->get_all($this->table)->result()
				 ];

		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$data = ['content'		=> $this->folder.('post'),
				 'section'		=> $this->section,
				 'pending'		=> count($this->model->tValidasi()),
				 'invalid'		=> count($this->model->tInvalid()),
				 'komisariat'	=> $this->model->get_all('komisariat')->result()];

		$this->load->view('template/template', $data);
	}


	public function save()
	{
		$post 		= $this->input->post();
		$npm 		= $post['npm'];

		$validasi 	= $this->form_validation->set_rules($this->validation->val_peserta());
		if($validasi->run()==True){
			$cek 	= count($this->model->get_by($this->table, 'npm',$npm)->result());
			if($cek==0){
				$data = [
						'angkatan'		=> $post['angkatan'],
						'npm'			=> $npm,
						'nama'			=> $post['nama'],
						'jk'			=> $post['jk'],
						'tanggalLahir'	=> $post['tgl'],
						'tempatLahir'	=> $post['tempat'],
						'alamat'		=> $post['alamat'],
						'noHP'			=> $post['hp'],
						'komisariat'	=> $post['komisariat'],
						'username'		=> $npm.$tahun,
						'password'		=> password_hash($npm, PASSWORD_DEFAULT),
						'status'		=> 1
						];
				$this->model->save($this->table, $data);

				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/peserta/add');

			}else{
				$this->session->set_flashdata('flash',"<div class='alert alert-danger alert-dismissible fade show' role='alert'><b>Gagal!</b> Peserta sudah terdaftar.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				$data = ['content'		=> $this->folder.('post'),
						 'section'		=> $this->section,
						 'pending'		=> count($this->model->tValidasi()),
				 		 'invalid'		=> count($this->model->tInvalid()),
						 'komisariat'	=> $this->model->get_all('komisariat')->result()];
					$this->load->view('template/template', $data);
			}
		}else{
			$this->session->set_flashdata('flash',"<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data gagal disimpan!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			$data = ['content'		=> $this->folder.('post'),
					 'section'		=> $this->section,
					 'pending'		=> count($this->model->tValidasi()),
				 	 'invalid'		=> count($this->model->tInvalid()),
					 'komisariat'	=> $this->model->get_all('komisariat')->result()];
			$this->load->view('template/template', $data);
		}
	}

	public function delete($id=null)
	{
		if(!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);
		$this->model->delete($this->table, 'npm' , $id);
		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data telah di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/peserta');
	}

	public function edit($id=null)
	{
		if(!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);

		$data = [
					'content'	=> $this->folder.('edit'),
				 	'section'	=> $this->section,
				 	'pending'	=> count($this->model->tValidasi()),
				 	'invalid'	=> count($this->model->tInvalid()),
				 	'tampil'	=> $this->model->get_by($this->table, 'npm', $id)->result(),
				 	'komisariat'=> $this->model->get_all('komisariat')->result()
				];

		$this->load->view('template/template', $data);
	}

	public function update()
	{
		$post 		= $this->input->post();
		$id 		= $this->encryption->decrypt(str_replace(['-','_','~'],['=','+','/'],$post['id']));
		$npm		= $post['npm'];
		$oldNpm		= $post['oldNpm'];


		$validasi 	= $this->form_validation->set_rules($this->validation->val_peserta());

		if($validasi->run()==true){
		
			$data = [
					'nama'			=> $post['nama'],
					'jk'			=> $post['jk'],
					'tanggalLahir'	=> $post['tgl'],
					'tempatLahir'	=> $post['tempat'],
					'alamat'		=> $post['alamat'],
					'noHP'			=> $post['hp'],
					'komisariat'	=> $post['komisariat'],
					];
			$this->model->update($this->table, 'npm', $id, $data);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di Ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/peserta');
		}else{
			$data = [
						'content'	=> $this->folder.('edit'),
					 	'section'	=> $this->section,
					 	'pending'	=> count($this->model->tValidasi()),
				 		'invalid'	=> count($this->model->tInvalid()),
					 	'tampil'	=> $this->model->get_by($this->table, 'npm', $id)->result(),
					 	'komisariat'=> $this->model->get_all('komisariat')->result()
					];
			$this->load->view('template/template', $data);

		}
	}

	public function reset($id)
	{
		$id		= $this->encryption->decrypt(str_replace(['-','_','~'],['=','+','/'],$id));
		$cek   	= $this->model->get_by($this->table, 'npm', $id)->result_array();

		$data = ['password'=> password_hash($cek[0]['npm'], PASSWORD_DEFAULT) ];

		$this->model->update($this->table, 'npm', $id, $data);
		$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password berhasil direset.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/peserta');

	}

}

/* End of file peserta.php */
/* Location: ./application/controllers/admin/peserta.php */