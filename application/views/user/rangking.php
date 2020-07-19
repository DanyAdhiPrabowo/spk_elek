
  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Data Rangking Peserta<br> Kader   Terbaik</h1>
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
          <h2 class="mt-0 font-weight-bold text-center" >Rangking Peserta</h2>
          <hr class="divider-denger my-2 mb-4" style="max-width: 15rem !important">
        </div>
        <div class="col-lg-10 my-4 mt-5">
          <form method="POST" action="<?=base_url('rangking') ?>">
            <select class="custom-select text-dark d-inline-block" name="tahun" style="max-width: 13rem !important" id="tahun">
              <option value="">--Tahun Seleksi--</option>
              <?php foreach ($tahun as $t): ?>
                <option value="<?=$t->tahun ?>" <?=set_select('tahun', $t->tahun)?> ><?=$t->tahun?></option>
              <?php endforeach; ?>
            </select>
            <select class="custom-select text-dark d-inline-block" name="angkatan" style="max-width: 14rem !important" id="angkatan">
              <option value="">--Tahun Angkatan--</option>
            </select>
            <button class="btn btn-info d-inline-block ml-3">Lihat</button>
          </form>
        </div>
        <div class="col-lg-10 mt-5">
          <table class="table table-bordered table-striped">
            <tr>
              <th>No</th>
              <th>NPM</th>
              <th>Nama</th>
              <th>Komisariat</th>
              <th>Keterangan</th>
            </tr>
            <?php $no=1; foreach ($rangking as $r) { ?>
              <tr>
                <td><?=$no?></td>
                <td><?=$r->npm?></td>
                <td><?=$r->nama?></td>
                <td><?=$r->komisariat?></td>
                <td><?=$r->keterangan ?></td>
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
          url   : '<?=base_url('/user/angkatanTahun')?>',
          data  : 'tahun ='+tahun,
          success : function(data){
            console.log(data);
            $('#angkatan').html(data);
          }
        });
      });
    });
  </script>