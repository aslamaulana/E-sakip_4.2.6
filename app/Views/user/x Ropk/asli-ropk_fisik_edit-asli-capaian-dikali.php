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
			<td class="col-md-2">Tahap: </td>
			<td class="col-md-10"><?= $fisik['rkpd_kegiatan']; ?></td>
		</tr>
		<tr>
			<td>Sub Kegiatan: </td>
			<td><?= $fisik['rkpd_kegiatan_sub']; ?></td>
		</tr>
		<tr>
			<td>Indikator (Keluaran): </td>
			<td><?= $fisik['rkpd_indikator_kegiatan_sub']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/ropk/ropk_fisik/fisik_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $fisik['id_ropk_fisik']; ?>">
		<input type="hidden" name="kegiatan" value="<?= $fisik['rkpd_kegiatan']; ?>">
		<input type="hidden" name="kegiatan_sub" value="<?= $fisik['rkpd_kegiatan_sub']; ?>">
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
					<input type="text" name="bobot_acuan" id="txt1" value="<?= $fisik['ropk_bobot_acuan']; ?>" class="form-control" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label>Tahap Aktifitas <medium class="text-danger">*</medium></label>
					<input type="text" name="aktifitas" value="<?= $fisik['ropk_tahap_aktivitas']; ?>" class="form-control" maxlength="300" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label>Sasaran</label>
					<input type="text" name="ropk_sasaran" value="<?= $fisik['ropk_sasaran']; ?>" class="form-control" maxlength="300" required>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Target Sasaran</label>
					<input type="number" name="ropk_sasaran_target" value="<?= $fisik['ropk_sasaran_target']; ?>" class="form-control" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-2">
				<label>Satuan <medium class="text-danger">*</medium></label>
				<select name="satuan" class="form-control select2bs4" required>
					<option value="<?= $fisik['ropk_sasaran_satuan']; ?>"><?= $fisik['ropk_sasaran_satuan']; ?></option>
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
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b1']; ?>' name="b1" id="b1" onkeyup="sum1();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j1" value='<?= $fisik['b1'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Februari</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b2']; ?>' name="b2" id="b2" onkeyup="sum2();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j2" value='<?= $fisik['b2'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Maret</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b3']; ?>' name="b3" id="b3" onkeyup="sum3();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j3" value='<?= $fisik['b3'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan April</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b4']; ?>' name="b4" id="b4" onkeyup="sum4();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j4" value='<?= $fisik['b4'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Mei</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b5']; ?>' name="b5" id="b5" onkeyup="sum5();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j5" value='<?= $fisik['b5'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Juni</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b6']; ?>' name="b6" id="b6" onkeyup="sum6();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j6" value='<?= $fisik['b6'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Juli</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b7']; ?>' name="b7" id="b7" onkeyup="sum7();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j7" value='<?= $fisik['b7'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Agustus</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b8']; ?>' name="b8" id="b8" onkeyup="sum8();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j8" value='<?= $fisik['b8'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan September</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b9']; ?>' name="b9" id="b9" onkeyup="sum9();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j9" value='<?= $fisik['b9'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Oktober</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b10']; ?>' name="b10" id="b10" onkeyup="sum10();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j10" value='<?= $fisik['b10'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan November</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b11']; ?>' name="b11" id="b11" onkeyup="sum11();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j11" value='<?= $fisik['b11'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Rencana Bulan Desember</div>
					<div class="col-md-6">
						<input type="number" value='<?= $fisik['b12']; ?>' name="b12" id="b12" onkeyup="sum12();" class="form-control" maxlength="20">
					</div>
					<div class="col-md-6">
						<input type="number" id="j12" value='<?= $fisik['b12'] * $fisik['ropk_bobot_acuan']; ?>' class="form-control" disabled>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-12">Total</div>
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
	function sum1() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b1').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j1').value = n;
	}
	$("#txt1, #b1").keyup(function() {
		sum2();
	});

	function sum2() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b2').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j2').value = n;
	}
	$("#txt1, #b2").keyup(function() {
		sum2();
	});

	function sum3() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b3').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j3').value = n;
	}
	$("#txt1, #b3").keyup(function() {
		sum3();
	});

	function sum4() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b4').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j4').value = n;
	}
	$("#txt1, #b4").keyup(function() {
		sum4();
	});

	function sum5() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b5').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j5').value = n;
	}
	$("#txt1, #b5").keyup(function() {
		sum5();
	});

	function sum6() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b6').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j6').value = n;
	}
	$("#txt1, #b6").keyup(function() {
		sum6();
	});

	function sum7() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b7').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j7').value = n;
	}
	$("#txt1, #b7").keyup(function() {
		sum7();
	});

	function sum8() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b8').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j8').value = n;
	}
	$("#txt1, #b8").keyup(function() {
		sum8();
	});

	function sum9() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b9').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j9').value = n;
	}
	$("#txt1, #b9").keyup(function() {
		sum9();
	});

	function sum10() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b10').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j10').value = n;
	}
	$("#txt1, #b10").keyup(function() {
		sum10();
	});

	function sum11() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b11').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j11').value = n;
	}
	$("#txt1, #b11").keyup(function() {
		sum11();
	});

	function sum12() {
		var txtFirstNumberValue = document.getElementById('txt1').value;
		var txtSecondNumberValue = document.getElementById('b12').value;
		if (isNaN(txtFirstNumberValue)) txtFirstNumberValue = 0;
		if (isNaN(txtSecondNumberValue)) txtSecondNumberValue = 0;
		var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
		let num = result;
		let n = num.toFixed(2);
		document.getElementById('j12').value = n;
	}
	$("#txt1, #b12").keyup(function() {
		sum12();
	});

	function total() {
		var txt1 = document.getElementById('j1').value;
		var txt2 = document.getElementById('j2').value;
		var txt3 = document.getElementById('j3').value;
		var txt4 = document.getElementById('j4').value;
		var txt5 = document.getElementById('j5').value;
		var txt6 = document.getElementById('j6').value;
		var txt7 = document.getElementById('j7').value;
		var txt8 = document.getElementById('j8').value;
		var txt9 = document.getElementById('j9').value;
		var txt10 = document.getElementById('j10').value;
		var txt11 = document.getElementById('j11').value;
		var txt12 = document.getElementById('j12').value;
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
	$("#txt1, #b1, #b2, #b3, #b4, #b5, #b6, #b7, #b8, #b9, #b10, #b11, #b12").keyup(function() {
		total();
	});
</script>
<?= $this->endSection(); ?>