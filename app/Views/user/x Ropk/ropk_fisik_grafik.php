<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<?php foreach ($rkpd_kegiatan as $rol) {
		$query = $db->table('tb_ropk_keuangan')
			->getWhere([
				'tb_ropk_keuangan.rkpd_kegiatan' => $rol['rkpd_kegiatan_n'],
				'tb_ropk_keuangan.rkpd_kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
				'tb_ropk_keuangan.rkpd_indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
				'tb_ropk_keuangan.ropk_tahap' => 'Persiapan',
				'tb_ropk_keuangan.opd_id' => user()->opd_id,
				'tb_ropk_keuangan.perubahan' => $_SESSION['perubahan'],
				'tb_ropk_keuangan.tahun' => $_SESSION['tahun']
			])->getResultArray();
		foreach ($query as $ros) {
			isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
			isset($ros['b1']) ? $num1[] = ($ros['b1']) : $num1[] = ['0'];
			isset($ros['b2']) ? $num2[] = ($ros['b2']) : $num2[] = ['0'];
			isset($ros['b3']) ? $num3[] = ($ros['b3']) : $num3[] = ['0'];
			isset($ros['b4']) ? $num4[] = ($ros['b4']) : $num4[] = ['0'];
			isset($ros['b5']) ? $num5[] = ($ros['b5']) : $num5[] = ['0'];
			isset($ros['b6']) ? $num6[] = ($ros['b6']) : $num6[] = ['0'];
			isset($ros['b7']) ? $num7[] = ($ros['b7']) : $num7[] = ['0'];
			isset($ros['b8']) ? $num8[] = ($ros['b8']) : $num8[] = ['0'];
			isset($ros['b9']) ? $num9[] = ($ros['b9']) : $num9[] = ['0'];
			isset($ros['b10']) ? $num10[] = ($ros['b10']) : $num10[] = ['0'];
			isset($ros['b11']) ? $num11[] = ($ros['b11']) : $num11[] = ['0'];
			isset($ros['b12']) ? $num12[] = ($ros['b12']) : $num12[] = ['0'];
		}
	}

	$bb1 = !empty($num1) ? array_sum($num1) : '0';
	$bb2 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0');
	$bb3 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0');
	$bb4 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0');
	$bb5 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0');
	$bb6 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0');
	$bb7 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0');
	$bb8 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0');
	$bb9 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0');
	$bb10 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0') + (!empty($num10) ? array_sum($num10) : '0');
	$bb11 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0') + (!empty($num10) ? array_sum($num10) : '0') + (!empty($num11) ? array_sum($num11) : '0');
	$bb12 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0') + (!empty($num10) ? array_sum($num10) : '0') + (!empty($num11) ? array_sum($num11) : '0') + (!empty($num1) ? array_sum($num12) : '0');

	try {
		!empty($acu) ? $s1 = round(($bb1 / array_sum($acu)) * 100, 2) : $s1 = '0';
	} catch (DivisionByZeroError $e) {
		$s1 = '0';
	}
	try {
		!empty($acu) ? $s2 = round(($bb2 / array_sum($acu)) * 100, 2) : $s2 = '0';
	} catch (DivisionByZeroError $e) {
		$s2 = '0';
	}
	try {
		!empty($acu) ? $s3 = round(($bb3 / array_sum($acu)) * 100, 2) : $s3 = '0';
	} catch (DivisionByZeroError $e) {
		$s3 = '0';
	}
	try {
		!empty($acu) ? $s4 = round(($bb4 / array_sum($acu)) * 100, 2) : $s4 = '0';
	} catch (DivisionByZeroError $e) {
		$s4 = '0';
	}
	try {
		!empty($acu) ? $s5 = round(($bb5 / array_sum($acu)) * 100, 2) : $s5 = '0';
	} catch (DivisionByZeroError $e) {
		$s5 = '0';
	}
	try {
		!empty($acu) ? $s6 = round(($bb6 / array_sum($acu)) * 100, 2) : $s6 = '0';
	} catch (DivisionByZeroError $e) {
		$s6 = '0';
	}
	try {
		!empty($acu) ? $s7 = round(($bb7 / array_sum($acu)) * 100, 2) : $s7 = '0';
	} catch (DivisionByZeroError $e) {
		$s7 = '0';
	}
	try {
		!empty($acu) ? $s8 = round(($bb8 / array_sum($acu)) * 100, 2) : $s8 = '0';
	} catch (DivisionByZeroError $e) {
		$s8 = '0';
	}
	try {
		!empty($acu) ? $s9 = round(($bb9 / array_sum($acu)) * 100, 2) : $s9 = '0';
	} catch (DivisionByZeroError $e) {
		$s9 = '0';
	}
	try {
		!empty($acu) ? $s10 = round(($bb10 / array_sum($acu)) * 100, 2) : $s10 = '0';
	} catch (DivisionByZeroError $e) {
		$s10 = '0';
	}
	try {
		!empty($acu) ? $s11 = round(($bb11 / array_sum($acu)) * 100, 2) : $s11 = '0';
	} catch (DivisionByZeroError $e) {
		$s11 = '0';
	}
	try {
		!empty($acu) ? $s12 = round(($bb12 / array_sum($acu)) * 100, 2) : $s12 = '0';
	} catch (DivisionByZeroError $e) {
		$s12 = '0';
	}
	?>

	<?php foreach ($rkpd_kegiatan as $rol) {
		$query = $db->table('tb_ropk_fisik')->getWhere([
			'tb_ropk_fisik.rkpd_kegiatan' => $rol['rkpd_kegiatan_n'],
			'tb_ropk_fisik.rkpd_kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
			'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
			'tb_ropk_fisik.ropk_tahap' => 'Persiapan',
			'tb_ropk_fisik.opd_id' => user()->opd_id,
			'tb_ropk_fisik.perubahan' => $_SESSION['perubahan'],
			'tb_ropk_fisik.tahun' => $_SESSION['tahun']
		])->getResultArray();
		foreach ($query as $ros) {
			isset($ros['ropk_bobot_acuan']) ? $ac[] = ($ros['ropk_bobot_acuan']) : $ac[] = ['0'];
			isset($ros['b1']) ? $nu1[] = ($ros['b1']) : $nu1[] = ['0'];
			isset($ros['b2']) ? $nu2[] = ($ros['b2']) : $nu2[] = ['0'];
			isset($ros['b3']) ? $nu3[] = ($ros['b3']) : $nu3[] = ['0'];
			isset($ros['b4']) ? $nu4[] = ($ros['b4']) : $nu4[] = ['0'];
			isset($ros['b5']) ? $nu5[] = ($ros['b5']) : $nu5[] = ['0'];
			isset($ros['b6']) ? $nu6[] = ($ros['b6']) : $nu6[] = ['0'];
			isset($ros['b7']) ? $nu7[] = ($ros['b7']) : $nu7[] = ['0'];
			isset($ros['b8']) ? $nu8[] = ($ros['b8']) : $nu8[] = ['0'];
			isset($ros['b9']) ? $nu9[] = ($ros['b9']) : $nu9[] = ['0'];
			isset($ros['b10']) ? $nu10[] = ($ros['b10']) : $nu10[] = ['0'];
			isset($ros['b11']) ? $nu11[] = ($ros['b11']) : $nu11[] = ['0'];
			isset($ros['b12']) ? $nu12[] = ($ros['b12']) : $nu12[] = ['0'];
		}
	}

	$fbb1 = !empty($nu1) ? array_sum($nu1) : '0';
	$fbb2 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0');
	$fbb3 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0');
	$fbb4 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0');
	$fbb5 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0');
	$fbb6 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0') + (!empty($nu6) ? array_sum($nu6) : '0');
	$fbb7 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0') + (!empty($nu6) ? array_sum($nu6) : '0') + (!empty($nu7) ? array_sum($nu7) : '0');
	$fbb8 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0') + (!empty($nu6) ? array_sum($nu6) : '0') + (!empty($nu7) ? array_sum($nu7) : '0') + (!empty($nu8) ? array_sum($nu8) : '0');
	$fbb9 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0') + (!empty($nu6) ? array_sum($nu6) : '0') + (!empty($nu7) ? array_sum($nu7) : '0') + (!empty($nu8) ? array_sum($nu8) : '0') + (!empty($nu9) ? array_sum($nu9) : '0');
	$fbb10 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0') + (!empty($nu6) ? array_sum($nu6) : '0') + (!empty($nu7) ? array_sum($nu7) : '0') + (!empty($nu8) ? array_sum($nu8) : '0') + (!empty($nu9) ? array_sum($nu9) : '0') + (!empty($nu10) ? array_sum($nu10) : '0');
	$fbb11 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0') + (!empty($nu6) ? array_sum($nu6) : '0') + (!empty($nu7) ? array_sum($nu7) : '0') + (!empty($nu8) ? array_sum($nu8) : '0') + (!empty($nu9) ? array_sum($nu9) : '0') + (!empty($nu10) ? array_sum($nu10) : '0') + (!empty($nu11) ? array_sum($nu11) : '0');
	$fbb12 = (!empty($nu1) ? array_sum($nu1) : '0') + (!empty($nu2) ? array_sum($nu2) : '0') + (!empty($nu3) ? array_sum($nu3) : '0') + (!empty($nu4) ? array_sum($nu4) : '0') + (!empty($nu5) ? array_sum($nu5) : '0') + (!empty($nu6) ? array_sum($nu6) : '0') + (!empty($nu7) ? array_sum($nu7) : '0') + (!empty($nu8) ? array_sum($nu8) : '0') + (!empty($nu9) ? array_sum($nu9) : '0') + (!empty($nu10) ? array_sum($nu10) : '0') + (!empty($nu11) ? array_sum($nu11) : '0') + (!empty($nu1) ? array_sum($nu12) : '0');
	?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = new google.visualization.arrayToDataTable(
				[
					["BULAN", "ROPK Fisik", "ROPK Keuangan"],
					['Januari', <?= $fbb1 . ',' . $s2; ?>],
					['Februari', <?= $fbb2 . ',' . $s2; ?>],
					['Maret', <?= $fbb3 . ',' . $s3; ?>],
					['April', <?= $fbb4 . ',' . $s4; ?>],
					['Mei', <?= $fbb5 . ',' . $s5; ?>],
					['Juni', <?= $fbb6 . ',' . $s6; ?>],
					['Juli', <?= $fbb7 . ',' . $s7; ?>],
					['Agustus', <?= $fbb8 . ',' . $s8; ?>],
					['September', <?= $fbb9 . ',' . $s9; ?>],
					['Oktober', <?= $fbb10 . ',' . $s10; ?>],
					['November', <?= $fbb11 . ',' . $s11; ?>],
					['Desember', <?= $fbb12 . ',' . $s12; ?>]
				]);
			var view = new google.visualization.DataView(data);
			view.setColumns(
				[
					0,
					1, {
						calc: "stringify",
						sourceColumn: 1,
						type: "string",
						role: "annotation"
					},
					2, {
						calc: "stringify",
						sourceColumn: 2,
						type: "string",
						role: "annotation"
					}

				]
			);
			var options = {
				'title': null,
				'width': '100%',
				'height': 600,
				legend: 'bottom'
			};
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(view, options);
		}
	</script>
	<div class="card-body text-center">
		<h5>ROPK Rencana dan Pelaksanaan Keuangan<br> Sub Kegiatan <?= $_GET['s']; ?> Tahun <?= $_SESSION['tahun']; ?><br> <?= opd()->description; ?></h5>

		<div class="card-body row" id="chart_div"></div>
	</div>
</div>
<?= $this->endSection(); ?>