

<div class="container">
  <div class="my-5">
  <?=$this->session->flashdata('flash') ?>
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-11">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Input Data <?=$section ?></h1>
              </div>
              <form class="user" method="POST" action="<?=base_url('admin/komisariat/save')?>">
                <div class="form-group mb-3">
                  <label class="text-dark">Kode Komisariat</label>
                  <input type="text" class="form-control" placeholder="Masukkan kode komisariat..." name="kodeKomisariat" value="<?=set_value('kodeKomisariat') ?>">
                  <?=form_error('kodeKomisariat', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark">Nama Komisariat</label>
                  <input type="text" class="form-control" placeholder="Nama komisariat..." name="namaKomisariat" value="<?=set_value('namaKomisariat') ?>">
                  <?=form_error('namaKomisariat',"<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group">
                  <label for="exampleTextarea" class="text-dark font-weight-bold">Alamat Komisariat</label>
                  <textarea class="form-control " id="exampleTextarea" rows="3" name="alamatKomisariat"><?=set_value('alamatKomisariat') ?></textarea>
                  <?=form_error('alamatKomisariat', "<small class='text-danger'>",'</small>') ?>
                </div>


                <div class="form-group row pb-3">
                  <div class="col-sm-6 ">
                    <label class="text-dark font-weight-bold">No Handphone</label>
                    <input type="text" class="form-control" placeholder="08xxxxxxx.." name="handphone" onkeypress="return inputAngka(event)" value="<?=set_value('handphone') ?>">
                     <?=form_error('handphone',"<small class='text-danger'>",'</small>') ?> 
                  </div>
                </div>
                <hr>
                <div class="d-flex">
                <button type="submit" class="btn btn-primary mr-3">Simpan</button>
              </form>        
              <a href="<?=base_url('admin/komisariat') ?>" class="btn btn-secondary">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<script>
  function inputAngka(evt){
      var charCode = (evt.charCode);
      // console.log(charCode)
      // jika charCode lebih dari 31(spasi) dan carCode kurang dari 48 atau charCode besar dari 57
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
