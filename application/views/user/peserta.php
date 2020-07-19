  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Data Peserta Calon <br> Kader   Terbaik</h1>
          <hr class="my-3 mb-4" style="max-width: 20.25rem; border-width: 0.37rem; border-color: #f4623a;">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-3"></p>
        </div>
      </div>
    </div>
  </header>

  <!-- About Section -->
  <section class="page-section mt-2" style="min-height: 700px">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 ">
          <h2 class="mt-0 font-weight-bold text-center">Daftar Peserta</h2>
          <hr class="divider-denger my-2 mb-4">
        </div>
        <div class="col-lg-10 my-4 mt-5">

            <label class="text-dark font-weight-bold">Pilih Tahun Seleksi dan Angkatan</label>
            <form method="POST" action="<?=base_url('peserta') ?>">
              <div class="input-group col-lg-6 p-0" >
                <select class="d-inline-block custom-select" name="tahun" id="tahun">
                  <option value="">--Pilih Tahun--</option>
                  <?php foreach ($tahun as $th): ?>
                      <option value="<?=$th->tahun?>"><?=$th->tahun;?></option>
                  <?php endforeach; ?>
                </select>
                <select class="d-inline-block custom-select" name="angkatan" id="angkatan">
                  <option value="">--Pilih Angkatan--</option>
                </select>
                <button type="submit" class="btn btn-info btn-md ml-3" style="margin-left: -10px">Pilih</button>
              </div>
            </form>


        </div>
        <div class="col-lg-10 mt-5">
          <table class="table table-bordered table-striped">
            <tr>
              <th width="10px">No</th>
              <th width="90px">Angkatan</th>
              <th width="150px">Tahun Seleksi</th>
              <th>NPM</th>
              <th>Nama</th>
              <th>Komisariat</th>
            </tr>
            <?php $no=1; foreach ($peserta as $p) { ?>
              <tr>
                <td><?=$no?></td>
                <td><?=$p->angkatan?></td>
                <td><?=$p->tahunSeleksi?></td>
                <td><?=$p->npm?></td>
                <td><?=$p->nama?></td>
                <td><?=$p->komisariat?></td>
              </tr>

            <?php $no ++; } ?>
          </table>
        </div>
      </div>
    </div>
  </section>

 

 <script>
    $(document).ready(function(){

      $('#tahun').change(function(){
        var tahun = $(this).val();
        $.ajax({
          type  : 'POST',
          url   : '<?=base_url('user/angkatanTahun')?>',
          data  : 'tahun ='+tahun,
          success : function(data){
            console.log(data);
            $('#angkatan').html(data);
          }
        });
      });
    });
  </script>