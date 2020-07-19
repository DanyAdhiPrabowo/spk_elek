<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	var $folder 	= 'user/';
	var $table 		= 'peserta';
	var $i 			= 'admin/';
	var $section 	= 'User';

	function __construct(){
		parent::__construct();
		$this->load->model(['model','validation']);
		$this->load->library(['form_validation', 'encrypt']);
		

	}

	public function index()
	{
		$data = [
					'content'	=> $this->folder.('index'),
					'section'	=> 'Home'
				];
		$this->load->view('user/template', $data);

	}

	public function peserta($tahun=null)
	{	
		$tahun 		= $this->input->post('tahun');
		$angkatan 	= $this->input->post('angkatan');

		if($tahun!=null){
			$data = [
						'content'	=> $this->folder.('peserta'),
						'section'	=> 'Peserta',
						'tahun'		=> $this->model->getYearsMatrik()->result(),
						'peserta' 	=> $this->model->getRangkingUser($tahun, $angkatan)
					];
			$this->load->view('user/template', $data);
		}else{
			$data = [
						'content'	=> $this->folder.('peserta'),
						'section'	=> 'Peserta',
						'tahun'		=> $this->model->getYearsMatrik()->result(),
						'peserta' 	=> $this->model->getRangkingUser($tahun, $angkatan)
					];
			$this->load->view('user/template', $data);
		}
	}


	public function rangking($tahun=null, $angkatan=null)
	{
		$tahun 		= $this->input->post('tahun');
		$angkatan 	= $this->input->post('angkatan');

		if($tahun!=null && $angkatan!=null){
			$data = [
						'content'	=> $this->folder.('rangking'),
						'section'	=> 'Rangking',
						'tahun'		=> $this->model->getYearsMatrik()->result(),
						'rangking' 	=> $this->model->getRangkingUser($tahun, $angkatan)
					];
			$this->load->view('user/template', $data);
		}else{
			$data = [
						'content'	=> $this->folder.('rangking'),
						'section'	=> 'Rangking',
						'tahun'		=> $this->model->getYearsMatrik()->result(),
						'rangking' 	=> $this->model->getRangkingUser()
					];
			$this->load->view('user/template', $data);
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


	public function kriteria()
	{
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='user'){ $url=base_url('user');redirect($url); };

		$npm 				= $this->session->userdata('npm');
		$cekTahunSeleksi 	= count($this->model->get_by('tahun', 'status', '1')->result_array());

		$data = [
					'content'	=> $this->folder.('kriteria'),
					'section'	=> 'Kriteria',
					'tampil'	=> $this->model->get_by('validasi', 'npm', $npm)->result(),
					'seleksi'	=> $cekTahunSeleksi
				];
			$this->load->view('user/template', $data);
	}

	public function tambah()
	{
		// cek tahun ada aktif nggak
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='user'){ $url=base_url('user');redirect($url); };

		$cekTahunSeleksi = count($this->model->get_by('tahun', 'status', '1')->result_array());
			if($cekTahunSeleksi==1){
				$data = [
							'content'	=> $this->folder.('tambah'),
							'section'	=> 'Tambah Kriteria',
						];
					$this->load->view('user/template', $data);
			}else{
				redirect('kriteria');
			}
	}

	// save kriteria peserta
	public function save()
	{
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='user'){ $url=base_url('user');redirect($url); };

		$validasi 	= $this->form_validation->set_rules($this->validation->val_kriteria());
		
		$ambilTahunSeleksi = $this->model->get_by('tahun', 'status', '1')->result_array();

		if($validasi->run()==True){
			$data = [
						'idValidasi'		=> null,
						'npm'				=> $this->session->userdata('npm'),
						'angkatan'			=> $this->session->userdata('angkatan'),
						'tahunSeleksi'		=> $ambilTahunSeleksi[0]['tahun'],
						'kegiatan'			=> $this->input->post('kegiatan'),
						'jabatan'			=> $this->input->post('jabatan'),
						'foto'				=> $this->upload(),
						'statusValidasi'	=> 0,
					];

			if($data['foto']!=''){
				$this->model->save('validasi', $data);
				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Diupload !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('tambah_kriteria');
			}else{
				$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Foto Gagal Di Uplaod !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				$data = [
							'content'	=> $this->folder.('tambah'),
							'section'	=> 'Tambah Kriteria',
						];
				$this->load->view('user/template', $data);
			}

		}else{
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Disimpan, form tidak boleh kosong !.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			$data = [
						'content'	=> $this->folder.('tambah'),
						'section'	=> 'Tambah Kriteria',
					];
			$this->load->view('user/template', $data);
		}
	}


	private function upload()
	{
		$name = $_FILES['foto']['name'];

		$config['upload_path'] 		= './assets/validasi';
		$config['allowed_types'] 	= 'jpeg|jpg|png';
		$config['file_name']		= $this->session->userdata('npm').$name;
		$config['max_size']  		= '2048';
		
		$this->load->library('upload', $config);
		if ( $this->upload->do_upload('foto')){
			$this->upload->data('file_name');
			return $this->upload->data('file_name');
		}else{
			return "";
		}
	}



	public function profile()
	{
		if($this->session->userdata('masuk')!=TRUE && $this->session->userdata('access')!='user'){ $url=base_url('user');redirect($url); };

		$npm  = $this->session->userdata('npm');
		$data = [
					'content'	=> $this->folder.('profile'),
					'section'	=> 'Profile',
					'tampil'	=> $this->model->get_by('peserta', 'npm', $npm)->result()
				];
		$this->load->view('user/template', $data);
	}

	public function edit_profile()
	{
		$npm = $this->session->userdata('npm');
		$data = [
					'content'	=> $this->folder.('editProfile'),
					'section'	=> 'Profile',
					'tampil'	=> $this->model->get_by('peserta', 'npm', $npm)->result(),
					'komisariat'	=> $this->model->get_all('komisariat')->result()
				];
		$this->load->view('user/template', $data);
	}

	public function updateProfile()
	{
		$npm 		= $this->session->userdata('npm');
		$post 		= $this->input->post();

		$validasi 	= $this->form_validation->set_rules($this->validation->val_editProfile());
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
			$this->model->update('peserta', 'npm', $npm, $data);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di Ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('profile');

		}else{
			$data = [
						'content'	=> $this->folder.('editProfile'),
						'section'	=> 'Profile',
						'tampil'	=> $this->model->get_by('peserta', 'npm', $npm)->result(),
						'komisariat'	=> $this->model->get_all('komisariat')->result()
					];
			$this->load->view('user/template', $data);
		}
	}


	public function password()
	{
		$data = [
					'content'	=> $this->folder.('password'),
					'section'	=> 'Profile',
				];
		$this->load->view('user/template', $data);
	}

	public function updatePassword()
	{
		$npm 		= $this->session->userdata('npm');
		$cek 		= $this->model->get_by($this->table, 'npm', $npm)->result_array();
		$post 		= $this->input->post();

		$validasi 	= $this->form_validation->set_rules($this->validation->val_password());
		if($validasi->run()==true){
			$old = $post['oldPass'];
			if(password_verify($old, $cek[0]['password']))
			{
				$data = [ 'password' => password_hash($post['newPass'], PASSWORD_DEFAULT)];
				$this->model->update($this->table, 'npm', $npm, $data);
				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password Berhasil Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('profile');
			}else{
				$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Lama salah !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('ubah_password');
			}
		}else{
			$data = [
						'content'	=> $this->folder.('password'),
						'section'	=> 'Profile',
					];
			$this->load->view('user/template', $data);
		}

	}



	public function login()
	{
		if($this->session->userdata('masuk')==TRUE && $this->session->userdata('access')=='user'){ $url=base_url('user');redirect($url); };

		$this->load->view('user/login');
	}

	public function auth()
	{
		if($this->session->userdata('masuk')==TRUE && $this->session->userdata('access')=='user'){ $url=base_url('user');redirect($url); };

			$user 	= $this->input->post('username');
			$pass 	= $this->input->post('password');
			$cek 	= $this->model->get_by($this->table, 'username' ,$user)->row_array();
			$validasi = $this->form_validation->set_rules($this->validation->val_login());
			if($validasi->run()==false)
			{
				$this->load->view('user/login');
			}else{
				if($cek){
					if(password_verify($pass, $cek['password'])){
						$data = [
							'masuk'		=> true,
							'access'	=> 'user',
							'npm'		=> $cek['npm'],
							'angkatan'	=> $cek['angkatan'],
							];
						$this->session->set_userdata($data);
						redirect('profile');
					}else{
						$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Salah !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						$this->load->view('user/login');
					}
				}else{
					$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username Salah !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					$this->load->view('user/login');
				}
			};
		}

		public function logout()
		{
			$this->session->unset_userdata('masuk');
			$this->session->unset_userdata('access');
			$this->session->unset_userdata('npm');
			$this->session->unset_userdata('angkatan');
			redirect('');
		}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */