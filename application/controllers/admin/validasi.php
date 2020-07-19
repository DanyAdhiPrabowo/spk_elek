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
		$this->load->library(['form_validation', 'encrypt']);

	}

	public function index()
	{
		$data = ['content'	=> $this->folder.('Pending'),
				 'section'	=> 'Pending',
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->tValidasi()
				 ];
		$this->load->view('template/template', $data);
	}

	public function invalid()
	{
		$data = ['content'	=> $this->folder.('invalid'),
				 'section'	=> 'Invalid',
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->tInvalid()
				 ];
		$this->load->view('template/template', $data);
	}

	public function valid()
	{
		$data = ['content'	=> $this->folder.('valid'),
				 'section'	=> 'Valid',
				 'pending'	=> count($this->model->tValidasi()),
				 'invalid'	=> count($this->model->tInvalid()),
				 'tampil'	=> $this->model->tValid()
				 ];
		$this->load->view('template/template', $data);
	}



	public function invalidStatus($id=null)
	{
		if(!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encrypt->decode($id);
		$data= ['statusValidasi'=>1];
		$this->model->update($this->table, 'idValidasi', $id, $data);

		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data dirubah ke status tidak valid.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/validasi');
	}

	public function validStatus($id=null)
	{
		if(!isset($id)) show_404();
		$id 			= str_replace(['-','_','~'],['=','+','/'],$id);
		$id 			= $this->encrypt->decode($id);
		$npm 			= $this->uri->segment(5);
		$tahunSeleksi 	= $this->uri->segment(6);
		$data 	= ['statusValidasi'=>2];
		$this->model->update($this->table, 'idValidasi', $id, $data);

		// ambil tahun angkatan dari npm
		$angkatan = $this->model->get_by('peserta', 'npm', $npm)->result_array();

		// Cek Jabaran
		$validasi   = $this->model->get_by('validasi', 'idValidasi', $id)->result_array();
		// cek sudah ada npm & tahun angkatan belum? di table matrik
		$cekRecord = count($this->model->get_by2('matrik', 'npm', $npm, 'tahunSeleksi', $tahunSeleksi )->result_array());
		// Kalo kosong, lakukan insert baru
		if($cekRecord==0){
			$data = [
						'idMatrik' 		=> null,
						'npm'			=> $npm,
						'angkatan'		=> $angkatan[0]['angkatan'],
						'tahunSeleksi'	=> $tahunSeleksi,
						'ketua'			=> 0,
						'sekertaris'	=> 0,
						'bendahara'		=> 0,
						'co'			=> 0,
						'anggota'		=> 0,
					];
			$this->model->save('matrik', $data);


			// Cari tahu Jabatan
			$jabatan 	= $validasi[0]['jabatan'];
			
			// isi table matrik sesuai jabatan
			if($jabatan==1){
				$hasil 	= $jumlah[0]['ketua']+1;
				$dati 	= ['ketua'=> $hasil];
			}elseif ($jabatan==2) {
				$hasil 	= $jumlah[0]['sekertaris']+1;
				$dati 	= ['sekertaris'=> $hasil];
			}elseif ($jabatan==3) {
				$hasil 	= $jumlah[0]['bendahara']+1;
				$dati 	= ['bendahara'=> $hasil];
			}elseif ($jabatan==4) {
				$hasil 	= $jumlah[0]['co']+1;
				$dati 	= ['co'=> $hasil];
			}else{
				$hasil 	= $jumlah[0]['anggota']+1;
				$dati 	= ['anggota'=> $hasil];
			}	
			$this->model->update('matrik', 'npm', $npm, $dati);

			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data dirubah ke status Valid.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/validasi');
		}

		// kalo ada, lakukan update data.
		else{

			// cari tahu jabatannya apa 
			$jabatan 	= $validasi[0]['jabatan'];
			$jumlah = $this->model->get_by2('matrik', 'npm', $npm, 'tahunSeleksi', $tahunSeleksi)->result_array();
			// update data matrik
			if($jabatan==1){
				$hasil 	= $jumlah[0]['ketua']+1;
				$dati 	= ['ketua'=> $hasil];
			}elseif ($jabatan==2) {
				$hasil 	= $jumlah[0]['sekertaris']+1;
				$dati 	= ['sekertaris'=> $hasil];
			}elseif ($jabatan==3) {
				$hasil 	= $jumlah[0]['bendahara']+1;
				$dati 	= ['bendahara'=> $hasil];
			}elseif ($jabatan==4) {
				$hasil 	= $jumlah[0]['co']+1;
				$dati 	= ['co'=> $hasil];
			}else{
				$hasil 	= $jumlah[0]['anggota']+1;
				$dati 	= ['anggota'=> $hasil];
			}	
			$this->model->update2('matrik', 'npm', $npm, 'tahunSeleksi',$tahunSeleksi , $dati);

			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data dirubah ke status Valid.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/validasi');


		}
	}


	
	

	

}

/* End of file validasi.php */
/* Location: ./application/controllers/admin/validasi.php */