<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-5 text-gray-800">Overview Data <?=$section?></h1>
<?=$this->session->flashdata('flash') ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
      <div>
        <span class="m-0 font-weight-bold text-primary">Data <?=$section ?></span>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive py-4">
        <h3 class="font-weight-bold text-dark pb-3">Matrik Awal</h3>
        <table class="table table-bordered " width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama</th>
              <th width="110px">Nasional</th>
              <th width="110px">Provinsi</th>
              <th width="110px">Kabupaten / Kota</th>
              <th width="110px">Universitas</th>
              <th width="110px">Fakultas</th>
              <th width="50px">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $jumlah = $t->nasional+$t->provinsi+$t->kabupatenKota+$t->universitas+$t->fakultas;
            ?>
            <tr>
              <td><?=$t->namaKomisariat ?></td>
              <td><?=$t->nasional?></td>
              <td><?=$t->provinsi?></td>
              <td><?=$t->kabupatenKota?></td>
              <td><?=$t->universitas?></td>
              <td><?=$t->fakultas?></td>
              <td><?=$jumlah?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div> 

      <div class="table-responsive py-4">
        <h3 class="font-weight-bold text-dark pb-3">Matrik Normalisasi</h3>
        <table class="table table-bordered " width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama</th>
              <th width="110px">Nasional</th>
              <th width="110px">Provinsi</th>
              <th width="110px">Kabupaten / Kota</th>
              <th width="110px">Universitas</th>
              <th width="110px">Fakultas</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              foreach ($max as $m) { ?>
            <tr>
              <td><?=$t->namaKomisariat?></td>
              <td><?php if($m->nasional!=0){echo round($t->nasional/$m->nasional,2);}else{echo '0';}?></td>
              <td><?php if($m->provinsi!=0){echo round($t->provinsi/$m->provinsi,2);}else{echo '0';}?></td>
              <td><?php if($m->kabupatenKota!=0){echo round($t->kabupatenKota/$m->kabupatenKota,2);}else{echo '0';}?></td>
              <td><?php if($m->universitas!=0){echo round($t->universitas/$m->universitas,2);}else{echo '0';}?></td>
              <td><?php if($m->fakultas!=0){echo round($t->fakultas/$m->fakultas,2);}else{echo '0';}?></td>
            </tr>
            <?php }; ?>
          <?php } ?>
          </tbody>
        </table>
      </div> 

      <div class="table-responsive py-4">
        <h3 class="font-weight-bold text-dark pb-3">Perangkingan</h3>
        <form method="POST" action="<?=base_url('admin/ranking/save/'.$th) ?>">
        <table class="table table-bordered " width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama</th>
              <th >Total Poin</th>
              <th >Poin SAW</th>
              <th >Rangking</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // Mengisi variabel data dengan data berdasarkan nilai saw dan jumlah poin
            // Jika variabel tampil tidak kosong jumlah di isi, jika variabel tampil kosong maka jumlah kosong
            if($tampil!=null){
              foreach($tampil as $t){
                foreach ($max as $m) {
                  $jumlah = $t->nasional+$t->provinsi+$t->kabupatenKota+$t->universitas+$t->fakultas;
                  $poin   = ( ($this->model->bagi($t->nasional,$m->nasional)*$bobot[0])+
                               ($this->model->bagi($t->provinsi,$m->provinsi)*$bobot[1])+
                               ($this->model->bagi($t->kabupatenKota,$m->kabupatenKota)*$bobot[2])+
                               ($this->model->bagi($t->universitas,$m->universitas)*$bobot[3])+
                               ($this->model->bagi($t->fakultas,$m->fakultas)*$bobot[4])
                            );
                  $data[]=array('kodeKomisariat'=>$t->kodeKomisariat,'namaKomisariat'=>$t->namaKomisariat, 'totalPoin'=>$jumlah,'poinSAW'=>$poin);
                };
              }
            }else{
              $jumlah='';
            }
              
            // URUTKAN Data Berdasarkan Poin SAW tertinggi, dan total poin tertinggi
            // Jika variabel jumlah tidak kosong maka tampilkan data, kalo kosong tidak nampilkan apa2
            if( $jumlah!=''){
              foreach ($data as $key => $isi) {
                $saw[$key]  = $isi['poinSAW'];
                $total[$key]= $isi['totalPoin'];
              }
                array_multisort($saw,SORT_DESC,$total,SORT_DESC,$data);
            
              $no=1;
              foreach ($data as $d) { ?>
                <tr>
                  <td><?=$d['namaKomisariat']?></td>
                  <td><?=$d['totalPoin'] ?></td>
                  <td><?=round($d['poinSAW'],3) ?></td>
                  <td><?='Juara '.$no ?></td>
                </tr>
                <input type="hidden" name="kodeKomisariat[]" value="<?=$d['kodeKomisariat'] ?>">
                <input type="hidden" name="namaKomisariat[]" value="<?=$d['namaKomisariat'] ?>">
                <input type="hidden" name="totalPoin[]" value="<?=$d['totalPoin'] ?>">
                <input type="hidden" name="poinSAW[]" value="<?=round($d['poinSAW'],3) ?>">
                <input type="hidden" name="juara[]" value="<?='juara '.$no ?>">
              <?php 
              $no++; 
              }; //End Foreach
            } //End Cek Jumlah 
            ?>
        
          </tbody>
        </table>
      </div>

        <div class="pt-4">
          <?php
          if($btn==1){
            echo "<button type='submit' class='btn btn-md btn-danger'>Simpan Data</button>";
           } ?>
        </div>
      </form>
    </div>
  </div>

</div>