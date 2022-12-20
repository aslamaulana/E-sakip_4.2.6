<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/admin/user/users/users_update'); ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= kunci($users['id']); ?>">
		<input type="hidden" name="opd_id" value="<?= $bidang; ?>">
		<div class="col-md">
			<div class="form-group">
				<label>Nama Pengguna</label>
				<input type="text" name="nm" value="<?= $users['full_name']; ?>" class="form-control" placeholder=" Nama Pengguna" maxlength="255" required>
				<div class="invalid-feedback">
					<?= $validation->getError('nm'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" value="<?= $users['username']; ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder=" Username" maxlength="255" required>
				<div class="invalid-feedback">
					<?= $validation->getError('username'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>E-mail</label>
				<input type="text" name="email" value="<?= $users['email']; ?>" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" maxlength="255" require>
				<div class="invalid-feedback">
					<?= $validation->getError('email'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Aktive</label>
				<div class="form-check">
					<input name="active" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" <?= $users['active'] == '1' ? 'checked' : ''; ?>>
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