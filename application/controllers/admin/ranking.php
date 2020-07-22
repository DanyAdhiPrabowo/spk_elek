<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends CI_Controller {

	var $table 		= 'matrik';
	var $folder 	= 'ranking/';
	var $section 	= 'Ranking';


	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='admin'){$url=base_url('admin/login');redirect($url);};
		$this->load->model(['model','validation']);
		$this->load->library(['form_validation', 'encryption']);

	}

	public function index()
	{
		$tahun 		= $this->input->post('tahun');
		$angkatan 	= $this->input->post('angkatan');
		if($tahun!='' && $angkatan!=''){
			$data = ['content'			=> $this->folder.('view'),
					 'section'			=> $this->section,
					 'pending'			=> count($this->model->tValidasi()),
					 'invalid'			=> count($this->model->tInvalid()),
					 'tampil'			=> $this->model->matrik($tahun, $angkatan),
					 'tahun'			=> $this->model->getYearsMatrik()->result(),
					 'tahunSeleksi'		=> $tahun,
					 'angkatan'			=> $angkatan,
					 'btn'				=> 1
					 ];
			$this->load->view('template/template', $data);
		}else{
			$data = ['content'			=> $this->folder.('view'),
					 'section'			=> $this->section,
					 'pending'			=> count($this->model->tValidasi()),
					 'invalid'			=> count($this->model->tInvalid()),
					 'tampil'			=> $this->model->matrik('3000'),
					 'tahun'			=> $this->model->getYearsMatrik()->result(),
					 'tahunSeleksi'		=> $tahun,
					 'btn'				=> ''
					 ];
			$this->load->view('template/template', $data);
			
		}
	}
	public function proses($th=null, $angkatan=null){
		if(!isset($th)) show_404();
		$tahunSeleksi = $this->encryption->decrypt(str_replace(['-','_','~'],['=','+','/'],$th));
		$bobot = [10,8,6,4,2];
		if($tahunSeleksi==''){
			$data = ['content'	=> $this->folder.('proses'),
					 'section'	=> $this->section,
					 'pending'	=> count($this->model->tValidasi()),
					 'invalid'	=> count($this->model->tInvalid()),
					 'tampil'	=> $this->model->matrik(),
					 'tahun'	=> $this->model->getYearsMatrik()->result(),
					 'btn'		=> ''
					 ];
			$this->load->view('template/template', $data);
		}else{
			$data = ['content'	=> $this->folder.('proses'),
					 'section'	=> $this->section,
					 'pending'	=> count($this->model->tValidasi()),
					 'invalid'	=> count($this->model->tInvalid()),
					 'tampil'	=> $this->model->matrik($tahunSeleksi, $angkatan),
					 'tahun'	=> $this->model->getYearsMatrik()->result(),
					 'max'		=> $this->model->maxKriteria($tahunSeleksi, $angkatan),
					 'th'		=> $tahunSeleksi,
					 'angkatan'	=> $angkatan,
					 'bobot'	=> $bobot,
					 'btn'		=> 1
					 ];
			$this->load->view('template/template', $data);
		}
	}


	public function save($tahun=null, $angkatan=null){
		$npm 		= $_POST['npm'];
		$totalPoin 	= $_POST['totalPoin'];
		$poinSAW 	= $_POST['poinSAW'];
		$keterangan = $_POST['juara'];
		

		// cek sudah ada belum rangking dengan tahun seleksi dan tahun angkatan?
		$cekRangking = count($this->model->get_by('rangking', 'angkatan', $angkatan, 'tahunSeleksi', $tahun)->result_array());
		// var_dump($cekRangking);die;
		// jika ada hapus dulu,
		if($cekRangking>0){
			// hapus Rangking
			$this->model->delete2('rangking', 'tahunSeleksi', $tahun, 'angkatan', $angkatan);

			// save Rangking
			$data = [];
			// set index
			$index = 0;

			foreach ($npm as $d) {
				array_push($data, 
					[
						'idRangkin' => null,
						'npm'		=> $npm[$index],
						'angkatan'	=> $angkatan,
						'tahunSeleksi'	=> $tahun,
						'totalPoin' => $totalPoin[$index],
						'poinSAW'	=> $poinSAW[$index],
						'keterangan'=> $keterangan[$index]
					]);
				$index++;
			}
			$this->model->save_batch('rangking',$data);

			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/ranking');

		}else{
			// jika tidak langsung save
			$data = [];
			// set index
			$index = 0;

			foreach ($npm as $d) {
				array_push($data, 
					[
						'idRangkin' => null,
						'npm'		=> $npm[$index],
						'angkatan'	=> $angkatan,
						'tahunSeleksi'	=> $tahun,
						'totalPoin' => $totalPoin[$index],
						'poinSAW'	=> $poinSAW[$index],
						'keterangan'=> $keterangan[$index]
					]);
				$index++;
			}
			$this->model->save_batch('rangking',$data);

			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/ranking');

		}
	}


	public function laporan()
	{
		$tahun 		= $this->input->post('tahun');
		$angkatan 	= $this->input->post('angkatan');

		if($tahun!='' && $angkatan!=''){
			$data = ['content'	=> $this->folder.('laporan'),
					 'section'	=> 'Laporan Rangking',
					 'pending'	=> count($this->model->tValidasi()),
					 'invalid'	=> count($this->model->tInvalid()),
					 'tahun'	=> $this->model->getYearsMatrik()->result(),
					 'th'		=> $tahun,
					 'angkatan'	=> $angkatan,
					 'tampil'	=> $this->model->getRangking($tahun, $angkatan),
					 ];
			$this->load->view('template/template', $data);
		}else{
			$data = ['content'	=> $this->folder.('laporan'),
					 'section'	=> 'Laporan Rangking',
					 'pending'	=> count($this->model->tValidasi()),
					 'invalid'	=> count($this->model->tInvalid()),
					 'tahun'	=> $this->model->getYearsMatrik()->result(),
					 'th'		=> $tahun,
					 'angkatan'	=> $angkatan,
					 'tampil'	=> $this->model->getRangking(),
					 ];
			$this->load->view('template/template', $data);	
		}
	}


	// angkatan berdasarkan tahun seleksi
	public function angkatanTahun(){


		$tahun 		= $this->input->post('tahun_');
		$angkatan  	= $this->model->getAngkatanByTahun($tahun)->result();
		$jum 		= count($angkatan);


		if($jum>0){
			echo "<option value='' >--Pilih--</option>";
			foreach ($angkatan as $a) {
				echo "<option value='$a->angkatan'>$a->angkatan</option>";
			}
		}else{
				echo "<option value=''>--Pilih--</option>";
		}
	}











}

/* End of file ranking.php */
/* Location: ./application/controllers/admin/ranking.php */