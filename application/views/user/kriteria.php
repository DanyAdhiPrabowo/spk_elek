  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Input Data Kriteria</h1>
          <hr class="my-3 mb-4" style="max-width: 25.25rem; border-width: 0.37rem; border-color: #f4623a;">
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
          <h2 class="mt-0 font-weight-bold text-center">Input Data</h2>
          <hr class="divider-denger my-2 mb-4">
        </div>
        <div class="col-lg-10 mt-3">
          <?php 
            if($seleksi==1){
              echo " <a href='tambah_kriteria' class='btn btn-info mb-3'><i class='fa fa-plus'></i> Tambah</a>";
            }else{
              echo " <div class='btn btn-secondary mb-3'><i class='fa fa-plus'></i> Tambah</div>";
            }
           ?>

          <table class="table table-bordered table-striped">
            <tr>
              <th width="14px">No</th>
              <th width="138px">Tahun Seleksi</th>
              <th>Kegiatan</th>
              <th>Jabatan</th>
              <th>Foto</th>
              <th width="114px">Status</th>
            </tr>
             <?php $no=1; foreach ($tampil as $t) { ?> 
              <tr>
                <td><?=$no?></td>
                <td><?=$t->tahunSeleksi?></td>
                <td><?=$t->kegiatan?></td>
                <td><?php if($t->jabatan==1){echo 'Ketua Panitia';}
                          elseif($t->jabatan==2){echo 'Sekertaris';}
                          elseif($t->jabatan==3){echo 'Bendahara';}
                          elseif($t->jabatan==4){echo 'Ketua CO';}
                          else{echo 'Anggota';}
                    ?></td>
                <td align="center"><img src="<?=base_url('assets/validasi/').$t->foto?>" width="80px"></td>
                <td><?php if($t->statusValidasi==0){echo "<div class='btn btn-sm btn-secondary' title='Data Menunggu Untuk Di Validasi'><i class='fa fa-hourglass-half'></i> Pending</div>";}
                          elseif($t->statusValidasi==1){echo "<div class='btn btn-sm btn-danger' title='Data Tidak Valid'><i class='fa fa-times'></i> Invalid</div>";}
                          else{echo "<div class='btn btn-sm btn-success' title='Data Valid'><i class='fa fa-check'></i> Valid</div>";}
                    ?></td>
              </tr>

             <?php $no ++; } ?> 
          </table>
          
          <div class="mt-5" style="font-size: 11.5px">
            keterangan :
            <ul>
              <li>Tambah Kriteria hanya dapat dilakukan dalam kurun waktu yang telah ditentukan panitia.</li>
              <li>Status Pending, data menunggu untuk di validasi oleh panitia.</li>
              <li>Status Invalid, data sudah divalidasi oleh panitia dan dinyatakan tidak valid atau tidak diterima, anda harus menghubungi panitia.</li>
              <li>Status Valid, data sudah divalidasi oleh panitia dan dinyatakan valid atau diterima.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

 