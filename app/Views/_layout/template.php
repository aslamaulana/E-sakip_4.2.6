<!DOCTYPE html>
<html lang="en">
<?= $this->include('_layout/header'); ?>

<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
	<div class="wrapper">
		<?= $this->include('_layout/navbar'); ?>
		<?= $this->include('_layout/sidebar'); ?>
		<div class="content-wrapper">
			<?php if (session()->getFlashdata('pesan')) : ?>
				<script>
					swal.fire({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						icon: 'success',
						title: '<?= session()->getFlashdata('pesan'); ?>',
						text: ''
					});
				</script>
			<?php elseif (session()->getFlashdata('error')) : ?>
				<script>
					swal.fire({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						icon: 'error',
						title: '<?= session()->getFlashdata('error'); ?>',
						text: ''
					});
				</script>
			<?php elseif (session()->getFlashdata('tahun2')) : ?>
				<script>
					Swal.fire({
						icon: 'success',
						title: '<?= session()->getFlashdata('tahun2'); ?>',
						text: 'Data Diatur Pada Tahun'
						// footer: '<a href="">Why do I have this issue?</a>'
					});
				</script>
			<?php endif ?>
			<section class="content">
				<div class="content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-left">
									<fount style="color: gray;"><b>Home</b> -> <?= $lok; ?></fount>
								</ol>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<?= $this->renderSection('tombol'); ?>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<div class="card shadow <?= !isset($_SESSION['max']) ? '' : $_SESSION['max']; ?>">
					<div class="card-header" style="background: #343a40;">
						<div class="card-tools">
							<a type="button" class="btn btn-tool btn-xs" onclick="location.href = '<?= isset($_SESSION['max']) ? base_url('/home/max/min') : base_url('/home/max/max'); ?>'">
								<i class="fas fa-expand"></i>
							</a>
							<button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<?= $this->renderSection('content'); ?>
				</div>
			</section>
		</div>
	</div>
</body>
<?= $this->include('_layout/footer') ?>