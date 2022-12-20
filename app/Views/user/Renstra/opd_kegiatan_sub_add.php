<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kegiatan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select id="opd_kegiatan" name="opd_kegiatan" class="form-control select2bs4 <?= ($validation->hasError('opd_kegiatan')) ? 'is-invalid' : ''; ?>" required>
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($opd_kegiatan as $row) : ?>
							<option value="<?= $row['opd_kegiatan_n']; ?>"><?= '[' . $row['id_kegiatan'] . '] ' . $row['opd_kegiatan_n']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('opd_kegiatan'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sub Kegiatan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="opd_kegiatan_sub" id="kegiatan_id" class="form-control select2bs4 <?= ($validation->hasError('opd_kegiatan_sub')) ? 'is-invalid' : ''; ?>" required> </select>
					<div class="invalid-feedback">
						<?= $validation->getError('opd_kegiatan_sub'); ?>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Indikator Sub Kegiatan <medium class="text-danger">*</medium></label>
					<textarea name="indikator_kegiatan_sub" class="form-control" placeholder="indikator kegiatan" maxlength="300" rows="4" required><?= old('indikator_kegiatan_sub'); ?></textarea>
					<span class="text-danger"><?= $validation->getError('indikator_kegiatan_sub'); ?></span>
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
			<div class="col-md-3">
				<div class="form-group">
					<label>Target 2021</label>
					<input type="text" value="<?= old('t_2021'); ?>" class="form-control" name="t_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2022</label>
					<input type="text" value="<?= old('t_2022'); ?>" class="form-control" name="t_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2023</label>
					<input type="text" value="<?= old('t_2023'); ?>" class="form-control" name="t_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2024</label>
					<input type="text" value="<?= old('t_2024'); ?>" class="form-control" name="t_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2025</label>
					<input type="text" value="<?= old('t_2025'); ?>" class="form-control" name="t_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2026</label>
					<input type="text" value="<?= old('t_2026'); ?>" class="form-control" name="t_2026" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Pagu 2021</label>
					<input type="number" step="any" value="<?= old('rp_2021'); ?>" class="form-control" name="rp_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Pagu 2022</label>
					<input type="number" step="any" value="<?= old('rp_2022'); ?>" class="form-control" name="rp_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Pagu 2023</label>
					<input type="number" step="any" value="<?= old('rp_2023'); ?>" class="form-control" name="rp_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Pagu 2024</label>
					<input type="number" step="any" value="<?= old('rp_2024'); ?>" class="form-control" name="rp_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Pagu 2025</label>
					<input type="number" step="any" value="<?= old('rp_2025'); ?>" class="form-control" name="rp_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Pagu 2026</label>
					<input type="number" step="any" value="<?= old('rp_2026'); ?>" class="form-control" name="rp_2026" maxlength="20" required>
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
<script>
	$(function() {

		$('.select2bs4').select2({
			width: 'resolve',
			theme: 'bootstrap4',
			placeholder: 'Tidak Dipilih...'
		})
	});

	$(document).ready(function() {
		$('#opd_kegiatan').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/renstra/opd_kegiatan_sub/ambilopdsubkegiatan'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					html = '<option value="">Pilih..</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].sub_kegiatan + '">' + '[' + data[i].id_sub_kegiatan + '] ' + data[i].sub_kegiatan + '</option>';
					}
					$('#kegiatan_id').html(html);

				}
			});
			return false;
		});

	});
</script>
<?= $this->endSection(); ?>