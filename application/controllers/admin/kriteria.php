<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	var $table 		= 'kriteria';
	var $folder 	= 'kriteria/';
	var $section 	= 'Kriteria';

	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='admin'){$url=base_url('admin/login');redirect($url);};
		
		$this->load->model(['model','validation']);
		$this->load->library(['form_validation', 'encrypt']);

	}

	public function index()
	{
		$data = ['content'	=> $this->folder.('view'),
				 'section'	=> $this->section,
				 'tampil'	=> $this->model->get_all($this->table)->result()
				 ];

		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$data = ['content'	=> $this->folder.('post'),
				 'section'	=> $this->section,];

		$this->load->view('template/template', $data);
	}


	public function save()
	{
		// var_dump($_POST);die;
		$post 		= $this->input->post();
		$this->form_validation->set_rules('nisn', 'NISN', 'required|rtrim|is_unique[siswa.nisn]',['required' => 'Form <b>%s</b> tidak boleh kosong','is_unique'	=> '<b>NISN</b> sudah ada.']);
		$validasi 	= $this->form_validation->set_rules($this->validation->val_siswa());
		if($validasi->run()==True){
			$data = [
						'nisn'			=> $post['nisn'],
						'nama_siswa'	=> $post['nama'],
						'jk'			=> $post['jk'],
						'tgl_lahir'		=> $post['tgl'],
						'tempat_lahir'	=> $post['tempat'],
						'alamat'		=> $post['alamat'],
						'wali_siswa'	=> $post['wali'],
						'kelas_siswa'	=> 'X',
						'password'		=> password_hash($post['nisn'], PASSWORD_DEFAULT),
					];
			$this->model->save($this->table, $data);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/siswa/add');
		}else{
			$data = ['content'	=> $this->folder.('post'),
					 'section'	=> $this->section,];
			$this->load->view('template/template', $data);
		}
	}

	public function delete($id=null)
	{
		if(!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encrypt->decode($id);
		$this->model->delete($this->table, 'nisn' , $id);
		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data telah di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/siswa');
	}

	public function edit($id=null)
	{
		if(!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encrypt->decode($id);

		$data = [
					'content'	=> $this->folder.('edit'),
				 	'section'	=> $this->section,
				 	'tampil'	=> $this->model->get_by($this->table, 'nisn', $id)->result()
				];

		$this->load->view('template/template', $data);
	}

	public function update()
	{

		$cek 	= $this->model->get_by($this->table, 'nisn', $this->input->post('oldNISN'))->result_array();
		$jum 	= count($this->model->get_by($this->table, 'nisn', $this->input->post('nisn'))->result_array());
		$id 	= $cek[0]['nisn'];
		$post 	= $this->input->post();
		$nisn 	= $post['nisn'];
		$oldNISN= $post['oldNISN'];


		$this->form_validation->set_rules('nisn', 'NISN', 'required|rtrim',['required' 	=> 'Form <b>%s</b> tidak boleh kosong']);
		$validasi 	= $this->form_validation->set_rules($this->validation->val_siswa());

		if($this->form_validation->run()==true){
			if($nisn==$oldNISN){
				$data = [
						'nisn'			=> $post['nisn'],
						'nama_siswa'	=> $post['nama'],
						'jk'			=> $post['jk'],
						'tgl_lahir'		=> $post['tgl'],
						'tempat_lahir'	=> $post['tempat'],
						'alamat'		=> $post['alamat'],
						'wali_siswa'	=> $post['wali'],
						'kelas_siswa'	=> 'X',
					];
				$this->model->update($this->table, 'nisn', $id, $data);
				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di Ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/siswa');
			}else{
				if($jum==0){
					$data = [
						'nisn'			=> $post['nisn'],
						'nama_siswa'	=> $post['nama'],
						'jk'			=> $post['jk'],
						'tgl_lahir'		=> $post['tgl'],
						'tempat_lahir'	=> $post['tempat'],
						'alamat'		=> $post['alamat'],
						'wali_siswa'	=> $post['wali'],
						'kelas_siswa'	=> 'X',
					];
					$this->model->update($this->table, 'nisn', $id, $data);
					$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di Ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('admin/siswa');
				}else{
					$data = [
							'content'	=> $this->folder.('edit'),
						 	'section'	=> $this->section,
						 	'tampil'	=> $this->model->get_by($this->table, 'nisn', $id)->result()
							];
					$this->session->set_flashdata('flash','<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Gagal!</b> NISN sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					$this->load->view('template/template', $data);
				}
			}

		}else{
			$data = [
					'content'	=> $this->folder.('edit'),
				 	'section'	=> $this->section,
				 	'tampil'	=> $this->model->get_by($this->table, 'nisn', $id)->result()
					];
			$this->load->view('template/template', $data);

		}
	}

}

/* End of file kriteria.php */
/* Location: ./application/controllers/admin/kriteria.php */