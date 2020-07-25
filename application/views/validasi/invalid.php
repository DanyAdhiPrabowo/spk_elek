
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
              <th >Seleksi</th>
              <th >Nama Komisariat</th>
              <th >Kegiatan</th>
              <th width="75px">Jabatan</th>
              <th >Foto</th>
              <th width="70px">Status</th>
              <th width="130px" class="text-center">Rubah</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($t->idValidasi));
              $idd= $t->idValidasi;
              ?>
            <tr>

              <td><?=$t->tahunSeleksi ?></td>
              <td><?=$t->namaKomisariat ?></td>
              <td><?=$t->kegiatan?></td>
              <td><?php if($t->tingkatan==1){echo 'Nasional';}elseif($t->tingkatan==2){echo 'Provinsi';}elseif ($t->tingkatan==3){echo 'Kabupaten / Kota';}elseif ($t->tingkatan==4){echo 'Universitas';}else{echo 'Fakultas';} ?></td>
              <td>
                <a href="#" title="Detail" data-toggle="modal" data-target="#exampleModalLong<?=$idd?>">
                  <img src="<?=base_url('assets/validasi/'.$t->foto)?>" width=80px>    
                </a>
              </td>
              <td><div class='btn btn-sm btn-danger' title='Data Tidak Valid'><i class='fa fa-times'></i> Invalid</div>
              </td>
              <td>
                <a href='<?=base_url('admin/validasi/validStatus/'.$id.'/'.$t->kodeKomisariat.'/'.$t->tahunSeleksi) ?>' class='btn btn-sm btn-success' title='Data Valid'><i class='fa fa-check'></i> Valid</a>
                <button href="" onclick="deleteConfirm('<?=base_url('admin/validasi/delete/'.$id) ?>')" class="btn btn-sm btn-secondary" title="Hapus" data-target="#modalDelete" data-toggle="modal">Hapus</button>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Anda Yakin ingin Menghapus Data?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
        <a type="button" class="btn btn-danger btn-sm" id="hapus">Hapus</a>
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
                <img src="<?=base_url('assets/validasi/'.$p->foto)?>">
              </div>
              <div class="modal-header"></div>
            </div>
          </div>
        </div>
 <?php endforeach;?>




<script>
  function deleteConfirm(url)
  {
    $('#hapus').attr('href',url);
    $('#modalDelete').modal();
  }

</script>

