<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form class="row" action="<?= base_url('/user/opd/bidang/bidang_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $bidang['id_opd_bidang']; ?>" name="id_opd_bidang">
		<div class="col-md-6">
			<div class="form-group">
				<label>Kode <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang['kode']; ?>" name="kode" class="form-control" maxlength="10" required>
			</div>
			<div class="form-group">
				<label>Nama Bidang <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang['nama_bidang']; ?>" name="nama_bidang" class="form-control" maxlength="255" required>
			</div>
			<div class="form-group">
				<label>Kepala Bidang <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang['kepala_bidang']; ?>" name="kepala_bidang" class="form-control" maxlength="255" required>
			</div>
			<div class="form-group">
				<label>NIP <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang['nip']; ?>" name="nip" class="form-control" maxlength="20" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Golongan</label>
				<input type="text" value="<?= $bidang['golongan']; ?>" name="golongan" class="form-control" maxlength="20">
			</div>
			<div class="form-group">
				<label>Eselon</label>
				<input type="text" value="<?= $bidang['eselon']; ?>" name="eselon" class="form-control" maxlength="20">
			</div>
			<div class="form-check">
				<input name="aktif" class="form-check-input" type="checkbox" value="Y" id="flexCheckChecked" <?= $bidang['aktif'] == 'Y' ? 'checked' : ''; ?>>
				<label class="form-check-label" for="exampleCheck1">Jabatan Aktif</label>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>