<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/dpa/dpa/dpa_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="card-body row">
			<div class="col-md">
				<div class="form-group">
					<label>Program <medium class="text-danger">*</medium></label>
					<div class="input-group">
						<select id="opd_program" name="opd_program" class="form-control select2bs4 <?= ($validation->hasError('opd_program')) ? 'is-invalid' : ''; ?>" required>
							<option value="">Tidak Dipilih...</option>
							<?php foreach ($opd_program as $row) : ?>
								<option value="<?= $row['id_opd_program']; ?>"><?= '[' . $row['id_program'] . '] ' . $row['program']; ?></option>
							<?php endforeach; ?>
						</select>
						<div class="invalid-feedback">
							<?= $validation->getError('opd_program'); ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Kegiatan <medium class="text-danger">*</medium></label>
					<div class="input-group">
						<select name="opd_kegiatan" id="opd_kegiatan" class="form-control select2bs4 <?= ($validation->hasError('opd_kegiatan')) ? 'is-invalid' : ''; ?>" required> </select>
						<div class="invalid-feedback">
							<?= $validation->getError('opd_kegiatan'); ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Sub Kegiatan <medium class="text-danger">*</medium></label>
					<div class="input-group">
						<select name="opd_kegiatan_sub" id="opd_kegiatan_sub" class="form-control select2bs4 <?= ($validation->hasError('opd_kegiatan_sub')) ? 'is-invalid' : ''; ?>" required> </select>
						<div class="invalid-feedback">
							<?= $validation->getError('opd_kegiatan_sub'); ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Sasaran Sub Kegiatan</label>
					<textarea name="sasaran_sub_kegiatan" value="<?= old('sasaran_sub_kegiatan'); ?>" class="form-control"></textarea>
				</div>
			</div>
			<div class="col-md">
				<div class="form-group">
					<label>Pagu</label>
					<input type="number" name="pagu" value="<?= old('pagu'); ?>" class="form-control" maxlength="20">
				</div>
				<div class="form-group">
					<label>Lokasi</label>
					<input type="text" name="lokasi" value="<?= old('lokasi'); ?>" class="form-control" maxlength="20">
				</div>
				<div class="form-group">
					<label>Tanggal Mulai s/d Selesai</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="date" name="tanggal_mulai" value="<?= old('tanggal_mulai'); ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
						&nbsp; s/d &nbsp;
						<input type="date" name="tanggal_selesai" value="<?= old('tanggal_selesai'); ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
					</div>
				</div>
				<div class="form-group">
					<label>Sub Unit Organisasi OPD</label>
					<div class="input-group">
						<select id="opd_bidang_sub" name="opd_bidang_sub" class="form-control select2bs4 <?= ($validation->hasError('opd_bidang_sub')) ? 'is-invalid' : ''; ?>" required>
							<option value="">Tidak Dipilih...</option>
							<?php foreach ($opd_bidang_sub as $row) : ?>
								<option value="<?= $row['id_opd_bidang_sub']; ?>"><?= '[' . $row['nama_bidang'] . '] ' . $row['nama_bidang_sub']; ?></option>
							<?php endforeach; ?>
						</select>
						<div class="invalid-feedback">
							<?= $validation->getError('opd_bidang_sub'); ?>
						</div>
					</div>
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
<script>
	$(function() {

		$('.select2bs4').select2({
			width: 'resolve',
			theme: 'bootstrap4',
			placeholder: 'Tidak Dipilih...'
		})
	});

	$(document).ready(function() {
		$('#opd_program').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/dpa/dpa/ambil_kegiatan'); ?>",
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
						html += '<option value=' + data[i].id_opd_kegiatan + '>' + '[' + data[i].id_kegiatan + '] ' + data[i].kegiatan + '</option>';
					}
					$('#opd_kegiatan').html(html);

				}
			});
			return false;
		});

	});
	$(document).ready(function() {
		$('#opd_kegiatan').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('user/dpa/dpa/ambil_kegiatan_sub'); ?>",
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
						html += '<option value=' + data[i].id_opd_kegiatan_sub + '>' + '[' + data[i].id_sub_kegiatan + '] ' + data[i].sub_kegiatan + '</option>';
					}
					$('#opd_kegiatan_sub').html(html);

				}
			});
			return false;
		});

	});
</script>
<?= $this->endSection(); ?>