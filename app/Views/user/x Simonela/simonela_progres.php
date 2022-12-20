<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
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
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle" width="40px">Bulan</th>
				<th rowspan="2" class="text-center align-middle">Tahapan Aktifitas</th>
				<th rowspan="2" class="text-center align-middle">Faktor Penghambat</th>
				<th rowspan="2" class="text-center align-middle">Faktor Pendukung</th>
				<th class="text-center" colspan="2">Target</th>
				<!-- <th class="text-center" colspan="2">Target Dikurangi Efisiensi</th> -->
				<th class="text-center" colspan="2">Realisasi</th>
				<th class="text-center" colspan="2">Konsistensi (%)</th>
				<th class="text-center" colspan="2">Deviasi</th>
				<th rowspan="2" class="text-center align-middle"></th>
				<th rowspan="2" class="text-center align-middle">Tanggal Proses</th>
				<th rowspan="2" class="text-center align-middle">Status</th>
				<th rowspan="2" class="text-center align-middle" style="width: 90px;">Aksi</th>
				<th rowspan="2" class="text-center align-middle" style="width: 90px;">Aksi</th>
			</tr>
			<tr>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<!-- <th class="text-center">Keu</th>
				<th class="text-center">Fisik</th> -->
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
			</tr>
		</thead>
		<?php $keuangan = $db->table('tb_ropk_keuangan')->getWhere(['tb_ropk_keuangan.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'], 'tb_ropk_keuangan.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'tb_ropk_keuangan.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'tb_ropk_keuangan.ropk_tahap' => 'Persiapan', 'tb_ropk_keuangan.opd_id' => user()->opd_id, 'tb_ropk_keuangan.tahun' => $_SESSION['tahun'], 'tb_ropk_keuangan.perubahan' => $_SESSION['perubahan']])->getResultArray();
		foreach ($keuangan as $ros) {
			isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
			isset($ros['b1']) ? $keu1[] = ($ros['b1']) : $keu1[] = ['0'];
			isset($ros['b2']) ? $keu2[] = ($ros['b2']) : $keu2[] = ['0'];
			isset($ros['b3']) ? $keu3[] = ($ros['b3']) : $keu3[] = ['0'];
			isset($ros['b4']) ? $keu4[] = ($ros['b4']) : $keu4[] = ['0'];
			isset($ros['b5']) ? $keu5[] = ($ros['b5']) : $keu5[] = ['0'];
			isset($ros['b6']) ? $keu6[] = ($ros['b6']) : $keu6[] = ['0'];
			isset($ros['b7']) ? $keu7[] = ($ros['b7']) : $keu7[] = ['0'];
			isset($ros['b8']) ? $keu8[] = ($ros['b8']) : $keu8[] = ['0'];
			isset($ros['b9']) ? $keu9[] = ($ros['b9']) : $keu9[] = ['0'];
			isset($ros['b10']) ? $keu10[] = ($ros['b10']) : $keu10[] = ['0'];
			isset($ros['b11']) ? $keu11[] = ($ros['b11']) : $keu11[] = ['0'];
			isset($ros['b12']) ? $keu12[] = ($ros['b12']) : $keu12[] = ['0'];
		}
		$bb1 = !empty($keu1) ? array_sum($keu1) : '0';
		$bb2 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0');
		$bb3 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0');
		$bb4 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0');
		$bb5 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0');
		$bb6 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0');
		$bb7 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0');
		$bb8 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0');
		$bb9 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0');
		$bb10 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0') + (!empty($keu10) ? array_sum($keu10) : '0');
		$bb11 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0') + (!empty($keu10) ? array_sum($keu10) : '0') + (!empty($keu11) ? array_sum($keu11) : '0');
		$bb12 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0') + (!empty($keu10) ? array_sum($keu10) : '0') + (!empty($keu11) ? array_sum($keu11) : '0') + (!empty($keu1) ? array_sum($keu12) : '0');
		?>

		<?php $fisik = $db->table('tb_ropk_fisik')->getWhere(['tb_ropk_fisik.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'], 'tb_ropk_fisik.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'tb_ropk_fisik.ropk_tahap' => 'Persiapan', 'tb_ropk_fisik.opd_id' => user()->opd_id,	'tb_ropk_fisik.tahun' => $_SESSION['tahun'], 'tb_ropk_fisik.perubahan' => $_SESSION['perubahan']])->getResultArray();
		foreach ($fisik as $ros) {
			isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
			isset($ros['b1']) ? $fis1[] = ($ros['b1']) : $fis1[] = ['0'];
			isset($ros['b2']) ? $fis2[] = ($ros['b2']) : $fis2[] = ['0'];
			isset($ros['b3']) ? $fis3[] = ($ros['b3']) : $fis3[] = ['0'];
			isset($ros['b4']) ? $fis4[] = ($ros['b4']) : $fis4[] = ['0'];
			isset($ros['b5']) ? $fis5[] = ($ros['b5']) : $fis5[] = ['0'];
			isset($ros['b6']) ? $fis6[] = ($ros['b6']) : $fis6[] = ['0'];
			isset($ros['b7']) ? $fis7[] = ($ros['b7']) : $fis7[] = ['0'];
			isset($ros['b8']) ? $fis8[] = ($ros['b8']) : $fis8[] = ['0'];
			isset($ros['b9']) ? $fis9[] = ($ros['b9']) : $fis9[] = ['0'];
			isset($ros['b10']) ? $fis10[] = ($ros['b10']) : $fis10[] = ['0'];
			isset($ros['b11']) ? $fis11[] = ($ros['b11']) : $fis11[] = ['0'];
			isset($ros['b12']) ? $fis12[] = ($ros['b12']) : $fis12[] = ['0'];
		}
		$fbb1 = !empty($fis1) ? array_sum($fis1) : '0';
		$fbb2 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0');
		$fbb3 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0');
		$fbb4 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0');
		$fbb5 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0');
		$fbb6 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0');
		$fbb7 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0');
		$fbb8 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0');
		$fbb9 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0');
		$fbb10 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0') + (!empty($fis10) ? array_sum($fis10) : '0');
		$fbb11 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0') + (!empty($fis10) ? array_sum($fis10) : '0') + (!empty($fis11) ? array_sum($fis11) : '0');
		$fbb12 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0') + (!empty($fis10) ? array_sum($fis10) : '0') + (!empty($fis11) ? array_sum($fis11) : '0') + (!empty($fis1) ? array_sum($fis12) : '0');
		?>
		<tbody>
			<tr>
				<?php $progres1 = $db->table('tb_simonela_progres')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b1'])->getRowArray();
				//dd($progres1); 
				?>
				<td class="align-top">Januari</td>
				<td class="align-top"><?= isset($progres1['tahap_aktifitas']) ? $progres1['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres1['faktor_penghambat']) ? $progres1['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres1['faktor_pendukung']) ? $progres1['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb1, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb1, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres1['realisasi_keu']) ? number_format($progres1['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres1['realisasi_fisik']) ? number_format($progres1['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres1['realisasi_keu']) ? round(($progres1['realisasi_keu'] / $bb1) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres1['realisasi_fisik']) ? number_format(round(($progres1['realisasi_fisik'] / $fbb1) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres1['realisasi_keu']) ? number_format(round((((($bb1 / $DT['rp_tahun']) - ($progres1['realisasi_keu'] / $bb1)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres1['realisasi_fisik']) ? number_format(round(($fbb1 - $progres1['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres1['realisasi_keu']) ? round((($bb1 - $progres1['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres1['created_at']) ? $progres1['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres1['bulan_lapor']) ? ($progres1['bulan_lapor'] > '01' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres1['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres1['id_simonela_progres'] . '/' . 'b1' . '/Januari?keu=' . number_format($bb1, 0, ',', '.') . '&fis=' . number_format($fbb1, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b1' . '/Januari?keu=' . number_format($bb1, 0, ',', '.') . '&fis=' . number_format($fbb1, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/'  . 'b1' . '/Januari'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres2 = $db->table('tb_simonela_progres')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b2'])->getRowArray(); ?>
				<td class="align-top">Februari</td>
				<td class="align-top"><?= isset($progres2['tahap_aktifitas']) ? $progres2['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres2['faktor_penghambat']) ? $progres2['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres2['faktor_pendukung']) ? $progres2['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb2, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb2, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres2['realisasi_keu']) ? number_format($progres2['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres2['realisasi_fisik']) ? number_format($progres2['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres2['realisasi_keu']) ? round(($progres2['realisasi_keu'] / $bb2) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres2['realisasi_fisik']) ? number_format(round(($progres2['realisasi_fisik'] / $fbb2) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres2['realisasi_keu']) ? number_format(round((((($bb2 / $DT['rp_tahun']) - ($progres2['realisasi_keu'] / $bb2)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres2['realisasi_fisik']) ? number_format(round(($fbb2 - $progres2['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres2['realisasi_keu']) ? round((($bb2 - $progres2['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres2['created_at']) ? $progres2['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres2['bulan_lapor']) ? ($progres2['bulan_lapor'] > '02' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres2['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres2['id_simonela_progres'] . '/' . 'b2' . '/Februari?keu=' . number_format($bb2, 0, ',', '.') . '&fis=' . number_format($fbb2, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b2' . '/Februari?keu=' . number_format($bb2, 0, ',', '.') . '&fis=' . number_format($fbb2, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b2' . '/Februari'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres3 = $db->table('tb_simonela_progres')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b3'])->getRowArray(); ?>
				<td class="align-top">Maret</td>
				<td class="align-top"><?= isset($progres3['tahap_aktifitas']) ? $progres3['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres3['faktor_penghambat']) ? $progres3['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres3['faktor_pendukung']) ? $progres3['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb3, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb3, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres3['realisasi_keu']) ? number_format($progres3['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres3['realisasi_fisik']) ? number_format($progres3['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres3['realisasi_keu']) ? round(($progres3['realisasi_keu'] / $bb3) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres3['realisasi_fisik']) ? number_format(round(($progres3['realisasi_fisik'] / $fbb3) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres3['realisasi_keu']) ? number_format(round((((($bb3 / $DT['rp_tahun']) - ($progres3['realisasi_keu'] / $bb3)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres3['realisasi_fisik']) ? number_format(round(($fbb3 - $progres3['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres3['realisasi_keu']) ? round((($bb3 - $progres3['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres3['created_at']) ? $progres3['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres3['bulan_lapor']) ? ($progres3['bulan_lapor'] > '03' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres3['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres3['id_simonela_progres'] . '/' . 'b3' . '/Maret?keu=' . number_format($bb3, 0, ',', '.') . '&fis=' . number_format($fbb3, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b3' . '/Maret?keu=' . number_format($bb3, 0, ',', '.') . '&fis=' . number_format($fbb3, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b3' . '/Maret'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres4 = $db->table('tb_simonela_progres')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b4'])->getRowArray(); ?>
				<td class="align-top">April</td>
				<td class="align-top"><?= isset($progres4['tahap_aktifitas']) ? $progres4['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres4['faktor_penghambat']) ? $progres4['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres4['faktor_pendukung']) ? $progres4['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb4, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb4, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres4['realisasi_keu']) ? number_format($progres4['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres4['realisasi_fisik']) ? number_format($progres4['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres4['realisasi_keu']) ? round(($progres4['realisasi_keu'] / $bb4) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres4['realisasi_fisik']) ? number_format(round(($progres4['realisasi_fisik'] / $fbb4) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres4['realisasi_keu']) ? number_format(round((((($bb4 / $DT['rp_tahun']) - ($progres4['realisasi_keu'] / $bb4)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres4['realisasi_fisik']) ? number_format(round(($fbb4 - $progres4['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres4['realisasi_keu']) ? round((($bb4 - $progres4['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres4['created_at']) ? $progres4['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres4['bulan_lapor']) ? ($progres4['bulan_lapor'] > '04' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres4['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres4['id_simonela_progres'] . '/' . 'b4' . '/April?keu=' . number_format($bb4, 0, ',', '.') . '&fis=' . number_format($fbb4, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b4' . '/April?keu=' . number_format($bb4, 0, ',', '.') . '&fis=' . number_format($fbb4, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b4' . '/April'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres5 = $db->table('tb_simonela_progres')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b5'])->getRowArray(); ?>
				<td class="align-top">Mei</td>
				<td class="align-top"><?= isset($progres5['tahap_aktifitas']) ? $progres5['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres5['faktor_penghambat']) ? $progres5['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres5['faktor_pendukung']) ? $progres5['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb5, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb5, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres5['realisasi_keu']) ? number_format($progres5['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres5['realisasi_fisik']) ? number_format($progres5['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres5['realisasi_keu']) ? round(($progres5['realisasi_keu'] / $bb5) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres5['realisasi_fisik']) ? number_format(round(($progres5['realisasi_fisik'] / $fbb5) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres5['realisasi_keu']) ? number_format(round((((($bb5 / $DT['rp_tahun']) - ($progres5['realisasi_keu'] / $bb5)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres5['realisasi_fisik']) ? number_format(round(($fbb5 - $progres5['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres5['realisasi_keu']) ? round((($bb5 - $progres5['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres5['created_at']) ? $progres5['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres5['bulan_lapor']) ? ($progres5['bulan_lapor'] > '05' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres5['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres5['id_simonela_progres'] . '/' . 'b5' . '/Mei?keu=' . number_format($bb5, 0, ',', '.') . '&fis=' . number_format($fbb5, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b5' . '/Mei?keu=' . number_format($bb5, 0, ',', '.') . '&fis=' . number_format($fbb5, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b5' . '/Mei'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres6 = $db->table('tb_simonela_progres')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b6'
					])->getRowArray(); ?>
				<td class="align-top">Juni</td>
				<td class="align-top"><?= isset($progres6['tahap_aktifitas']) ? $progres6['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres6['faktor_penghambat']) ? $progres6['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres6['faktor_pendukung']) ? $progres6['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb6, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb6, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres6['realisasi_keu']) ? number_format($progres6['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres6['realisasi_fisik']) ? number_format($progres6['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres6['realisasi_keu']) ? round(($progres6['realisasi_keu'] / $bb6) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres6['realisasi_fisik']) ? number_format(round(($progres6['realisasi_fisik'] / $fbb6) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres6['realisasi_keu']) ? number_format(round((((($bb6 / $DT['rp_tahun']) - ($progres6['realisasi_keu'] / $bb6)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres6['realisasi_fisik']) ? number_format(round(($fbb6 - $progres5['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres6['realisasi_keu']) ? round((($bb6 - $progres6['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres6['created_at']) ? $progres6['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres6['bulan_lapor']) ? ($progres6['bulan_lapor'] > '06' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres6['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres6['id_simonela_progres'] . '/' . 'b6' . '/Juni?keu=' . number_format($bb6, 0, ',', '.') . '&fis=' . number_format($fbb6, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b6' . '/Juni?keu=' . number_format($bb6, 0, ',', '.') . '&fis=' . number_format($fbb6, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b6' . '/Juni'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres7 = $db->table('tb_simonela_progres')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b7'
					])->getRowArray(); ?>
				<td class="align-top">Juli</td>
				<td class="align-top"><?= isset($progres7['tahap_aktifitas']) ? $progres7['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres7['faktor_penghambat']) ? $progres7['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres7['faktor_pendukung']) ? $progres7['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb7, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb7, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres7['realisasi_keu']) ? number_format($progres7['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres7['realisasi_fisik']) ? number_format($progres7['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres7['realisasi_keu']) ? round(($progres7['realisasi_keu'] / $bb7) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres7['realisasi_fisik']) ? number_format(round(($progres7['realisasi_fisik'] / $fbb7) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres7['realisasi_keu']) ? number_format(round((((($bb7 / $DT['rp_tahun']) - ($progres7['realisasi_keu'] / $bb7)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres7['realisasi_fisik']) ? number_format(round(($fbb7 - $progres7['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres7['realisasi_keu']) ? round((($bb7 - $progres7['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres7['created_at']) ? $progres7['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres7['bulan_lapor']) ? ($progres7['bulan_lapor'] > '07' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres7['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres7['id_simonela_progres'] . '/' . 'b7' . '/Juli?keu=' . number_format($bb7, 0, ',', '.') . '&fis=' . number_format($fbb7, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b7' . '/Juli?keu=' . number_format($bb7, 0, ',', '.') . '&fis=' . number_format($fbb7, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b7' . '/Juli'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres8 = $db->table('tb_simonela_progres')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b8'
					])->getRowArray(); ?>
				<td class="align-top">Agustus</td>
				<td class="align-top"><?= isset($progres8['tahap_aktifitas']) ? $progres8['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres8['faktor_penghambat']) ? $progres8['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres8['faktor_pendukung']) ? $progres8['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb8, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb8, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres8['realisasi_keu']) ? number_format($progres8['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres8['realisasi_fisik']) ? number_format($progres8['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres8['realisasi_keu']) ? round(($progres8['realisasi_keu'] / $bb8) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres8['realisasi_fisik']) ? number_format(round(($progres8['realisasi_fisik'] / $fbb8) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres8['realisasi_keu']) ? number_format(round((((($bb8 / $DT['rp_tahun']) - ($progres8['realisasi_keu'] / $bb8)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres8['realisasi_fisik']) ? number_format(round(($fbb8 - $progres8['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres8['realisasi_keu']) ? round((($bb8 - $progres8['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres8['created_at']) ? $progres8['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres8['bulan_lapor']) ? ($progres8['bulan_lapor'] > '08' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres8['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres8['id_simonela_progres'] . '/' . 'b8' . '/Agustus?keu=' . number_format($bb8, 0, ',', '.') . '&fis=' . number_format($fbb8, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b8' . '/Agustus?keu=' . number_format($bb8, 0, ',', '.') . '&fis=' . number_format($fbb8, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b8' . '/Agustus'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres9 = $db->table('tb_simonela_progres')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b9'
					])->getRowArray(); ?>
				<td class="align-top">September</td>
				<td class="align-top"><?= isset($progres9['tahap_aktifitas']) ? $progres9['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres9['faktor_penghambat']) ? $progres9['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres9['faktor_pendukung']) ? $progres9['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb9, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb9, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres9['realisasi_keu']) ? number_format($progres9['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres9['realisasi_fisik']) ? number_format($progres9['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres9['realisasi_keu']) ? round(($progres9['realisasi_keu'] / $bb9) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres9['realisasi_fisik']) ? number_format(round(($progres9['realisasi_fisik'] / $fbb9) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres9['realisasi_keu']) ? number_format(round((((($bb9 / $DT['rp_tahun']) - ($progres9['realisasi_keu'] / $bb9)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres9['realisasi_fisik']) ? number_format(round(($fbb9 - $progres9['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres9['realisasi_keu']) ? round((($bb9 - $progres9['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres9['created_at']) ? $progres9['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres9['bulan_lapor']) ? ($progres9['bulan_lapor'] > '09' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres9['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres9['id_simonela_progres'] . '/' . 'b9' . '/September?keu=' . number_format($bb9, 0, ',', '.') . '&fis=' . number_format($fbb9, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b9' . '/September?keu=' . number_format($bb9, 0, ',', '.') . '&fis=' . number_format($fbb9, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b9' . '/September'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres10 = $db->table('tb_simonela_progres')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b10'
					])->getRowArray(); ?>
				<td class="align-top">Oktober</td>
				<td class="align-top"><?= isset($progres10['tahap_aktifitas']) ? $progres10['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres10['faktor_penghambat']) ? $progres10['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres10['faktor_pendukung']) ? $progres10['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb10, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb10, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres10['realisasi_keu']) ? number_format($progres10['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres10['realisasi_fisik']) ? number_format($progres10['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres10['realisasi_keu']) ? round(($progres10['realisasi_keu'] / $bb10) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres10['realisasi_fisik']) ? number_format(round(($progres10['realisasi_fisik'] / $fbb10) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres10['realisasi_keu']) ? number_format(round((((($bb10 / $DT['rp_tahun']) - ($progres10['realisasi_keu'] / $bb10)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres10['realisasi_fisik']) ? number_format(round(($fbb10 - $progres10['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres10['realisasi_keu']) ? round((($bb10 - $progres10['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres10['created_at']) ? $progres10['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres10['bulan_lapor']) ? ($progres10['bulan_lapor'] > '10' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres10['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres10['id_simonela_progres'] . '/' . 'b10' . '/Oktober?keu=' . number_format($bb10, 0, ',', '.') . '&fis=' . number_format($fbb10, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b10' . '/Oktober?keu=' . number_format($bb10, 0, ',', '.') . '&fis=' . number_format($fbb10, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b10' . '/Oktober'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres11 = $db->table('tb_simonela_progres')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b11'
					])->getRowArray(); ?>
				<td class="align-top">November</td>
				<td class="align-top"><?= isset($progres11['tahap_aktifitas']) ? $progres11['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres11['faktor_penghambat']) ? $progres11['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres11['faktor_pendukung']) ? $progres11['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb11, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb11, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres11['realisasi_keu']) ? number_format($progres11['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres11['realisasi_fisik']) ? number_format($progres11['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres11['realisasi_keu']) ? round(($progres11['realisasi_keu'] / $bb11) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres11['realisasi_fisik']) ? number_format(round(($progres11['realisasi_fisik'] / $fbb11) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres11['realisasi_keu']) ? number_format(round((((($bb11 / $DT['rp_tahun']) - ($progres11['realisasi_keu'] / $bb11)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres11['realisasi_fisik']) ? number_format(round(($fbb11 - $progres11['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres11['realisasi_keu']) ? round((($bb11 - $progres11['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres11['created_at']) ? $progres11['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres11['bulan_lapor']) ? ($progres11['bulan_lapor'] > '11' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres11['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres11['id_simonela_progres'] . '/' . 'b11' . '/November?keu=' . number_format($bb11, 0, ',', '.') . '&fis=' . number_format($fbb11, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b11' . '/November?keu=' . number_format($bb11, 0, ',', '.') . '&fis=' . number_format($fbb11, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b11' . '/November'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres12 = $db->table('tb_simonela_progres')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b12'
					])->getRowArray(); ?>
				<td class="align-top">Desember</td>
				<td class="align-top"><?= isset($progres12['tahap_aktifitas']) ? $progres12['tahap_aktifitas'] : ''; ?></td>
				<td class="align-top"><?= isset($progres12['faktor_penghambat']) ? $progres12['faktor_penghambat'] : ''; ?></td>
				<td class="align-top"><?= isset($progres12['faktor_pendukung']) ? $progres12['faktor_pendukung'] : ''; ?></td>
				<td class="align-top text-right"><?= number_format($bb12, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb12, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($progres12['realisasi_keu']) ? number_format($progres12['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres12['realisasi_fisik']) ? number_format($progres12['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres12['realisasi_keu']) ? round(($progres12['realisasi_keu'] / $bb12) * 100, 2) : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres12['realisasi_fisik']) ? number_format(round(($progres12['realisasi_fisik'] / $fbb12) * 100, 2), 2, ',', '.') : ''; ?></td>

				<td class="align-top text-right"><?= isset($progres12['realisasi_keu']) ? number_format(round((((($bb12 / $DT['rp_tahun']) - ($progres12['realisasi_keu'] / $bb11)) * 100)), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres12['realisasi_fisik']) ? number_format(round(($fbb12 - $progres12['realisasi_fisik']), 2), 2, ',', '.') : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres12['realisasi_keu']) ? round((($bb12 - $progres12['realisasi_keu']) / $DT['rp_tahun']) * 100, 2) : '' ?></td>

				<td class="align-top text-center"><?= isset($progres12['created_at']) ? $progres12['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres12['bulan_lapor']) ? ($progres12['bulan_lapor'] > '12' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres12['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_edit/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . $progres12['id_simonela_progres'] . '/' . 'b12' . '/Desember?keu=' . number_format($bb12, 0, ',', '.') . '&fis=' . number_format($fbb12, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b12' . '/Desember?keu=' . number_format($bb12, 0, ',', '.') . '&fis=' . number_format($fbb12, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/user/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b12' . '/Desember'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
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
			"paging": false,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"searching": false,
			"info": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
		});
	});
</script>
<?= $this->endSection(); ?>