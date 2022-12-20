<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_arah_kebijakan/opd_arah_kebijakan_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $roh['id_opd_arah_kebijakan']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Strategi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="strategi" class="form-control select2bs4" required>
						<option value="<?= $roh['opd_strategi_n']; ?>"><?= $roh['opd_strategi_n']; ?></option>
						<?php foreach ($opd_strategi as $row) : ?>
							<option value="<?= $row['opd_strategi']; ?>"><?= $row['opd_strategi']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Arah Kebijakan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<textarea name="opd_arah_kebijakan" class="form-control" required><?= $roh['opd_arah_kebijakan']; ?></textarea>
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
</script>
<?= $this->endSection(); ?>