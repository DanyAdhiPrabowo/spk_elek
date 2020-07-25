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
      <div class="mb-5">
        <label class="text-dark font-weight-bold">Pilih Tahun dan Angkatan</label>
        <form method="POST" action="<?=base_url('admin/ranking/laporan') ?>">
          <div class="input-group col-lg-6 p-0" >
            <select class="d-inline-block custom-select" name="tahun" id="tahun">
              <option value="">--Tahun Seleksi--</option>
              <?php foreach ($tahun as $th): ?>
                  <option value="<?=$th->tahun?>"><?=$th->tahun;?></option>
              <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary btn-md ml-3" style="margin-left: -10px">Pilih</button>
          </div>
        </form>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="110px">Tahun Seleksi</th>
              <th >Nama Komisariat</th>
              <th width="100px">Total Poin</th>
              <th width="100px">Poin SAW</th>
              <th width="100px">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ ?>
            <tr>
              <td><?=$t->tahunSeleksi ?></td>
              <td><?=$t->namaKomisariat?></td>
              <td><?=$t->totalPoin?></td>
              <td><?=$t->poinSAW?></td>
              <td><?=$t->keterangan?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
