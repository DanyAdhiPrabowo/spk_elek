

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
                <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Edit Data <?=$section ?></h1>
              </div>
              <form class="user" method="POST" action="<?=base_url('admin/peserta/update')?>">
                <?php foreach ($tampil as $t): ?>
                  <input type="hidden" name="id" value="<?=str_replace(['=','+','/'], ['-','_','~'], $this->encrypt->encode($t->npm)) ?>">
                <div class="form-group mb-3">
                  <label class="text-dark">Tahun</label>
                  <input type="text" class="form-control" placeholder="Tahun Angkatan..." name="angkatan" value="<?=set_value('angkatan', $t->angkatan) ?>" onkeypress="return inputAngka(event)" readonly>
                  <?=form_error('angkatan', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark">NPM</label>
                  <input type="text" class="form-control" placeholder="Masukkan NPM..." name="npm" value="<?=set_value('npm', $t->npm) ?>" readonly>
                  <?=form_error('npm', "<small class='text-danger'>",'</small>') ?>
                  <input type="hidden" name="oldNpm" value="<?=$t->npm ?>" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark">Nama</label>
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
                <hr>
                <div class="d-flex">
                <button type="submit" class="btn btn-primary mr-3">Simpan</button>
              <?php endforeach ?>
              </form>        
              <a href="<?=base_url('admin/peserta') ?>" class="btn btn-secondary">Kembali</a>
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
