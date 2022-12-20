<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $kegiatan; ?>" name="kegiatan_old">
		<input type="hidden" value="<?= $kegiatan_sub; ?>" name="kegiatan_sub_old">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kegiatan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select id="opd_kegiatan" name="opd_kegiatan" class="form-control select2bs4 <?= ($validation->hasError('opd_kegiatan')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $kegiatan; ?>"><?= $kegiatan; ?></option>
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
					<select name="opd_kegiatan_sub" id="kegiatan_id" class="form-control select2bs4 <?= ($validation->hasError('opd_kegiatan_sub')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $kegiatan_sub; ?>"><?= $kegiatan_sub; ?></option>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('opd_kegiatan_sub'); ?>
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