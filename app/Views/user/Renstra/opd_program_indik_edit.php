<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2">Program:</td>
			<td class="col-md-10"><?= $indik['opd_program_n']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/renstra/opd_program/opd_program_indik_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $indik['id_opd_program']; ?>" name="id">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>indik Program <medium class="text-danger">*</medium></label>
					<textarea name="indikator_program" class="form-control" placeholder="indikator program" maxlength="300" rows="4" required><?= (old('indikator_program')) ? old('indikator_program') : $indik['opd_indikator_program']; ?></textarea>
					<span class="text-danger"><?= $validation->getError('indikator_program'); ?></span>
				</div>
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
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Target 2021</label>
					<input type="text" value="<?= (old('t_2021')) ? old('t_2021') : $indik['t_2021']; ?>" class="form-control" name="t_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2022</label>
					<input type="text" value="<?= (old('t_2022')) ? old('t_2022') : $indik['t_2022']; ?>" class="form-control" name="t_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2023</label>
					<input type="text" value="<?= (old('t_2023')) ? old('t_2023') : $indik['t_2023']; ?>" class="form-control" name="t_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2024</label>
					<input type="text" value="<?= (old('t_2024')) ? old('t_2024') : $indik['t_2024']; ?>" class="form-control" name="t_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2025</label>
					<input type="text" value="<?= (old('t_2024')) ? old('t_2024') : $indik['t_2025']; ?>" class="form-control" name="t_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2026</label>
					<input type="text" value="<?= (old('t_2026')) ? old('t_2026') : $indik['t_2026']; ?>" class="form-control" name="t_2026" maxlength="20" required>
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