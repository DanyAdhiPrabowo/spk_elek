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
        <a class="btn btn-sm btn-primary text-light" href="#" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> <b>Tambah</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="10px">NO</th>
              <th>Tahun Seleksi</th>
              <th width="180px">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($tampil as $t){ 
              $tahun = str_replace(['=','+','/'], ['-','_','~'], $this->encrypt->encode($t->tahun));
              $idd=$t->tahun
              ?>
            <tr>
              <td><?=$no ?></td>
              <td><?=$t->tahun ?></td>
              <td>
                <a href="<?=base_url('admin/tahun/updateStatus/'.$tahun)?>">
                  <?php 
                    if($t->status == '1')
                    { 
                      echo "<button class='btn btn-sm btn-primary' title='Tahun Aktif'><i class='fa fa-check'></i> Aktif</button>";
                    }
                    else
                    {
                      echo "<button class='btn btn-sm btn-secondary' title='Tahun Nonaktif'><i class='fa fa-times'></i> Nonaktif</button>";
                    }
                  ?>
                </a>

              </td>
            </tr>
          <?php $no++; };  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


<!-- Modal Delete -->
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
<!-- End Modal Delete -->


<!-- Modal add -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?=base_url('admin/tahun/add')?>">
          
          <div class="modal-body">
            <div>          
              <input type="text" name="tahun" placeholder="Tahun Seleksi..." class="form-control" id="nama">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-info" id="add">Tambah</button>
        </form>
          </div>
      </div>
    </div>
  </div>
<!-- End Modal add -->


<!-- Modal Edit -->
  <?php foreach ($tampil as $tm) { 
    $a    = $tm->tahun;
    $iid   = str_replace(['=','+','/'], ['-','_','~'], $this->encrypt->encode($a));
    ?>
    <div class="modal fade" id="editModal<?=$a?>" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('admin/tahun/edit')?>">
            
            <div class="modal-body">
              <div> 
                <input type="hidden" name="oldTahun" value="<?=$tm->tahun?>">
                <input type="text" name="tahunEdit" placeholder="Tahun Seleksi..." class="form-control" id="nama" value="<?=$tm->tahun ?>" autocomplete="off">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-info" id="add">Update</button>
          </form>
            </div>
        </div>
      </div>
    </div>
  <?php } ?>
<!-- End Modal edit -->



<script>
  function deleteConfirm(url)
  {
    $('#hapus').attr('href',url);
    $('#modalDelete').modal();
  }

</script>