<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/rkpd/opd_kegiatan_sub/opd_kegiatan_sub_indik_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $indik['id_rkpd_kegiatan_sub']; ?>" name="id">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Satuan <medium class="text-danger">*</medium></label>
					<select name="satuan" class="form-control select2bs4 <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $indik['satuan']; ?>"><?= $indik['satuan']; ?></option>
						<?php foreach ($satuan as $row) : ?>
							<option value="<?= $row['satuan']; ?>"><?= $row['satuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('satuan'); ?></span>
				</div>
				<div class="form-group">
					<label>Lokasi</label>
					<input type="text" value="<?= $indik['lokasi']; ?>" class="form-control" name="lokasi" maxlength="255" required>
				</div>
				<div class="form-group">
					<label>Sumber Dana</label>
					<input type="text" value="<?= $indik['sumber_dana']; ?>" class="form-control" name="sumber_dana" maxlength="255" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Target <?= $_SESSION['tahun']; ?></label>
					<input type="text" value="<?= (old('t_tahun')) ? old('t_tahun') : $indik['t_tahun']; ?>" class="form-control" name="t_tahun" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Pagu <?= $_SESSION['tahun']; ?></label>
					<input type="number" step=any value="<?= (old('rp_tahun')) ? old('rp_tahun') : $indik['rp_tahun']; ?>" class="form-control" name="rp_tahun" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target <?= $_SESSION['tahun'] + 1; ?></label>
					<input type="text" value="<?= (old('t_tahun+n')) ? old('t_tahun+n') : $indik['t_tahun+n']; ?>" class="form-control" name="t_tahun+n" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Pagu <?= $_SESSION['tahun'] + 1; ?></label>
					<input type="number" step=any value="<?= (old('rp_tahun+n')) ? old('rp_tahun+n') : $indik['rp_tahun+n']; ?>" class="form-control" name="rp_tahun+n" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-12">
				<medium class="text-success">*/ Jika target kosong isikan dengan tanda strip [-]</medium>
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<script src="<?= base_url('/toping/plugins/select2/js/select2.full.min.js'); ?>"></script>
<?= $this->endSection(); ?>