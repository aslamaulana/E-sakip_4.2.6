<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/dpa/dpa_indikator/dpa_indikator_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id_dpa" value="<?= $id_dpa; ?>">
		<input type="hidden" name="id_dpa_indikator" value="<?= $id_dpa_indikator['id_dpa_indikator']; ?>">
		<input type="hidden" name="nm" value="<?= $nm; ?>">
		<div class="card-body row">
			<div class="col-md">
				<div class="form-group">
					<label>Indikator</label>
					<textarea name="indikator" class="form-control" rows="4"><?= $id_dpa_indikator['indikator']; ?></textarea>
				</div>
			</div>
			<div class="col-md">
				<div class="form-group">
					<label>Tipe</label>
					<div class="input-group">
						<select id="type" name="type" class="form-control select2bs4 <?= ($validation->hasError('type')) ? 'is-invalid' : ''; ?>" required>
							<option value="<?= $id_dpa_indikator['type']; ?>"><?= $id_dpa_indikator['type']; ?></option>
							<option value="Keluaran">Keluaran</option>
							<option value="Hasil">Hasil</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label>Satuan</label>
					<div class="input-group">
						<select id="satuan" name="satuan" class="form-control select2bs4 <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" required>
							<option value="<?= $id_dpa_indikator['id_satuan']; ?>"><?= $id_dpa_indikator['satuan']; ?></option>
							<?php foreach ($satuan as $row) : ?>
								<option value="<?= $row['id_satuan']; ?>"><?= $row['satuan']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label>Target Akhir</label>
					<input type="text" name="target_akhir" value="<?= $id_dpa_indikator['target_akhir']; ?>" class="form-control" maxlength="20">
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