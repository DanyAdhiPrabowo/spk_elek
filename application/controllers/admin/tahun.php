<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun extends CI_Controller {

	var $table 		= 'tahun';
	var $folder 	= 'tahun/';
	var $section 	= 'tahun';


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
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->get_all($this->table)->result()
				];
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$tahun 		= $this->input->post('tahun');
		$validasi 	= $this->form_validation->set_rules('tahun','Tahun', 'required|rtrim');

		if($validasi->run()==true){
			$cek 	= count($this->model->get_by($this->table, 'tahun', $tahun)->result());
				if($cek<1){
					$data = [
								'tahun'		=> $tahun,
								'status'	=> 0
							];
					$this->model->save($this->table, $data);
					redirect('admin/tahun');	
				}else{
					$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data gagal di simpan! Tahun Seleksi Sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('admin/tahun');
				}
		}else{
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data gagal di simpan! Form tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/tahun');
		}
	}


	public function delete($tahun=null)
	{
		if(!isset($tahun)) show_404();
		$tahun = $this->encrypt->decode(str_replace(['-','_','~'],['=','+','/'],$tahun));
		$this->model->delete($this->table, 'tahun' , $tahun);
		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data telah di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/tahun');
	}

	public function edit()
	{
		$post 		= $this->input->post();
		$oldTahun	= $post['oldTahun'];
		$tahun 		= $post['tahunEdit'];
		$validasi	= $this->form_validation->set_rules('tahunEdit', 'Tahun', "required|rtrim");

		if($validasi->run()==true){
			$cek = count($this->model->get_by($this->table, 'tahun', $tahun)->result());
				if($cek<1){
					$data = ['tahun'=> $tahun];
					$this->model->update($this->table, 'tahun', $oldTahun, $data);
					$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('admin/tahun');
				}else{
					$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Tahun Seleksi</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('admin/tahun');
				}
		}else{
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Tahun Seleksi</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/tahun');
		}
	}


	public function updateStatus($tahun=null)
	{
		if(!isset($tahun)) show_404();
		$tahun = $this->encrypt->decode(str_replace(['-','_','~'],['=','+','/'],$tahun));

		$cekStatus = $this->model->get_by($this->table, 'tahun', $tahun)->result_array();

		if($cekStatus[0]['status']==1){
			$data = ['status' => '0'];
			$this->model->update($this->table, 'tahun', $tahun, $data );
			redirect('admin/tahun');
		}else{
			$cekSeluruhStatus = count($this->model->get_by($this->table, 'status', '1')->result_array());
			if($cekSeluruhStatus < 1){
				$data = ['status' => '1'];
				$this->model->update($this->table, 'tahun', $tahun, $data );
				redirect('admin/tahun');
			}else{
				$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Tahun Aktif</b> tidak boleh lebih dari satu.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/tahun');
			}
		}
	}


}

/* End of file tahun.php */
/* Location: ./application/controllers/admin/tahun.php */