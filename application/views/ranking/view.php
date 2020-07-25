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
        <label class="text-dark font-weight-bold">Pilih Tahun Seleksi</label>
        <form method="POST" action="<?=base_url('admin/ranking') ?>">
          <div class="input-group col-lg-6 p-0" >
            <select class="d-inline-block custom-select" name="tahun" id="tahun">
              <option value="">--Pilih Tahun--</option>
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
              <th>Tahun Seleksi</th>
              <th>Nama</th>
              <th width="15px">Nasional</th>
              <th width="15px">Provinsi</th>
              <th width="15px">Kabupaten/Kota</th>
              <th width="15px">Universitas</th>
              <th width="15px">Fakultas</th>
              <th width="30px">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($t->kodeKomisariat));
              $jumlah = $t->nasional+$t->provinsi+$t->kabupatenKota+$t->universitas+$t->fakultas;

            ?>
            <tr>
              <td><?=$t->tahunSeleksi ?></td>
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

      <div class="pt-4">
        <?php
        $tahun = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($tahunSeleksi));
        
        if($btn==1 && count($tampil)>1){
          echo "<a href='".base_url('admin/ranking/proses/'.$tahun)."' class='btn btn-md btn-danger'>Proses Data</a>";
        }
         ?>
        
      </div>

    </div>
  </div>

</div>