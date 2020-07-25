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
                  <label class="text-dark font-weight-bold">Kode Komisariat</label>
                  <input type="text" class="form-control" placeholder="Masukkan NPM..." name="kodeKomisariat" value="<?=set_value('kodeKomisariat', $t->kodeKomisariat) ?>" readonly>
                  <?=form_error('kodeKomisariat', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark font-weight-bold">Nama Komisariat</label>
                  <input type="text" class="form-control" placeholder="Nama Komisariat..." name="namaKomisariat" value="<?=set_value('namaKomisariat', $t->namaKomisariat) ?>">
                  <?=form_error('namaKomisariat',"<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group">
                  <label for="exampleTextarea" class="text-dark font-weight-bold">Alamat</label>
                  <textarea class="form-control " id="exampleTextarea" rows="3" name="alamatKomisariat"><?=set_value('alamatKomisariat', $t->alamatKomisariat) ?></textarea>
                  <?=form_error('alamatKomisariat', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group row pb-3">
                  <div class="col-sm-12 ">
                    <label class="text-dark font-weight-bold">No HP</label>
                    <input type="text" class="form-control" placeholder="08xxxxxxx.." name="handphone" onkeypress="return inputAngka(event)" value="<?=set_value('handphone', $t->handphone) ?>">
                     <?=form_error('handphone',"<small class='text-danger'>",'</small>') ?> 
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
 