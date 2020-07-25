  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Tambah Data Kriteria</h1>
          <hr class="my-3 mb-4" style="max-width: 35.25rem; border-width: 0.37rem; border-color: #f4623a;">
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

        <div class="card o-hidden border-0 shadow-lg">
          <div class="card-body">
            <?=$this->session->flashdata('flash') ?>
            <div class="col-lg-12 ">
              <h2 class="mt-0 font-weight-bold text-center">Tambah Data</h2>
              <hr class="divider-denger my-2 mb-4">
            </div>
            <div class="col-lg-12 mt-3">
              <form method="POST" action="<?=base_url('save_kriteria')?>" enctype="multipart/form-data">
                <div class="form-group mb-3">
                  <label class="font-weight-bold">Kegiatan</label>
                  <input type="text" class="form-control" placeholder="Nama Kegiatan..." name="kegiatan" value="<?=set_value('kegiatan') ?>">
                  <?=form_error('kegiatan', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group row pb-3">
                  <div class="col-sm-6">
                    <label class="text-dark font-weight-bold">Tingkatan</label>
                    <select class="form-control text-dark" name="tingkatan">
                      <option value="">--Pilih Tingkatan--</option>
                      <option value="1" <?=set_select('tingkatan','1')?> >Nasional</option>
                      <option value="2" <?=set_select('tingkatan','2')?> >Provinsi</option>
                      <option value="3" <?=set_select('tingkatan','3')?> >Kabupaten / Kota</option>
                      <option value="4" <?=set_select('tingkatan','4')?> >Universitas</option>
                      <option value="5" <?=set_select('tingkatan','5')?> >Fakultas</option>
                    </select>
                    <?=form_error('tingkatan', "<small class='text-danger'>",'</small>') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="font-weight-bold">Upload Foto</label>
                  <input type="file" class="form-control-file" name="foto">
                </div>
                <hr style="margin-bottom:10px; margin-top: 40px ">
                
                <div class="d-flex">
                  <button class="btn btn-md btn-info mr-2">Upload</button>
              </form>
                  <a href="<?=base_url('kriteria') ?>" class="btn btn-md btn-secondary">Kembali</a>
                </div> <!-- end d-Flex -->

              <div class="mt-5" style="font-size: 11.5px">
                Peringatan :
                <ul>
                  <li>Data yang sudah diupload tidak bisa diubah, anda harus cermat dan teliti sebelum melakukan upload data.</li>
                  <li>Foto yang diupload hanya yang berekstensi <b>JPG</b>, <b>JPEG</b>, dan <b>PNG</b> dan ukuran maksimal file hanya <b>2 MB</b></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 