<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2 font-weight-bold">Bidang:</td>
			<td class="col-md-10"><?= $bidang['nama_bidang']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2 font-weight-bold">Kode Bidang:</td>
			<td class="col-md-10"><?= $bidang['kode']; ?></td>
		</tr>
	</table><br>
	<form class="row" action="<?= base_url('/user/opd/bidang/bidang_sub_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" value="<?= $bidang_sub['id_opd_bidang_sub']; ?>" name="id_opd_bidang_sub">
		<div class="col-md-5">
			<div class="form-group">
				<label>Kode <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang_sub['kode_sub']; ?>" name="kode_sub" class="form-control" maxlength="10" required>
			</div>
			<div class="form-group">
				<label>Nama Bidang <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang_sub['nama_bidang_sub']; ?>" name="nama_bidang_sub" class="form-control" maxlength="255" required>
			</div>
			<div class="form-group">
				<label>Kepala Bidang <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang_sub['kepala_bidang_sub']; ?>" name="kepala_bidang_sub" class="form-control" maxlength="255" required>
			</div>
			<div class="form-group">
				<label>NIP <medium class="text-danger">*</medium></label>
				<input type="text" value="<?= $bidang_sub['nip_sub']; ?>" name="nip_sub" class="form-control" maxlength="20" required>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>Golongan</label>
				<input type="text" value="<?= $bidang_sub['golongan_sub']; ?>" name="golongan_sub" class="form-control" maxlength="20">
			</div>
			<div class="form-group">
				<label>Eselon</label>
				<input type="text" value="<?= $bidang_sub['eselon_sub']; ?>" name="eselon_sub" class="form-control" maxlength="20">
			</div>
			<div class="form-check">
				<input name="aktif_sub" class="form-check-input" type="checkbox" value="Y" id="flexCheckChecked" <?= $bidang_sub['aktif_sub'] == 'Y' ? 'checked' : ''; ?>>
				<label class="form-check-label" for="exampleCheck1">Jabatan Aktif</label>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>