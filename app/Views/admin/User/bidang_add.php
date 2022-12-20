<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('admin/user/bidang/bidang_create'); ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $bidang; ?>">
		<div class="col-md">
			<div class="form-group">
				<label>Nama Singkat OPD</label>
				<input type="text" name="nm" class="form-control <?= ($validation->hasError('nm')) ? 'is-invalid' : ''; ?>" placeholder=" Nama SKPD" maxlength="255" required>
				<div class="invalid-feedback">
					<?= $validation->getError('nm'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Nama Panjang OPD</label>
				<input type="text" name="detail" class="form-control" placeholder="Detail" maxlength="255" required>
			</div>
			<div class="form-group">
				<label>Akses OPD</label><br>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="akses[]" value="<?= '1'; ?>">
					<label class="form-check-label">User</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="akses[]" value="<?= '3'; ?>">
					<label class="form-check-label">Verifikator</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" disabled type="checkbox" name="akses[]" value="<?= '2'; ?>">
					<label class="form-check-label">Admin</label>
				</div>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</div>
</form>
<?= $this->endSection(); ?>