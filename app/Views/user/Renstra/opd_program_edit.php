<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_program/opd_program_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $program; ?>" name="program_old">
		<input type="hidden" value="<?= $sasaran; ?>" name="sasaran_old">
		<input type="hidden" value="<?= $sasaran_program; ?>" name="opd_program_sasaran_old">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran Program <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="sasaran" id="sasaran" class="form-control select2bs4 <?= ($validation->hasError('sasaran')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $sasaran; ?>"><?= $sasaran; ?></option>
						<?php foreach ($opd_sasaran as $row) : ?>
							<option value="<?= $row['opd_sasaran']; ?>"><?= $row['opd_sasaran']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('sasaran'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Program <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="program" id="program" class="form-control select2bs4 <?= ($validation->hasError('program')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $program; ?>"><?= $program; ?></option>
						<?php foreach ($opd_program as $row) : ?>
							<option value="<?= $row['program_90']; ?>"><?= '[ ' . $row['id_program'] . ' ] ' . $row['program_90']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('program'); ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran Program</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" value="<?= $sasaran_program; ?>" class="form-control" name="opd_program_sasaran" maxlength="300" required>
				</div>
				<div class="invalid-feedback">
					<?= $validation->getError('opd_program_sasaran'); ?>
				</div>
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