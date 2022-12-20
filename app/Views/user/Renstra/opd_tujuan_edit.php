<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_tujuan/opd_tujuan_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="kode_tujuan_old" value="<?= $tujuan['opd_kode_tujuan']; ?>">
		<input type="hidden" name="tujuan_old" value="<?= $tujuan['opd_tujuan']; ?>">

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Kode Tujuan <medium class="text-danger">*</medium></label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="kode_tujuan" value="<?= $tujuan['opd_kode_tujuan']; ?>" class="form-control" maxlength="12" require>
					<span class="text-danger"><?= $validation->getError('opd_kode_tujuan'); ?></span>
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
					<textarea name="tujuan" class="form-control <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?>" required><?= $tujuan['opd_tujuan']; ?></textarea>
					<span class="text-danger"><?= $validation->getError('tujuan'); ?></span>
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