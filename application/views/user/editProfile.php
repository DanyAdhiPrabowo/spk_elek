  <style type="text/css">
    td, th{
      padding-bottom: 1.7rem
    }
  </style>
  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Edit Profile</h1>
          <hr class=" divider my-3 mb-4" style="max-width: 10.25rem; border-width: 0.37rem;">
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
        <div class="card o-hidden border-0 shadow-lg" style="min-width: 70% !important">
          <div class="card-body">
          <div class="row">
            <div class="col-lg-12 ">
              <h2 class="mt-0 font-weight-bold text-center">Edit Profile</h2>
              <hr class="divider-denger my-2 mb-4">
            </div>
            <div class="col-lg-12 mt-3 px-5 ml-0">
              <form method="POST" action="<?=base_url('update_profile')?>">
              <?php foreach ($tampil as $t):?>
                <div class="form-group mb-3">
                  <label class="text-dark font-weight-bold">Angkatan</label>
                  <input type="text" class="form-control" placeholder="Masukkan NPM..." name="angkatan" value="<?=set_value('angkatan', $t->angkatan) ?>" readonly>
                  <?=form_error('angkatan', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark font-weight-bold">NPM</label>
                  <input type="text" class="form-control" placeholder="Masukkan NPM..." name="npm" value="<?=set_value('npm', $t->npm) ?>" readonly>
                  <?=form_error('npm', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark font-weight-bold">Nama</label>
                  <input type="text" class="form-control" placeholder="Nama Lengkap..." name="nama" value="<?=set_value('nama', $t->nama) ?>">
                  <?=form_error('nama',"<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group row">
                  <label class="text-dark control-label col-md-3 font-weight-bold">Jenis Kelamin</label>
                  <div class="col-md-12 ml-3">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="jk" id="Laki-Laki" value="l" <?=set_radio('jk', 'l') ?> <?=($t->jk=='l')?'checked':''?> >Laki-Laki
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="jk" id="Perempuan" value="p" <?=set_radio('jk', 'p') ?> <?=($t->jk=='p')?'checked':''?> >Perempuan
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 ">
                    <div class="form-group mb-1">
                      <label class="text-dark font-weight-bold">Tanggal Lahir</label>
                      <div class="input-group"  style="width: 100%">
                        <input class="form-control" id="datepicker"  type="text" placeholder="Tanggal..." name="tgl" value="<?=set_value('tgl', $t->tanggalLahir)?>">
                        <div class="input-group-append" ><span class="input-group-text"><i class="fa fa-calendar-alt"></i></span></div>
                      </div>
                      <?=form_error('tgl', "<small class='text-danger'>",'</small>') ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label class="text-dark font-weight-bold">Tempat Lahir</label>
                    <input type="text" class="form-control" placeholder="Tempat Lahir..." name="tempat" value="<?=set_value('tempat', $t->tempatLahir) ?>">
                  <?=form_error('tempat', "<small class='text-danger'>",'</small>') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleTextarea" class="text-dark font-weight-bold">Alamat</label>
                  <textarea class="form-control " id="exampleTextarea" rows="3" name="alamat"><?=set_value('alamat', $t->alamat) ?></textarea>
                  <?=form_error('alamat', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group row pb-3">
                  <div class="col-sm-6 ">
                    <label class="text-dark font-weight-bold">No HP</label>
                    <input type="text" class="form-control" placeholder="08xxxxxxx.." name="hp" onkeypress="return inputAngka(event)" value="<?=set_value('hp', $t->noHP) ?>">
                     <?=form_error('hp',"<small class='text-danger'>",'</small>') ?> 
                  </div>
                  <div class="col-sm-6">
                    <label class="text-dark font-weight-bold">Komisariat</label>
                    <select class="form-control text-dark" name="komisariat">
                      <option value="">--Pilih Komisariat--</option>
                      <?php foreach ($komisariat as $k): ?>
                        <option value="<?=$k->namaKomisariat?>" <?=($t->komisariat==$k->namaKomisariat)?'selected':''?> <?=set_select('komisariat', $k->namaKomisariat)?> ><?=$k->namaKomisariat ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?=form_error('komisariat', "<small class='text-danger'>",'</small>') ?>
                  </div>
                </div>
              <?php endforeach; ?>
              <div class="my-2 ">
                <button type="submit" class="btn btn-info btn-md font-weight-bold mr-3">Update</button>
                </form>
                <a href="<?=base_url('profile') ?>" class="btn btn-secondary btn-md font-weight-bold">Kembali</a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<script type="text/javascript">
  function inputAngka(evt){
      var charCode = (evt.charCode);
      if(charCode>32 && (charCode<48 || charCode>57) && charCode!=45)
      {
        return false;
      }
      else
      {
        return true;
      }
  }

  $(function(){
    $('#datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
    })
  });

</script>
 