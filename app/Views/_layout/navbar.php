<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item">
			<select class="form-control" onchange="location = this.value;">
				<option <?= $_SESSION['tahun'] == '2021' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2021'); ?>">2021</option>
				<option <?= $_SESSION['tahun'] == '2022' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2022'); ?>">2022</option>
				<option <?= $_SESSION['tahun'] == '2023' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2023'); ?>">2023</option>
				<option <?= $_SESSION['tahun'] == '2024' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2024'); ?>">2024</option>
			</select>
		</li>&nbsp;

		<li class="nav-item d-none d-sm-inline-block">
			<a style="pointer-events: none" class="nav-link"><?= opd()->name; ?></a>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
		<?php if (menu('renstra')->timer_a == 'aktif' || menu('renja')->timer_a == 'aktif') { ?>
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i id="area" class="fa fa-stopwatch fa-2x" style="color:red;"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-item dropdown-header">Timer</span>
					<?php if (menu('renja')->timer_a == 'aktif') { ?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item">
							RENJA <i class="fa mr-2" id="timer_renja"></i>
						</a>
					<?php } ?>
					<?php if (menu('renstra')->timer_a == 'aktif') { ?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item">
							RENSTRA <i class="fa mr-2" id="timer_renstra"></i>
						</a>
					<?php } ?>
				</div>
			</li>
		<?php } ?>
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<div class="image">
					<img src="<?= base_url('/toping/dist/img/user2-160x160.jpg') ?>" class="img-size-32 mr-3 img-circle" alt="User Image">
				</div>
				<span class="badge badge-success navbar-badge">&nbsp;&nbsp;</span>
			</a>
			<div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
				<a class="dropdown-item text-center">
					<p><?= user()->full_name; ?><br>
						Nip: <?= user()->nip; ?></p>
				</a>
				<span class="dropdown-item dropdown-header"></span>
				<div class="dropdown-divider"></div>
				<?php if (has_permission('Admin')) : ?>
					<a href="<?= base_url('/admin/user/users/ubah_password'); ?>" class="dropdown-item">
						<i class="fa fa-key mr-2"></i> Ubah Password
					</a>
				<?php else : ?>
					<a href="<?= base_url('/user/user/users/ubah_password'); ?>" class="dropdown-item">
						<i class="fa fa-key mr-2"></i> Ubah Password
					</a>
				<?php endif ?>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('/logout'); ?>" class="dropdown-item">
					<i class="fa fa-reply mr-2"></i> LogOut
				</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
	</ul>
</nav>

<?php if (menu('renstra')->timer_a == 'aktif') { ?>
	<script>
		// Mengatur waktu akhir perhitungan mundur
		var countDownDateRenstra = new Date("<?= menu('renstra')->timer; ?>").getTime();

		// Memperbarui hitungan mundur setiap 1 detik
		var x = setInterval(function() {
			// Untuk mendapatkan tanggal dan waktu hari ini
			var nowRenstra = new Date().getTime();
			// Temukan jarak antara sekarang dan tanggal hitung mundur
			var distanceRenstra = countDownDateRenstra - nowRenstra;
			// Perhitungan waktu untuk hari, jam, menit dan detik
			var daysRenstra = Math.floor(distanceRenstra / (1000 * 60 * 60 * 24));
			var hoursRenstra = Math.floor((distanceRenstra % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutesRenstra = Math.floor((distanceRenstra % (1000 * 60 * 60)) / (1000 * 60));
			var secondsRenstra = Math.floor((distanceRenstra % (1000 * 60)) / 1000);
			// Keluarkan hasil dalam elemen dengan id = "demo"
			document.getElementById("timer_renstra").innerHTML = daysRenstra + "d " + hoursRenstra + "h " +
				minutesRenstra + "m " + secondsRenstra + "s ";
			// Jika hitungan mundur selesai, tulis beberapa teks 
			if (distanceRenstra < 0) {
				clearInterval(x);
				document.getElementById("timer_renstra").innerHTML = "EXPIRED";
				window.location.href = "<?php echo base_url('/admin/menu/menu/set/' . menu('renstra')->id_menu); ?>";
			}
		}, 1000);
	</script>
<?php }	?>
<?php if (menu('renja')->timer_a == 'aktif') { ?>
	<script>
		// Mengatur waktu akhir perhitungan mundur
		var countDownDateRenja = new Date("<?= menu('renja')->timer; ?>").getTime();

		// Memperbarui hitungan mundur setiap 1 detik
		var x = setInterval(function() {
			// Untuk mendapatkan tanggal dan waktu hari ini
			var nowRenja = new Date().getTime();
			// Temukan jarak antara sekarang dan tanggal hitung mundur
			var distanceRenja = countDownDateRenja - nowRenja;
			// Perhitungan waktu untuk hari, jam, menit dan detik
			var daysRenja = Math.floor(distanceRenja / (1000 * 60 * 60 * 24));
			var hoursRenja = Math.floor((distanceRenja % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutesRenja = Math.floor((distanceRenja % (1000 * 60 * 60)) / (1000 * 60));
			var secondsRenja = Math.floor((distanceRenja % (1000 * 60)) / 1000);
			// Keluarkan hasil dalam elemen dengan id = "demo"
			document.getElementById("timer_renja").innerHTML = daysRenja + "d " + hoursRenja + "h " +
				minutesRenja + "m " + secondsRenja + "s ";
			// Jika hitungan mundur selesai, tulis beberapa teks 
			if (distanceRenja < 0) {
				clearInterval(x);
				document.getElementById("timer_renja").innerHTML = "EXPIRED";
				window.location.href = "<?php echo base_url('/admin/menu/menu/set/' . menu('renja')->id_menu); ?>";
			}
		}, 1000);
	</script>
<?php }	?>

<script>
	setInterval(() => {
		document.querySelector("#area").classList.toggle("isVisible");
	}, 2000);
</script>