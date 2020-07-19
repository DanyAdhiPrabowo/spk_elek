<!DOCTYPE html>
<html>
<head>
	<!-- Karakter encoding -->
	<meta charset="utf-8">
	<!-- 
		Perintah agar lebar viewport mengikuti lebar perangkat
		dan skala mengikuti ukuran ketika web di-load
	 -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>User - Login</title>
	<!-- Load bootstrap stylesheet -->
	<link rel="stylesheet" href="<?=base_url('assets/user/login/')?>bootstrap/css/bootstrap.min.css">
	<!-- Load login stylesheet -->
	<link rel="stylesheet" href="<?=base_url('assets/user/login/')?>css/login.css">
	<style type="text/css">
		body{
			background-image: url('<?=base_url('assets/user/login/img/seigaiha.png') ?>');
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="card card-login">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-12">
						<div class="padding text-center align-items-center d-flex" style="background: #b95151 !important">
							<div id="particles-js"></div>
							<div class="w-100">
								<div class="mb-4">
									<img src="<?=base_url('assets/')?>img/imm2.png" alt="kodinger logo" class="img-fluid" width=120px>
								</div>
								<h4 class="text-light mb-2">Belum Mendaftar?</h4>
								<p class="lead text-light">Daftarkan diri anda sekarang dengan cara menghubungi panitia.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="padding">
							<h2 class="text-center">Login</h2>
							<hr style="margin-top: -10px; max-width: 3rem; border-width: 0.2rem;">
							<?=$this->session->flashdata('flash') ?>	
							<form autocomplete="off" method="POST" action="<?=base_url('user/auth') ?>">
								<div class="form-group mt-3">
									<label for="username" class="text-dark">Username</label>
									<input type="text" name="username" class="form-control border" id="username" tabindex="1">
								</div>
								<div class="form-group ">
									<label class="d-block text-dark" for="password">
										Password
									</label>
									<input type="password" name="password" class="form-control border" id="password" tabindex="2">
								</div>
								<div class="form-group text-right">
									<button class="btn btn-danger" tabindex="3">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?=base_url('assets/user/login/')?>js/particles.js"></script>
	<script>
		particlesJS.load('particles-js', '<?=base_url('assets/user/login/')?>particlesjs-config.json', function() {
		  console.log('callback - particles.js config loaded');
		});
	</script>
</body>
</html>