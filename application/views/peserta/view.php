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
        <a class="btn btn-sm btn-primary text-light" href="<?=base_url('admin/peserta/add')?>"><i class="fa fa-plus"></i> <b>Tambah</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive ">
        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="60px">Angkatan</th>
              <th width="120px">NPM</th>
              <th>Nama</th>
              <th width="100px">Gender</th>
              <th>Komisariat</th>
              <th width="150px" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($t->npm));
              ?>
            <tr>
              <td><?=$t->angkatan ?></td>
              <td><?=$t->npm ?></td>
              <td><?=$t->nama ?></td>
              <td><?php if($t->jk=='l'){echo 'Laki-Laki';}else{echo 'Perempuat';} ?></td>
              <td><?=$t->komisariat ?></td>
              <td>
                <a href="<?=base_url('admin/peserta/edit/'.$id) ?>" class="btn btn-sm btn-warning" title="Edit">Edit</a>
                  <button href="" onclick="deleteConfirm('<?=base_url('admin/peserta/delete/'.$id) ?>')" class="btn btn-sm btn-danger" title="Hapus" data-target="#modalDelete" data-toggle="modal">Hapus</button>
                <a href="<?=base_url('admin/peserta/reset/'.$id) ?>" class="btn btn-sm btn-success" title="Reset Password">Reset</a>
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



<script>
  function deleteConfirm(url)
  {
    $('#hapus').attr('href',url);
    $('#modalDelete').modal();
  }

</script>