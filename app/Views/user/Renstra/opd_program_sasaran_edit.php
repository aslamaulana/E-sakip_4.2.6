<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2">Sasaran PD:</td>
			<td class="col-md-10"><?= $program_sasaran['opd_sasaran_n']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/renstra/opd_program_sasaran/opd_program_sasaran_update') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran Program</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="hidden" name="id" value="<?= $program_sasaran['id_opd_program_sasaran']; ?>">
					<input type="text" name="program_sasaran" value="<?= $program_sasaran['opd_program_sasaran']; ?>" class="form-control <?= ($validation->hasError('program_sasaran')) ? 'is-invalid' : ''; ?>" maxlength="300" require>
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