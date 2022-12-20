<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
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
	</table><br><br>
	<form action="<?= base_url('/user/ropk/ropk_organisasi/organisasi_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id_sub" value="<?= $DT['id_ropk_organisasi_rkpd_kegiatan_sub']; ?>">
		<input type="hidden" name="id" value="<?= $organisasi['id_ropk_organisasi']; ?>">
		<input type="hidden" name="kegiatan" value="<?= $organisasi['rkpd_kegiatan']; ?>">
		<input type="hidden" name="kegiatan_sub" value="<?= $organisasi['rkpd_kegiatan_sub']; ?>">
		<input type="hidden" name="indikator_kegiatan_sub" value="<?= $organisasi['rkpd_indikator_kegiatan_sub']; ?>">
		<div class="row">
			<!-- <div class="col-md-2">
				<div class="form-group">
					<label>Kode <medium class="text-danger">*</medium></label>
					<input type="text" name="kode" class="form-control" maxlength="20" required>
				</div>
			</div> -->
			<!-- <div class="row"> -->
			<div class="col-md-3">
				<div class="form-group">
					<label>Bobot Acuan <medium class="text-danger">*</medium></label>
					<input type="text" name="bobot_acuan" id="txt1" value="<?= $organisasi['ropk_bobot_acuan']; ?>" class="form-control" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label>Tahap Aktifitas <medium class="text-danger">*</medium></label>
					<input type="text" name="aktifitas" value="<?= $organisasi['ropk_tahap_aktivitas']; ?>" class="form-control" maxlength="300" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label>Sasaran</label>
					<input type="text" name="ropk_sasaran" value="<?= $organisasi['ropk_sasaran']; ?>" class="form-control" maxlength="300" required>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Target Sasaran</label>
					<input type="number" name="ropk_sasaran_target" value="<?= $organisasi['ropk_sasaran_target']; ?>" class="form-control" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-2">
				<label>Satuan <medium class="text-danger">*</medium></label>
				<select name="satuan" class="form-control select2bs4" required>
					<option value="<?= $organisasi['ropk_sasaran_satuan']; ?>"><?= $organisasi['ropk_sasaran_satuan']; ?></option>
					<?php foreach ($satuan as $row) : ?>
						<option value="<?= $row['satuan']; ?>"><?= $row['satuan']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Januari </div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b1']; ?>' name="b1" id="b1" onkeyup="sum1();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Februari</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b2']; ?>' name="b2" id="b2" onkeyup="sum2();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Maret</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b3']; ?>' name="b3" id="b3" onkeyup="sum3();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan April</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b4']; ?>' name="b4" id="b4" onkeyup="sum4();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Mei</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b5']; ?>' name="b5" id="b5" onkeyup="sum5();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Juni</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b6']; ?>' name="b6" id="b6" onkeyup="sum6();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Juli</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b7']; ?>' name="b7" id="b7" onkeyup="sum7();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Agustus</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b8']; ?>' name="b8" id="b8" onkeyup="sum8();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan September</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b9']; ?>' name="b9" id="b9" onkeyup="sum9();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Oktober</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b10']; ?>' name="b10" id="b10" onkeyup="sum10();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan November</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b11']; ?>' name="b11" id="b11" onkeyup="sum11();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Desember</div>
					<div class="col-md-12">
						<input type="number" step="any" value='<?= $organisasi['b12']; ?>' name="b12" id="b12" onkeyup="sum12();" class="form-control" maxlength="20">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Total <i class="fa fa-question-circle" title="Akumulasi tiap bulan, tidak melebihi bobot acuan"></i></div>
					<div class="col-md-12">
						<input type="number" id="jt" class="form-control" disabled>
					</div>
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

<script>
	function total() {
		var txt1 = document.getElementById('b1').value;
		var txt2 = document.getElementById('b2').value;
		var txt3 = document.getElementById('b3').value;
		var txt4 = document.getElementById('b4').value;
		var txt5 = document.getElementById('b5').value;
		var txt6 = document.getElementById('b6').value;
		var txt7 = document.getElementById('b7').value;
		var txt8 = document.getElementById('b8').value;
		var txt9 = document.getElementById('b9').value;
		var txt10 = document.getElementById('b10').value;
		var txt11 = document.getElementById('b11').value;
		var txt12 = document.getElementById('b12').value;
		if (isNaN(txt1)) txt1 = 0;
		if (isNaN(txt2)) txt2 = 0;
		if (isNaN(txt3)) txt3 = 0;
		if (isNaN(txt4)) txt4 = 0;
		if (isNaN(txt5)) txt5 = 0;
		if (isNaN(txt6)) txt6 = 0;
		if (isNaN(txt7)) txt7 = 0;
		if (isNaN(txt8)) txt8 = 0;
		if (isNaN(txt9)) txt9 = 0;
		if (isNaN(txt10)) txt10 = 0;
		if (isNaN(txt11)) txt11 = 0;
		if (isNaN(txt12)) txt12 = 0;
		var result = parseFloat(txt1) + parseFloat(txt2) + parseFloat(txt3) + parseFloat(txt4) + parseFloat(txt5) + parseFloat(txt6) + parseFloat(txt7) + parseFloat(txt8) + parseFloat(txt9) + parseFloat(txt10) + parseFloat(txt11) + parseFloat(txt12);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('jt').value = n;
	}
	$("#b1, #b2, #b3, #b4, #b5, #b6, #b7, #b8, #b9, #b10, #b11, #b12").keyup(function() {
		total();
	});
</script>
<?= $this->endSection(); ?>