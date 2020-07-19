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
		$this->load->library(['form_validation','encrypt']);
	}

	public function index()
	{
		$data = ['content'	=> $this->folder.('view'),
				 'section'	=> $this->section,
				 'pending'  => count($this->model->tValidasi()),
				 'invalid'  => count($this->model->tInvalid()),
				 'tampil'	=> $this->model->get_all($this->table)->result()
				];
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$nama 	= $this->input->post('nama');
		$validasi = $this->form_validation->set_rules('nama','Nama', 'required|rtrim');

		if($validasi->run()==true){
			$cek 	= count($this->model->get_by($this->table, 'namaKomisariat', $nama)->result());
				if($cek<1){
					$data = [
								'idKomisariat'		=> null,
								'namaKomisariat'	=> $nama
							];
					$this->model->save($this->table, $data);
					redirect('admin/komisariat');	
				}else{
					$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data gagal di simpan! Nama Komisariat Sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('admin/komisariat');
				}
		}else{
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data gagal di simpan! Form tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/komisariat');
		}
	}


	public function delete($id=null)
	{
		if(!isset($id)) show_404();
		$id = $this->encrypt->decode(str_replace(['-','_','~'],['=','+','/'],$id));
		$this->model->delete($this->table, 'idKomisariat' , $id);
		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data telah di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/komisariat');
	}

	public function edit()
	{
		$post 		= $this->input->post();
		$oldNama	= $post['oldNama'];
		$nama 		= $post['namaEdit'];
		$validasi	= $this->form_validation->set_rules('namaEdit', 'Nama', "required|rtrim");

		if($validasi->run()==true){
			$cek = count($this->model->get_by($this->table, 'namaKomisariat', $nama)->result());
				if($cek<1){
					$data = ['namaKomisariat'=> $nama];
					$this->model->update($this->table, 'namaKomisariat', $oldNama, $data);
					$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('admin/komisariat');
				}else{
					$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Nama Komisariat</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('admin/komisariat');
				}
		}else{
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Nama Komisariat</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/komisariat');
		}
	}

}

/* End of file komisariat.php */
/* Location: ./application/controllers/admin/komisariat.php */