<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_kegiatan/opd_kegiatan_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $program; ?>" name="program_old">
		<input type="hidden" value="<?= $kegiatan; ?>" name="kegiatan_old">
		<input type="hidden" value="<?= $kegiatan_sasaran; ?>" name="kegiatan_sasaran_old">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Program</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select id="opd_program" name="opd_program" class="form-control select2bs4 <?= ($validation->hasError('opd_program')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $program; ?>"><?= $program; ?></option>
						<?php foreach ($opd_program as $row) : ?>
							<option value="<?= $row['opd_program_n']; ?>"><?= '[' . $row['id_program'] . '] ' . $row['opd_program_n']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= $validation->getError('opd_program'); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran Kegiatan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select id="opd_kegiatan_sasaran" name="opd_kegiatan_sasaran" class="form-control select2bs4 <? //= ($validation->hasError('opd_kegiatan_sasaran')) ? 'is-invalid' : ''; 
																													?>" required>
						<option value="<? //= $kegiatan_sasaran; 
										?>"><? //= $kegiatan_sasaran; 
											?></option>
						<?php //foreach ($opd_kegiatan_sasaran as $row) : 
						?>
							<option value="<? //= $row['opd_kegiatan_sasaran']; 
											?>"><? //= $row['opd_kegiatan_sasaran']; 
												?></option>
						<?php // endforeach; 
						?>
					</select>
					<div class="invalid-feedback">
						<? //= $validation->getError('opd_kegiatan_sasaran'); 
						?>
					</div>
				</div>
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kegiatan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="opd_kegiatan" id="kegiatan_id" class="form-control select2bs4 <?= ($validation->hasError('opd_kegiatan')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $kegiatan; ?>"><?= $kegiatan; ?></option>
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
					<label>Sasaran Kegiatan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" value="<?= $kegiatan_sasaran; ?>" class="form-control" name="opd_kegiatan_sasaran" maxlength="300" required>
				</div>
				<div class="invalid-feedback">
					<?= $validation->getError('opd_kegiatan_sasaran'); ?>
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
				url: "<?php echo base_url('user/renstra/opd_kegiatan/ambilopdkegiatan'); ?>",
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
						html += '<option value="' + data[i].kegiatan + '">' + '[' + data[i].id_kegiatan + '] ' + data[i].kegiatan + '</option>';
					}
					$('#kegiatan_id').html(html);

				}
			});
			return false;
		});

	});
</script>
<?= $this->endSection(); ?>