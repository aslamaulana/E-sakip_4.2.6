<!doctype html>
<html lang="en">

<head>
	<title>SiGenah</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?= base_url('/toping/login/css/style.css') ?>">

</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<!-- <h2 class="heading-section">Login #05</h2> -->
					<?= view('Myth\Auth\Views\_message_block') ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(<?= base_url('/toping/login/images/bg-1.jpg') ?>);"></div>
						<div class="login-wrap p-4 p-md-5">

							<div class="d-flex">
								<div class="w-100 text-center">
									<h3>SiGenah</h3>
								</div>
							</div>
							<div class="d-flex">
								<div class="w-100">
									<p class="social-media d-flex text-center font-italic">
										"Sistem Informasi Pengendalian dan Evaluasi Kinerja Pembangunan Daerah"
										<!-- <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a> -->
									</p>
								</div>
							</div>
							<form action="<?= url_to('login') ?>" method="post" class="signin-form">
								<?= csrf_field() ?>
								<div class="form-group mt-3">
									<!-- <input type="text" class="form-control" required> -->
									<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
									<!-- <label class="form-control-placeholder" for="username">Username</label> -->
								</div>
								<div class="form-group">
									<!-- <input id="password-field" type="password" class="form-control" required> -->
									<input id="password-field" type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
									<!-- <label class="form-control-placeholder" for="password">Password</label> -->
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"><?= session('errors.password') ?></span>
								</div>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary rounded submit px-3"><?= lang('Auth.loginAction') ?></button>
								</div>
								<div class="form-group d-md-flex">
									<div class="w-50 text-left">
										<label class="checkbox-wrap checkbox-primary mb-0">
											<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
											<?= lang('Auth.rememberMe') ?>
											<!-- Remember Me
											<input type="checkbox" checked> -->
											<span class="checkmark"></span>
										</label>
									</div>
									<!-- <div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div> -->
								</div>
							</form>
							<!-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?= base_url('/toping/login/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('/toping/login/js/popper.js') ?>"></script>
	<script src="<?= base_url('/toping/login/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('/toping/login/js/main.js') ?>"></script>

</body>

</html>