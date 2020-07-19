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
          <h1 class="text-uppercase text-white font-weight-bold">Profile</h1>
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
            <?=$this->session->flashdata('flash') ?>
              <h2 class="mt-0 font-weight-bold text-center">Profile</h2>
              <hr class="divider-denger my-2 mb-4">
            </div>
            <div class="col-lg-12 mt-3 px-5 ml-5">
              <table>
                <?php foreach ($tampil as $t):?>
                <tr>
                  <th width="150px">NPM</th>
                  <td width="20px">:</td>
                  <td><?=$t->npm ?></td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td width="5px">:</td>
                  <td><?=$t->nama ?></td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td width="5px">:</td>
                  <td><?php if($t->jk=='l'){echo 'Laki-Laki';}else{echo 'Perempuan';} ?></td>
                </tr>
                <tr>
                  <th>Tanggal Lahir</th>
                  <td width="5px">:</td>
                  <td><?=$t->tanggalLahir ?></td>
                </tr>
                <tr>
                  <th>Tempat Lahir</th>
                  <td width="5px">:</td>
                  <td><?=$t->tempatLahir ?></td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td width="5px">:</td>
                  <td><?=$t->alamat ?></td>
                </tr>
                <tr>
                  <th>No HP</th>
                  <td width="5px">:</td>
                  <td><?=$t->noHP ?></td>
                </tr>
                <tr>
                  <th>Komisariat</th>
                  <td width="5px">:</td>
                  <td><?=$t->komisariat ?></td>
                </tr>

              <?php endforeach; ?>
              </table>
              <div class="my-2 ">
                <a href="<?=base_url('edit_profile') ?>" class="btn btn-info btn-md font-weight-bold mr-3">Edit Profile</a>
                <a href="<?=base_url('ubah_password') ?>" class="btn btn-secondary btn-md font-weight-bold">Ubah Password</a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 