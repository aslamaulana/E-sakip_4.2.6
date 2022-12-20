<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col">
			<table class="table table-bordered">
				<tr>
					<td><b>Program</b></td>
					<td><?= isset($emonev_program['program']) ? $emonev_program['program'] : ''; ?></td>
				</tr>
				<tr>
					<td><b>Kegiatan</b></td>
					<td><?= isset($emonev_program['kegiatan']) ?  $emonev_program['kegiatan'] : ''; ?></td>
				</tr>
				<tr>
					<td><b>Sub Kegiatan</b></td>
					<td><?= isset($emonev_program['sub_kegiatan']) ?  $emonev_program['sub_kegiatan'] : ''; ?></td>
				</tr>
				<tr>
					<td><b>Bulan</b></td>
					<td><?= isset($bulan) ?  $bulan : ''; ?></td>
				</tr>
			</table><br>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<form action="<?= base_url('/user/emonev/emonev/progres_create'); ?>" method="POST">
				<?= csrf_field() ?>
				<input type="hidden" name="bulan" value="<?= $b; ?>">
				<input type="hidden" name="dpa_id" value="<?= $dpa_id; ?>">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Tahapan pekerjaan (fisik) yang sudah dilakukan </label>
							<textarea rows="3" type="text" name="tahap_fisik" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Faktor Penghambat </label>
							<input type="text" name="penghambat" class="form-control" maxlength="500">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Faktor Pendukung </label>
							<input type="text" name="pendukung" class="form-control" maxlength="500">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Realisasi Keuangan Hingga Bulan Maret (Rp) </label>
							<input type="number" name="keu" class="form-control" maxlength="20">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Realisasi Fisik Hingga Bulan Maret (%) <medium class="text-danger">*</medium></label>
							<input type="number" name="fis" class="form-control" maxlength="20" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>