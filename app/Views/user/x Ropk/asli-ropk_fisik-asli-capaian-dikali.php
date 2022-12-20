<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/fisik'); ?>">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<th class="col-md-6">Kegiatan / Sub Kegiatan</th>
			<th class="col-md-6">Keluaran</th>
		</tr>
		<tr>
			<td><?= $_GET['k']; ?></td>
			<td rowspan="2" class="align-top">
				<?php $keluaran = $db->table('tb_rkpd_kegiatan_sub')->getWhere(['rkpd_kegiatan_n' => $_GET['k'], 'rkpd_kegiatan_sub_n' => $_GET['s'], 'tahun' => $_SESSION['tahun'], 'opd_id' => user()->opd_id])->getResultArray();
				foreach ($keluaran as $row) : ?>
					<div style="display: inline-flex;">
						<li></li>
						<div><?= ' ' . $row['rkpd_indikator_kegiatan_sub'] . ': ' . $row['t_tahun'] . ' ' . $row['satuan']; ?></div>
					</div><br>
				<?php endforeach; ?>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:40px;">
					<?= $_GET['s']; ?>
				</div>
			</td>
		</tr>
	</table><br>
	<div class="">
		<table id="example1" class="table table-bordered display nowrap table-responsive">
			<thead>
				<tr>
					<th rowspan="2" style="text-align: center;" width="30px">Kode</th>
					<th rowspan="2" style="width:700px;">Grup / Indikator / Kegiatan Fisik</th>
					<th rowspan="2" style="width: 300px;">Sub Unit Organisasi SKPD</th>
					<th rowspan="2" style="width: 300px; text-align:center;">Sasaran / Target Sasaran</th>
					<th rowspan="2" style="width: 60px; text-align:center;">Acuan</th>
					<th colspan="3" style="width: 60px; text-align:center;">Triwulan 1</th>
					<th colspan="3" style="width: 60px; text-align:center;">Triwulan 2</th>
					<th colspan="3" style="width: 60px; text-align:center;">Triwulan 3</th>
					<th colspan="3" style="width: 60px; text-align:center;">Triwulan 4</th>
					<th rowspan="2" style="width: 80px; text-align:center;">Aksi</th>
				</tr>
				<tr>
					<th style="width: 60px; text-align:center;">1</th>
					<th style="width: 60px; text-align:center;">2</th>
					<th style="width: 60px; text-align:center;">3</th>
					<th style="width: 60px; text-align:center;">4</th>
					<th style="width: 60px; text-align:center;">5</th>
					<th style="width: 60px; text-align:center;">6</th>
					<th style="width: 60px; text-align:center;">7</th>
					<th style="width: 60px; text-align:center;">8</th>
					<th style="width: 60px; text-align:center;">9</th>
					<th style="width: 60px; text-align:center;">10</th>
					<th style="width: 60px; text-align:center;">11</th>
					<th style="width: 60px; text-align:center;">12</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($rkpd_kegiatan as $rol) : ?>
					<tr style="background: azure;">
						<td class="text-center"></td>
						<td class="text-wrap align-top">
							<a href="<?= base_url('/user/ropk/ropk_fisik/fisik_add?k=' . $_GET['k'] . '&s=' . $_GET['s'] . '&i=' . $rol['rkpd_indikator_kegiatan_sub'] . '&t=Persiapan'); ?>">
								<?= $rol['rkpd_indikator_kegiatan_sub']; ?>
							</a>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align: center;"> </td>
					</tr>
					<?php
					$query = $db->table('tb_ropk_fisik')->getWhere(['tb_ropk_fisik.rkpd_kegiatan' => $rol['rkpd_kegiatan_n'], 'tb_ropk_fisik.rkpd_kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'tb_ropk_fisik.ropk_tahap' => 'Persiapan',	'tb_ropk_fisik.opd_id' => user()->opd_id, 'tb_ropk_fisik.tahun' => $_SESSION['tahun']])->getResultArray();
					foreach ($query as $ros) : ?>
						<tr>
							<td class="align-top"></td>
							<td class="text-wrap align-top">
								<div style="padding-left:20px"><?= $ros['ropk_tahap_aktivitas']; ?></div>
							</td>
							<td class="align-top text-right"></td>
							<td><?= isset($ros['ropk_sasaran']) ? $ros['ropk_sasaran'] . ': ' . $ros['ropk_sasaran_target'] . ' ' . $ros['ropk_sasaran_satuan'] : ''; ?></td>
							<td class="text-center"><?= isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b1']) ? $num1[] = ($ros['b1'] * $ros['ropk_bobot_acuan']) : $num1[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b2']) ? $num2[] = ($ros['b2'] * $ros['ropk_bobot_acuan']) : $num2[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b3']) ? $num3[] = ($ros['b3'] * $ros['ropk_bobot_acuan']) : $num3[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b4']) ? $num4[] = ($ros['b4'] * $ros['ropk_bobot_acuan']) : $num4[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b5']) ? $num5[] = ($ros['b5'] * $ros['ropk_bobot_acuan']) : $num5[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b6']) ? $num6[] = ($ros['b6'] * $ros['ropk_bobot_acuan']) : $num6[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b7']) ? $num7[] = ($ros['b7'] * $ros['ropk_bobot_acuan']) : $num7[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b8']) ? $num8[] = ($ros['b8'] * $ros['ropk_bobot_acuan']) : $num8[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b9']) ? $num9[] = ($ros['b9'] * $ros['ropk_bobot_acuan']) : $num9[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b10']) ? $num10[] = ($ros['b10'] * $ros['ropk_bobot_acuan']) : $num10[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b11']) ? $num11[] = ($ros['b11'] * $ros['ropk_bobot_acuan']) : $num11[] = ['0']; ?></td>
							<td class="text-center"><?= isset($ros['b12']) ? $num12[] = ($ros['b12'] * $ros['ropk_bobot_acuan']) : $num12[] = ['0']; ?></td>
							<td style="text-align: center;">
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ropk/ropk_fisik/fisik_edit/' . $ros['id_ropk_fisik']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
				<tr>
					<td colspan="4"><b>Acuan Perbulan</b></td>
					<td class="text-right"><?= !empty($acu) ? number_format(array_sum($acu), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num1) ? number_format(array_sum($num1), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num2) ? number_format(array_sum($num2), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num3) ? number_format(array_sum($num3), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num4) ? number_format(array_sum($num4), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num5) ? number_format(array_sum($num5), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num6) ? number_format(array_sum($num6), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num7) ? number_format(array_sum($num7), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num8) ? number_format(array_sum($num8), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num9) ? number_format(array_sum($num9), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num10) ? number_format(array_sum($num10), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num11) ? number_format(array_sum($num11), 2, ',', '.') : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num12) ? number_format(array_sum($num12), 2, ',', '.') : '0.00'; ?></td>
					<td></td>
				</tr>

				<?php
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
				?>
				<tr>
					<td colspan="4"><b>Kumulatif per Bulan</b></td>
					<td class="text-right"></td>
					<td class="text-right"><?= number_format($bb1, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb2, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb3, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb4, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb5, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb6, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb7, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb8, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb9, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb10, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb11, 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format($bb12, 2, ',', '.'); ?></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			]
		});

		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>

<?= $this->endSection(); ?>