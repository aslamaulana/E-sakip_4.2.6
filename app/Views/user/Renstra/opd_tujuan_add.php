<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_tujuan/opd_tujuan_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kode Tujuan <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="kode_tujuan" class="form-control" maxlength="12" require>
					<span class="text-danger"><?= $validation->getError('kode_tujuan'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Tujuan <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<textarea name="tujuan" class="form-control <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?>" required></textarea>
					<span class="text-danger"><?= $validation->getError('tujuan'); ?></span>
				</div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Indikator Tujuan <medium class="text-danger">*</medium></label>
					<textarea name="indikator_tujuan" class="form-control" placeholder="indikator tujuan" maxlength="300" rows="4" required><?= old('indikator_tujuan'); ?></textarea>
					<span class="text-danger"><?= $validation->getError('indikator_tujuan'); ?></span>
				</div>
				<div class="form-group">
					<label>Satuan <medium class="text-danger">*</medium></label>
					<select name="satuan" class="form-control select2bs4 <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" required>
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($satuan as $row) : ?>
							<option value="<?= $row['satuan']; ?>"><?= $row['satuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('satuan'); ?></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Target 2021</label>
					<input type="text" class="form-control" name="t_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2022</label>
					<input type="text" class="form-control" name="t_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2023</label>
					<input type="text" class="form-control" name="t_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2024</label>
					<input type="text" class="form-control" name="t_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2025</label>
					<input type="text" class="form-control" name="t_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2026</label>
					<input type="text" class="form-control" name="t_2026" maxlength="20" required>
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