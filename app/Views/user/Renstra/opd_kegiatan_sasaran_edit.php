<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2">Sasaran Program:</td>
			<td class="col-md-10"><?= $kegiatan_sasaran['opd_program_sasaran_n']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/renstra/opd_kegiatan_sasaran/opd_kegiatan_sasaran_update') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Sasaran Kegiatan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="hidden" name="id" value="<?= $kegiatan_sasaran['id_opd_kegiatan_sasaran']; ?>">
					<input type="text" name="kegiatan_sasaran" value="<?= $kegiatan_sasaran['opd_kegiatan_sasaran']; ?>" class="form-control <?= ($validation->hasError('kegiatan_sasaran')) ? 'is-invalid' : ''; ?>" maxlength="300" require>
					<span class="text-danger"><?= $validation->getError('kegiatan_sasaran'); ?></span>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>