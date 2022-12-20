<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2">Sasaran PD:</td>
			<td class="col-md-10"><?= $sasaran_opd; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/renstra/opd_program_sasaran/opd_program_sasaran_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran Program</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="hidden" name="sasaran_opd" value="<?= $sasaran_opd; ?>">
					<input type="text" name="program_sasaran" class="form-control <?= ($validation->hasError('program_sasaran')) ? 'is-invalid' : ''; ?>" maxlength="300" require>
					<span class="text-danger"><?= $validation->getError('program_sasaran'); ?></span>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>