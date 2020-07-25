<?php 

class Model extends CI_Model{


	public function get_all($table)
	{
		return $this->db->get($table);
	}

	public function get_by($table,$id, $where)
	{
		return $this->db->get_where($table, [$id=>$where]);
	}
	
	public function get_by2($table,$id1, $where1, $id2, $where2)
	{
		return $this->db->get_where($table, [$id1=>$where1, $id2=>$where2]);
	}

	public function save($table,$data)
	{
		$this->db->insert($table, $data);
	}

	public function save_batch($table,$data)
	{
		$this->db->insert_batch($table, $data);
	}

	public function delete($table,$pk, $where)
	{
		$this->db->delete($table, [$pk=>$where]);
	}

	public function delete2($table,$pk1, $where1, $pk2, $where2)
	{
		$this->db->delete($table, [$pk1=>$where1, $pk2=>$where2]);
	}

	public function update($table, $id, $where, $data)
	{
		$this->db->update($table, $data , [$id=>$where]);
	}

	public function update2($table, $id1, $where1, $id2, $where2, $data)
	{
		$this->db->update($table, $data , [$id1=>$where1, $id2=>$where2 ]);
	}

	public function reset_pass($table, $id, $where, $field)
	{
		$pass = '$2y$10$NuJpueDsXtO2jre2Dq5TXucFV8hEnOV4CLUnMAgvCpO5o2wIe6wOG';
		$data = [$field=>$pass];
		$this->db->update($table, $data, [$id=>$where]);
	}


	public function tValidasi(){
		$this->db->select('*');
        $this->db->from('validasi');
        $this->db->join('komisariat','validasi.kodeKomisariat=komisariat.kodeKomisariat');
        $this->db->where('validasi.statusValidasi=0');
        $query = $this->db->get();
        return $query->result();
	}

	public function tInvalid(){
		$this->db->select('*');
        $this->db->from('validasi');
        $this->db->join('komisariat','validasi.kodeKomisariat=komisariat.kodeKomisariat');
        $this->db->where('validasi.statusValidasi=1');
        $query = $this->db->get();
        return $query->result();
	}

	public function tValid(){
		$this->db->select('*');
        $this->db->from('validasi');
        $this->db->join('komisariat','validasi.kodeKomisariat=komisariat.kodeKomisariat');
        $this->db->where('validasi.statusValidasi=2');
        $query = $this->db->get();
        return $query->result();
	}

	public function matrik($thn=null){
		return	$this->db->select('a.*, b.namaKomisariat')
        		->from('matrik as a')
        		->join('komisariat as b','a.kodeKomisariat=b.kodeKomisariat', 'inner')
        		->where("a.tahunSeleksi=$thn")
         		->get()->result();
	}

	public function getYearsMatrik()
	{
		return 	$this->db->distinct()
						 ->select('tahun')
						 ->order_by('tahun','DESC')
						 ->get('tahun');
	}


	public function maxKriteria($thn=null){

		$this->db->select_max('nasional');
		$this->db->select_max('provinsi');
		$this->db->select_max('kabupatenKota');
		$this->db->select_max('universitas');
		$this->db->select_max('fakultas');
        $this->db->from('matrik as a');
        $this->db->join('komisariat as b','a.kodeKomisariat=b.kodeKomisariat', 'left');
        $this->db->where("a.tahunSeleksi=$thn");
        $query = $this->db->get();
        return $query->result();
	}

	public function bagi($angka,$pembagi){
		if($pembagi!=0){
			$hasil=$angka/$pembagi;
		}else{
			$hasil=0;
		}
		return $hasil;
	}

	public function rangking($tahun)
	{
		$bobot 		= [0.30,0.25,0.20,0.15,0.10];
		$max 		= $this->maxKriteria($tahun);
		$matrik 	= $this->matrik($tahun);
		foreach ($matrik as $t) {
			foreach ($max as $m) {
				 $total =  (  ($this->bagi($t->ketua,$m->ketua)*$bobot[0])+
		                      ($this->bagi($t->sekertaris,$m->sekertaris)*$bobot[1])+
		                      ($this->bagi($t->bendahara,$m->bendahara)*$bobot[2])+
		                      ($this->bagi($t->co,$m->co)*$bobot[3])+
		                      ($this->bagi($t->anggota,$m->anggota)*$bobot[4])
		                    );
			}
			return $total;
		}
	}

	public function getRangking($thn=null){
		$this->db->select('a.*, b.namaKomisariat');
        $this->db->from('rangking as a');
        $this->db->join('komisariat as b','a.kodeKomisariat=b.kodeKomisariat', 'left');
        $this->db->where("a.tahunSeleksi=$thn");
        $query = $this->db->get();
        return $query->result();
	}


	// hanya tampil di halaman user
	public function getRangkingUser($thn=null)
	{
		$this->db->select('a.*, b.namaKomisariat');
        $this->db->from('rangking as a');
        $this->db->join('komisariat as b','a.kodeKomisariat=b.kodeKomisariat', 'left');
        $this->db->where("a.tahunSeleksi=$thn");
        $query = $this->db->get();
        return $query->result();
	}


	public function getRangkingYears($tahun)
	{
		$this->db->select('*');
        $this->db->from('rangking');
        $this->db->join('komisariat','rangking.kodeKomisariat=komisariat.kodeKomisariat');
        $this->db->where("komisariat.tahun=$tahun");
        $query = $this->db->get();
        return $query->result();
	}


}
 ?>