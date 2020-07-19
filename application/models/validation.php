<?php 
defined('BASEPATH') OR exit ('No script direct access allowed');

	class Validation extends CI_Model{

		public function val_login()
		{
			return [
				[
					'field'	=> 'username',
					'label'	=> 'Username',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'<b>%s</b> harus diisi.'],
				],
				[
					'field'	=> 'password',
					'label'	=> 'Password',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'<b>%s</b> harus diisi.']
				]
			];
		}

		public function val_peserta()
		{
			return [
				[
					'field'	=> 'angkatan',
					'label'	=> 'Angkatan',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'npm',
					'label'	=> 'NPM',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'nama',
					'label'	=> 'Nama',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'tgl',
					'label'	=> 'Tanggal Lahir',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'tempat',
					'label'	=> 'Tempat Lahir',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'alamat',
					'label'	=> 'Alamat',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'hp',
					'label'	=> 'No HP',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'komisariat',
					'label'	=> 'Komisariat',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
			];
		}

		public function val_kriteria()
		{
			return [
				[
					'field'	=> 'kegiatan',
					'label'	=> 'Nama Kegiatan',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required' 	=> 'Form <b>%s</b> tidak boleh kosong']
				],
				[
					'field'	=> 'jabatan',
					'label'	=> 'Nama Jabatan',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				]
			];
		}


		public function val_editProfile()
		{
			return [
				[
					'field'	=> 'nama',
					'label'	=> 'Nama',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'tgl',
					'label'	=> 'Tanggal Lahir',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'tempat',
					'label'	=> 'Tempat Lahir',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'alamat',
					'label'	=> 'Alamat',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'hp',
					'label'	=> 'No HP',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'komisariat',
					'label'	=> 'Komisariat',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
			];
		}


		public function val_password()
		{
			return [
				[
					'field'	=> 'oldPass',
					'label'	=> 'Password Lama',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required' 	=> 'Form <b>%s</b> tidak boleh kosong']
				],
				[
					'field'	=> 'newPass',
					'label'	=> 'Password Baru',
					'rules'	=> 'required|rtrim|min_length[8]|matches[konfirmasi]',
					'errors'=> [
									'required'		=> 'Form <b>%s</b> tidak boleh kosong.',
									'min_length'	=> 'Minimal panjang <b>%s</b> 8 karakter',
									'matches'		=> 'Password Baru dan Konfirmasi Password tidak cocok'
							   ]
				],
				[
					'field'	=> 'konfirmasi',
					'label'	=> 'Konfirmasi Password Baru',
					'rules'	=> 'required|rtrim',
					'errors'=> [
									'required'		=> 'Form <b>%s</b> tidak boleh kosong.',
							   ]
				]
			];
		}

		




	}
?>