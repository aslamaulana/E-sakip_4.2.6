<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_strategi/opd_strategi_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<select name="sasaran" class="form-control select2bs4" required>
						<option value="">Tidak Dipilih...</option>
						<?php foreach ($opd_sasaran as $row) : ?>
							<option value='{"kode":"<?= $row['opd_kode_sasaran']; ?>","sasaran":"<?= $row['opd_sasaran']; ?>"}'><?= '[ ' . $row['opd_kode_sasaran'] . ' ] ' . $row['opd_sasaran']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Strategi</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<textarea name="strategi" class="form-control" maxlength="300" required></textarea>
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