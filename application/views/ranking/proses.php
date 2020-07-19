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
              <th width="110px">Ketua</th>
              <th width="110px">Sekertaris</th>
              <th width="110px">Bendahara</th>
              <th width="110px">CO</th>
              <th width="110px">Anggota</th>
              <th width="50px">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $jumlah = $t->ketua+$t->sekertaris+$t->bendahara+$t->co+$t->anggota;
            ?>
            <tr>
              <td><?=$t->nama ?></td>
              <td><?=$t->ketua?></td>
              <td><?=$t->sekertaris?></td>
              <td><?=$t->bendahara?></td>
              <td><?=$t->co?></td>
              <td><?=$t->anggota?></td>
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
              <th width="110px">Ketua</th>
              <th width="110px">Sekertaris</th>
              <th width="110px">Bendahara</th>
              <th width="110px">CO</th>
              <th width="110px">Anggota</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              foreach ($max as $m) { ?>
            <tr>
              <td><?=$t->nama?></td>
              <td><?php if($m->ketua!=0){echo round($t->ketua/$m->ketua,2);}else{echo '0';}?></td>
              <td><?php if($m->sekertaris!=0){echo round($t->sekertaris/$m->sekertaris,2);}else{echo '0';}?></td>
              <td><?php if($m->bendahara!=0){echo round($t->bendahara/$m->bendahara,2);}else{echo '0';}?></td>
              <td><?php if($m->co!=0){echo round($t->co/$m->co,2);}else{echo '0';}?></td>
              <td><?php if($m->anggota!=0){echo round($t->anggota/$m->anggota,2);}else{echo '0';}?></td>
            </tr>
            <?php }; ?>
          <?php } ?>
          </tbody>
        </table>
      </div> 

      <div class="table-responsive py-4">
        <h3 class="font-weight-bold text-dark pb-3">Perangkingan</h3>
        <form method="POST" action="<?=base_url('admin/ranking/save/'.$th.'/'.$angkatan) ?>">
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
                  $jumlah = $t->ketua+$t->sekertaris+$t->bendahara+$t->co+$t->anggota;
                  $poin   = ( ($this->model->bagi($t->ketua,$m->ketua)*$bobot[0])+
                               ($this->model->bagi($t->sekertaris,$m->sekertaris)*$bobot[1])+
                               ($this->model->bagi($t->bendahara,$m->bendahara)*$bobot[2])+
                               ($this->model->bagi($t->co,$m->co)*$bobot[3])+
                               ($this->model->bagi($t->anggota,$m->anggota)*$bobot[4])
                            );
                  $data[]=array('npm'=>$t->npm,'nama'=>$t->nama, 'totalPoin'=>$jumlah,'poinSAW'=>$poin);
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
                  <td><?=$d['nama']?></td>
                  <td><?=$d['totalPoin'] ?></td>
                  <td><?=round($d['poinSAW'],3) ?></td>
                  <td><?='Juara '.$no ?></td>
                </tr>
                <input type="hidden" name="npm[]" value="<?=$d['npm'] ?>">
                <input type="hidden" name="nama[]" value="<?=$d['nama'] ?>">
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