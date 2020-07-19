
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
      <div class="ml-auto">
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive ">
        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th >Angkatan</th>
              <th >Seleksi</th>
              <th >Nama</th>
              <th >Kegiatan</th>
              <th width="75px">Jabatan</th>
              <th >Foto</th>
              <th width="70px">Status</th>
              <th width="130px" class="text-center">Rubah</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $id = str_replace(['=','+','/'], ['-','_','~'], $this->encrypt->encode($t->idValidasi));
              $idd= $t->idValidasi;
              ?>
            <tr>
              <td><?=$t->angkatan ?></td>
              <td><?=$t->tahunSeleksi ?></td>
              <td><?=$t->nama ?></td>
              <td><?=$t->kegiatan?></td>
              <td><?php if($t->jabatan==1){echo 'Ketua Panitia';}elseif($t->jabatan==2){echo 'Sekertaris';}elseif ($t->jabatan==3){echo 'Bendahara';}elseif ($t->jabatan==4){echo 'CO';}else{echo 'Anggota';} ?></td>
              <td>
                <a href="#" title="Detail" data-toggle="modal" data-target="#exampleModalLong<?=$idd?>">
                  <img src="<?=base_url('assets/validasi/'.$t->foto)?>" width=80px>    
                </a>
              </td>
              <td>
                <?php 
                  if($t->statusValidasi==0){
                    echo "<div class='btn btn-sm btn-secondary' title='Data Belum Di Validasi'><i class='fa fa-hourglass-half'></i> Pending</div>";
                  }elseif($t->statusValidasi==1){
                    echo "<a href='' class='btn btn-sm btn-danger' title='Data Tidak Valid'><i class='fa fa-times'></i> Invalid</a>";
                  }else{
                    echo "<a href='' class='btn btn-sm btn-success' title='Data Valid'><i class='fa fa-check'></i> Valid</a>";
                  }
                ?>
              </td>
              <td>
                <a href='<?=base_url('admin/validasi/invalidStatus/'.$id) ?>' class='btn btn-sm btn-danger' title='Data Tidak Valid'><i class='fa fa-times'></i> Invalid</a>
                <a href='<?=base_url('admin/validasi/validStatus/'.$id.'/'.$t->npm.'/'.$t->tahunSeleksi) ?>' class='btn btn-sm btn-success' title='Data Valid'><i class='fa fa-check'></i> Valid</a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<?php
foreach ($tampil as $p):
  $a=$p->idValidasi;
  
?>
        <!-- Modal foto view-->
        <div class="modal fade" id="exampleModalLong<?= $a?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="min-height: 500px">
              <div class="modal-header">
                <h2 class="modal-title text-center"><strong >Foto</strong></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body justify-content-center" align="center" >
                <img src="<?=base_url('assets/validasi/'.$p->foto)?>" style="max-width: 700px">
              </div>
              <div class="modal-header"></div>
            </div>
          </div>
        </div>
 <?php endforeach;?>