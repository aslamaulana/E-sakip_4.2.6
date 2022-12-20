<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Default box -->
<div class="card-body row">
	<div class="col-5 text-center d-flex align-items-center justify-content-center">
		<div class="">
			<h2><strong><?= user()->full_name; ?></strong></h2>
			<p class="lead mb-5"><?= user()->jabatan == 'kepala_opd' ? 'Kepala OPD' : (user()->jabatan == 'kepala_bidang' ? 'Kepala Bidang' : 'Pungsional'); ?><br>
				NIP: <?= user()->nip; ?>
			</p>
		</div>
	</div>
	<div class="col-7">
		<form action="<?= base_url('/user/user/users/password_update'); ?>" method="POST">
			<?= csrf_field() ?>
			<div class="form-group">
				<label>Password Baru</label>
				<input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" maxlength="20" require>
				<div class="invalid-feedback">
					<?= $validation->getError('password'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Ulangi Password Baru</label>
				<input type="password" name="password_k" class="form-control <?= ($validation->hasError('password_k')) ? 'is-invalid' : ''; ?>" maxlength="20" require>
				<div class="invalid-feedback">
					<?= $validation->getError('password_k'); ?>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Simpan">
			</div>
		</form>
	</div>
</div>
<?= $this->endSection(); ?>