<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('/toping/login02/fonts/icomoon/style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/login02/css/owl.carousel.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/login02/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/login02/css/style.css'); ?>">

	<title>E-Sakip</title>
</head>

<body>
	<div class="d-lg-flex half">
		<div class="bg order-1 order-md-2" style="background-image: url('<?= base_url('/toping/login02/images/bgh.jpg') ?>');"></div>
		<div class="contents order-2 order-md-1">
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div class="col-md-7">
						<div class="mb-4">
							<h3><?= lang('Auth.loginTitle') ?></h3>
							<p class="mb-4"><?= view('Myth\Auth\Views\_message_block') ?></p>
						</div>
						<form action="<?= url_to('login') ?>" method="post">
							<div class="form-group first">
								<!-- <label for="username">Username</label> -->
								<!-- <input type="text" class="form-control" id="username"> -->
								<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
							</div>
							<div class="form-group last mb-3">
								<!-- <label for="password">Password</label> -->
								<input id="password-field" type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
								<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"><?= session('errors.password') ?></span>
								<!-- <input type="password" class="form-control" id="password"> -->
							</div>

							<div class="d-flex mb-5 align-items-center">
								<label class="control control--checkbox mb-0">
									<span class="caption"><?= lang('Auth.rememberMe') ?></span>
									<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
									<!-- <input type="checkbox" checked="checked" /> -->
									<div class="control__indicator"></div>
								</label>
								<!-- <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> -->
							</div>

							<button type="submit" value="Log In" class="btn btn-block btn-primary"><?= lang('Auth.loginAction') ?></button>

							<!-- <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span> -->

							<!-- <div class="social-login">
								<a href="#" class="facebook btn d-flex justify-content-center align-items-center">
									<span class="icon-facebook mr-3"></span> Login with Facebook
								</a>
								<a href="#" class="twitter btn d-flex justify-content-center align-items-center">
									<span class="icon-twitter mr-3"></span> Login with Twitter
								</a>
								<a href="#" class="google btn d-flex justify-content-center align-items-center">
									<span class="icon-google mr-3"></span> Login with Google
								</a>
							</div> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('/toping/login02/js/jquery-3.3.1.min.js'); ?>"></script>
	<script src="<?= base_url('/toping/login02/js/popper.min.js'); ?>"></script>
	<script src="<?= base_url('/toping/login02/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('/toping/login02/js/main.js'); ?>"></script>
</body>

</html>