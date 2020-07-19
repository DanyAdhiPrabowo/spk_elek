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
          <h1 class="text-uppercase text-white font-weight-bold">Ubah Password</h1>
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
              <h2 class="mt-0 font-weight-bold text-center">Ubah Password</h2>
              <hr class="divider-denger my-2 mb-4">
            </div>
            <div class="col-lg-12 mt-3 px-5 ml-0">
              <?=$this->session->flashdata('flash') ?>
              <form method="POST" action="<?=base_url('update_password')?>">
                <div class="form-group mb-3">
                  <label class="text-dark font-weight-bold"><i class="fa fa-lock"></i> Password Lama</label>
                  <input type="Password" class="form-control" placeholder="Masukkan Password Lama..." name="oldPass">
                  <?=form_error('oldPass',"<small class='text-danger'>",'</small>')?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark font-weight-bold"><i class="fa fa-pencil-alt"></i> Password Baru</label>
                  <input type="Password" class="form-control" placeholder="Masukkan Password Baru..." name="newPass">
                  <?=form_error('newPass',"<small class='text-danger'>",'</small>')?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark font-weight-bold"><i class="fa fa-check"></i> Password Lama</label>
                  <input type="Password" class="form-control" placeholder="konfirmasi Password Lama..." name="konfirmasi">
                  <?=form_error('konfirmasi',"<small class='text-danger'>",'</small>')?>
                </div>
              <div class="my-2 ">
                <button type="submit" class="btn btn-info btn-md font-weight-bold mr-3">Ubah</button>
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
 