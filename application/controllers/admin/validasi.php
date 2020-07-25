<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

	var $table 		= 'validasi';
	var $folder 	= 'validasi/';
	var $section 	= 'Validasi Data';

	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='admin'){$url=base_url('admin/login');redirect($url);};
		$this->load->model(['model','validation']);
		$this->load->library(['form_validation', 'encryption']);

	}

	public function index(){
		$data = ['content'	=> $this->folder.('Pending'),
				 'section'	=> 'Pending',
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->tValidasi()
				 ];
		$this->load->view('template/template', $data);
	}

	public function invalid(){
		$data = ['content'	=> $this->folder.('invalid'),
				 'section'	=> 'Invalid',
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->tInvalid()
				 ];
		$this->load->view('template/template', $data);
	}

	public function valid(){
		$data = ['content'	=> $this->folder.('valid'),
				 'section'	=> 'Valid',
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->tValid()
				 ];
		$this->load->view('template/template', $data);
	}



	public function invalidStatus($id=null){
		if(!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);
		$data= ['statusValidasi'=>1];
		$this->model->update($this->table, 'idValidasi', $id, $data);

		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data dirubah ke status tidak valid.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/validasi');
	}

	public function validStatus($id=null){
		if(!isset($id)) show_404();
		$id 			= str_replace(['-','_','~'],['=','+','/'],$id);
		$id 			= $this->encryption->decrypt($id);
		$kodeKomisariat	= $this->uri->segment(5);
		$tahunSeleksi 	= $this->uri->segment(6);
		$data 	= ['statusValidasi'=>2];
		$this->model->update($this->table, 'idValidasi', $id, $data);

		// Cek tingkatan
		$validasi   = $this->model->get_by('validasi', 'idValidasi', $id)->result_array();
		// cek sudah ada npm & tahun angkatan belum? di table matrik
		$cekRecord = count($this->model->get_by2('matrik', 'kodeKomisariat', $kodeKomisariat, 'tahunSeleksi', $tahunSeleksi )->result_array());
		// Kalo kosong, lakukan insert baru
		if($cekRecord==0){
			$data = [
				'idMatrik' 			=> null,
				'kodeKomisariat'	=> $kodeKomisariat,
				'tahunSeleksi'		=> $tahunSeleksi,
				'nasional'			=> 0,
				'provinsi'			=> 0,
				'kabupatenKota'		=> 0,
				'universitas'		=> 0,
				'fakultas'			=> 0,
			];
			$this->model->save('matrik', $data);
			
			
			// Cari tahu tingkatan
			$tingkatan 	= $validasi[0]['tingkatan'];
		
			// isi table matrik sesuai tingkatan
			if($tingkatan==1){
				$dati 	= ['nasional'=> 1];
			}elseif ($tingkatan==2) {
				$dati 	= ['sekertaris'=> 1];
			}elseif ($tingkatan==3) {
				$dati 	= ['bendahara'=> 1];
			}elseif ($tingkatan==4) {
				$dati 	= ['co'=> 1];
			}else{
				$dati 	= ['anggota'=> 1];
			}	
			$this->model->update2('matrik', 'kodeKomisariat', $kodeKomisariat, "tahunSeleksi", $tahunSeleksi, $dati);

			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data dirubah ke status Valid.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/validasi');
		}

		// kalo ada, lakukan update data.
		else{

			// cari tahu jabatannya apa 
			$tingkatan 	= $validasi[0]['tingkatan'];
			$jumlah = $this->model->get_by2('matrik', 'kodeKomisariat', $kodeKomisariat, 'tahunSeleksi', $tahunSeleksi)->result_array();
			// update data matrik
			if($tingkatan==1){
				$hasil 	= $jumlah[0]['nasional']+1;
				$dati 	= ['nasional'=> $hasil];
			}elseif ($tingkatan==2) {
				$hasil 	= $jumlah[0]['provinsi']+1;
				$dati 	= ['provinsi'=> $hasil];
			}elseif ($tingkatan==3) {
				$hasil 	= $jumlah[0]['kabupatenKota']+1;
				$dati 	= ['kabupatenKota'=> $hasil];
			}elseif ($tingkatan==4) {
				$hasil 	= $jumlah[0]['universitas']+1;
				$dati 	= ['universitas'=> $hasil];
			}else{
				$hasil 	= $jumlah[0]['fakultas']+1;
				$dati 	= ['fakultas'=> $hasil];
			}	
			$this->model->update2('matrik', 'kodeKomisariat', $kodeKomisariat, 'tahunSeleksi',$tahunSeleksi , $dati);

			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data dirubah ke status Valid.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/validasi');


		}
	}

}

/* End of file validasi.php */
/* Location: ./application/controllers/admin/validasi.php */