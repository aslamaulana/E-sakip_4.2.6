<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<th class="col-md-6">Kegiatan / Sub Kegiatan</th>
			<th style="width:30px;" rowspan="3">&nbsp;</th>
			<th class="col-md-6">Keluaran (indikator sub kegiatan)</th>
		</tr>
		<tr>
			<td><b>[KEGIATAN]</b> <?= $DT['rkpd_kegiatan_n']; ?></td>
			<td rowspan="2" class="align-top">
				<div style="display: inline-flex;">
					<li></li>
					<div><?= ' ' . $DT['rkpd_indikator_kegiatan_sub'] . ': ' . $DT['t_tahun'] . ' ' . $DT['satuan']; ?></div>
				</div><br>
				<div style="display: inline-flex;">
					<li></li>
					<div>Rp. <?= number_format($DT['rp_tahun'], 2, ',', '.'); ?></div>
				</div><br>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:40px;">
					<b>[SUB KEGIATAN]</b> <?= $DT['rkpd_kegiatan_sub_n']; ?>
				</div>
			</td>
		</tr>
	</table><br>
	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle">Bulan</th>
				<th class="text-center" colspan="2">Target</th>
			</tr>
			<tr>
				<th class="text-center">Keuangan (Rp)</th>
				<th class="text-center">Fisik (%)</th>
			</tr>
		</thead>
		<tr>
			<td class="text-center"><?= $nm; ?></td>
			<td class="text-center"><?= $_GET['keu']; ?></td>
			<td class="text-center"><?= $_GET['fis']; ?></td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<div class="row">
		<div class="col">
			<form action="<?= base_url('/user/simonela/simonela/progres_create'); ?>" method="POST">
				<?= csrf_field() ?>
				<input type="hidden" name="id" value="<?= $DT['id_ropk_keuangan_rkpd_kegiatan_sub']; ?>">
				<input type="hidden" name="bulan" value="<?= $b; ?>">
				<input type="hidden" name="kegiatan" value="<?= $DT['rkpd_kegiatan_n']; ?>">
				<input type="hidden" name="kegiatan_sub" value="<?= $DT['rkpd_kegiatan_sub_n']; ?>">
				<input type="hidden" name="indikator_kegiatan_sub" value="<?= $DT['rkpd_indikator_kegiatan_sub']; ?>">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Tahapan pekerjaan (fisik) yang sudah dilakukan </label>
							<select name="tahap_aktifitas" id="tahap_aktifitas" class="form-control select2bs4" required>
								<option value="">Tidak Dipilih...</option>
								<?php
								$query = $db->table('tb_ropk_fisik')->getWhere([
									'tb_ropk_fisik.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'],
									'tb_ropk_fisik.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
									'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
									'tb_ropk_fisik.ropk_tahap' => 'Persiapan',
									'tb_ropk_fisik.opd_id' => user()->opd_id,
									'tb_ropk_fisik.tahun' => $_SESSION['tahun'],
									'tb_ropk_fisik.perubahan' => $_SESSION['perubahan']
								])->getResultArray();
								foreach ($query as $row) : ?>
									<option value="<?= $row['ropk_tahap_aktivitas']; ?>"><?= $row['ropk_tahap_aktivitas']; ?></option>
								<?php endforeach; ?>
							</select>
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
							<label>Realisasi Keuangan Hingga Bulan <?= $nm; ?> (Rp) </label>
							<input type="number" name="keu" class="form-control" maxlength="20">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Realisasi Fisik Hingga Bulan <?= $nm; ?> (%) <medium class="text-danger">*</medium></label>
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

<?= $this->section('Javascript'); ?>
<script src="<?= base_url('/toping/plugins/select2/js/select2.full.min.js'); ?>"></script>
<?= $this->endSection(); ?>