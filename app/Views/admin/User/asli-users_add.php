<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/admin/user/users/users_create'); ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= kunci($users_id); ?>">
		<input type="hidden" name="akses" value="<?= $opd_id; ?>">
		<div class="row">
			<div class="col-md-6">
				<!--  -->
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder=" Username" maxlength="255" required>
					<div class="invalid-feedback">
						<?= $validation->getError('username'); ?>
					</div>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" maxlength="255" require>
					<div class="invalid-feedback">
						<?= $validation->getError('password'); ?>
					</div>
				</div>
				<div class="form-group">
					<label>Ulangi Password</label>
					<input type="password" name="password_k" class="form-control <?= ($validation->hasError('password_k')) ? 'is-invalid' : ''; ?>" maxlength="255" require>
					<div class="invalid-feedback">
						<?= $validation->getError('password_k'); ?>
					</div>
				</div>
				<!-- <div class="form-group">
					<label>E-mail</label>
					<input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" maxlength="255" require>
					<div class="invalid-feedback">
						<?= $validation->getError('email'); ?>
					</div>
				</div> -->
				<div class="form-group">
					<label>Aktive</label>
					<div class="form-check">
						<input name="active" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
					</div>
				</div>

			</div>
			<?php if ($jabatan == 'kepala_opd') : ?>
				<div class="col-md-6">
					<input type="hidden" name="jabatan" value="kepala_opd">
					<input type="hidden" name="nama_singkat_bidang" value="">
					<input type="hidden" name="nama_panjang_bidang" value="">
					<!--  -->
					<div class="form-group">
						<label>Nama Kepala OPD</label>
						<input type="text" name="nm" class="form-control" placeholder=" Nama Kepala" maxlength="255" required>
						<div class="invalid-feedback">
							<?= $validation->getError('nm'); ?>
						</div>
					</div>
					<div class="form-group">
						<label>NIP</label>
						<input type="text" name="nip" class="form-control" maxlength="25" required>
					</div>
					<div class="form-group">
						<label>Golongan</label>
						<input type="text" name="golongan" class="form-control" maxlength="20" require>
					</div>
					<div class="form-group">
						<label>Eselon</label>
						<input type="text" name="eselon" class="form-control" maxlength="20" require>
					</div>
				</div>
			<?php elseif ($jabatan == 'kepala_bidang') : ?>
				<div class="col-md-6">
					<input type="hidden" name="jabatan" value="kepala_bidang">
					<div class="form-group">
						<label>Nama Singkat Bidang</label>
						<input type="text" name="nama_singkat_bidang" class="form-control" maxlength="20" required>
					</div>
					<div class="form-group">
						<label>Nama Panjang Bidang</label>
						<input type="text" name="nama_panjang_bidang" class="form-control" maxlength="255" required>
					</div>
					<div class="form-group">
						<label>Nama Kepala Bidang</label>
						<input type="text" name="nm" class="form-control" placeholder=" Nama Kepala" maxlength="255" required>
						<div class="invalid-feedback">
							<?= $validation->getError('nm'); ?>
						</div>
					</div>
					<div class="form-group">
						<label>NIP</label>
						<input type="text" name="nip" class="form-control" maxlength="25" required>
					</div>
					<div class="form-group">
						<label>Golongan</label>
						<input type="text" name="golongan" class="form-control" maxlength="20" require>
					</div>
					<div class="form-group">
						<label>Eselon</label>
						<input type="text" name="eselon" class="form-control" maxlength="20" require>
					</div>
				</div>
			<?php elseif ($jabatan == 'pungsional') : ?>
				<div class="col-md-6">
					<input type="hidden" name="jabatan" value="pungsional">
					<input type="hidden" name="nama_singkat_bidang" value="<?= $nama_bidang['nama_singkat_bidang']; ?>">
					<input type="hidden" name="nama_panjang_bidang" value="<?= $nama_bidang['nama_panjang_bidang']; ?>">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nm" class="form-control" maxlength="255" required>
						<div class="invalid-feedback">
							<?= $validation->getError('nm'); ?>
						</div>
					</div>
					<div class="form-group">
						<label>NIP</label>
						<input type="text" name="nip" class="form-control" maxlength="25" required>
					</div>
					<div class="form-group">
						<label>Golongan</label>
						<input type="text" name="golongan" class="form-control" maxlength="20" require>
					</div>
				</div>
			<?php endif ?>
			<!-- /.card-body -->
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</div>
</form>
<?= $this->endSection(); ?>