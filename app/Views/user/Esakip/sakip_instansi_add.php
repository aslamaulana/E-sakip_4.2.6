<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered table-sm">
		<tr>
			<td><b>[KOMPONEN]</b> <?= $sakip['komponen']; ?></td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:40px;">
					<b>[SUB KOMPONEN]</b> <?= $sakip['komponen_sub']; ?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:60px;">
					<b>[KRITERIA]</b> <?= $sakip['kriteria']; ?>
				</div>
			</td>
		</tr>
	</table><br><br>
	<form action="<?= base_url('/user/esakip/sakip_instansi/sakip_instansi_create') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $sakip['id_sakip_instansi']; ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Jawaban <medium class="text-danger">*</medium></label>
					<textarea name="jawaban" class="form-control" placeholder="Jawaban" maxlength="300" rows="8" required></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Link Evidence 1</label>
					<input type="text" class="form-control" name="e_1" maxlength="255" required>
				</div>
				<div class="form-group">
					<label>Link Evidence 2</label>
					<input type="text" class="form-control" name="e_2" maxlength="255">
				</div>
				<div class="form-group">
					<label>Link Evidence 3</label>
					<input type="text" class="form-control" name="e_3" maxlength="255">
				</div>
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>