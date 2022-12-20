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
			<form action="<?= base_url('/user/emonev/emonev/progres_update'); ?>" method="POST">
				<?= csrf_field() ?>
				<input type="hidden" name="dpa_id" value="<?= $dpa_id; ?>">
				<input type="hidden" name="id_progres" value="<?= $progres_id['id_emonev_progres']; ?>">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Tahapan pekerjaan (fisik) yang sudah dilakukan </label>
							<textarea rows="3" type="text" name="tahap_fisik" class="form-control"><?= $progres_id['tahap_pekerjaan_fisik']; ?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Faktor Penghambat </label>
							<input type="text" name="penghambat" value="<?= $progres_id['faktor_penghambat']; ?>" class="form-control" maxlength="500">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Faktor Pendukung </label>
							<input type="text" name="pendukung" value="<?= $progres_id['faktor_pendukung']; ?>" class="form-control" maxlength="500">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Realisasi Keuangan Hingga Bulan Maret (Rp) </label>
							<input type="number" name="keu" value="<?= $progres_id['realisasi_keu']; ?>" class="form-control" maxlength="20">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Realisasi Fisik Hingga Bulan Maret (%) <medium class="text-danger">*</medium></label>
							<input type="number" name="fis" value="<?= $progres_id['realisasi_fisik']; ?>" class="form-control" maxlength="20" required>
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