<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

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
			</table><br>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered" style="max-width: 1920px;min-width: 1600px;">
				<thead>
					<tr>
						<th rowspan="2" class="text-center" width="40px">Bulan</th>
						<th rowspan="2">Tahapan pekerjaan (fisik) yang sudah dilakukan</th>
						<th rowspan="2">Faktor Penghambat</th>
						<th rowspan="2">Faktor Pendukung</th>
						<th class="text-center" colspan="2">Target</th>
						<th class="text-center" colspan="2">Target Dikurangi Efisiensi</th>
						<th class="text-center" colspan="2">Realisasi</th>
						<th class="text-center" colspan="2">Konsistensi (%)</th>
						<th class="text-center" rowspan="2">Tanggal Proses</th>
						<th rowspan="2">Status</th>
						<th rowspan="2" style="width: 90px; text-align:center;">Aksi</th>
						<th rowspan="2" style="width: 90px; text-align:center;">Aksi</th>
					</tr>
					<tr>
						<th class="text-center">Keu</th>
						<th class="text-center">Fisik</th>
						<th class="text-center">Keu</th>
						<th class="text-center">Fisik</th>
						<th class="text-center">Keu</th>
						<th class="text-center">Fisik</th>
						<th class="text-center">Keu</th>
						<th class="text-center">Fisik</th>
					</tr>
				</thead>
				<?php
				$b1 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b1')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b2 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b2')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b3 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b3')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b4 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b4')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b5 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b5')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b6 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b6')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b7 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b7')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b8 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b8')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b9 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b9')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b10 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b10')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b11 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b11')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();
				$b12 = $db->table('tb_ropk_keuangan_rekening')->selectsum('tb_ropk_keuangan_rekening.b12')->join('tb_ropk_keuangan_group', 'tb_ropk_keuangan_rekening.ropk_keuangan_group_id = tb_ropk_keuangan_group.id_ropk_keuangan_group', 'left')->getWhere(['tb_ropk_keuangan_group.dpa_id' => $dpa_id, 'tb_ropk_keuangan_rekening.tahun' => $_SESSION['tahun']])->getRowArray();

				$bb1 = $b1['b1'];
				$bb2 = $b1['b1'] + $b2['b2'];
				$bb3 = $b1['b1'] + $b2['b2'] + $b3['b3'];
				$bb4 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'];
				$bb5 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'];
				$bb6 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'] + $b6['b6'];
				$bb7 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'] + $b6['b6'] + $b7['b7'];
				$bb8 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'] + $b6['b6'] + $b7['b7'] + $b8['b8'];
				$bb9 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'] + $b6['b6'] + $b7['b7'] + $b8['b8'] + $b9['b9'];
				$bb10 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'] + $b6['b6'] + $b7['b7'] + $b8['b8'] + $b9['b9'] + $b10['b10'];
				$bb11 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'] + $b6['b6'] + $b7['b7'] + $b8['b8'] + $b9['b9'] + $b10['b10'] + $b11['b11'];
				$bb12 = $b1['b1'] + $b2['b2'] + $b3['b3'] + $b4['b4'] + $b5['b5'] + $b6['b6'] + $b7['b7'] + $b8['b8'] + $b9['b9'] + $b10['b10'] + $b11['b11'] + $b12['b12'];
				?>

				<?php
				$fb1 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b1')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb2 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b2')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb3 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b3')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb4 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b4')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb5 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b5')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb6 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b6')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb7 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b7')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb8 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b8')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb9 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b9')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb10 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b10')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb11 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b11')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();
				$fb12 = $db->table('tb_ropk_fisik_aktifitas')->selectsum('tb_ropk_fisik_aktifitas.b12')->join('tb_ropk_fisik_group', 'tb_ropk_fisik_aktifitas.ropk_fisik_group_id = tb_ropk_fisik_group.id_ropk_fisik_group', 'left')->getWhere(['tb_ropk_fisik_group.dpa_id' => $dpa_id, 'tb_ropk_fisik_aktifitas.tahun' => $_SESSION['tahun']])->getRowArray();

				$fbb1 = $fb1['b1'];
				$fbb2 = $fb1['b1'] + $fb2['b2'];
				$fbb3 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'];
				$fbb4 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'];
				$fbb5 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'];
				$fbb6 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'] + $fb6['b6'];
				$fbb7 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'] + $fb6['b6'] + $fb7['b7'];
				$fbb8 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'] + $fb6['b6'] + $fb7['b7'] + $fb8['b8'];
				$fbb9 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'] + $fb6['b6'] + $fb7['b7'] + $fb8['b8'] + $fb9['b9'];
				$fbb10 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'] + $fb6['b6'] + $fb7['b7'] + $fb8['b8'] + $fb9['b9'] + $fb10['b10'];
				$fbb11 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'] + $fb6['b6'] + $fb7['b7'] + $fb8['b8'] + $fb9['b9'] + $fb10['b10'] + $fb11['b11'];
				$fbb12 = $fb1['b1'] + $fb2['b2'] + $fb3['b3'] + $fb4['b4'] + $fb5['b5'] + $fb6['b6'] + $fb7['b7'] + $fb8['b8'] + $fb9['b9'] + $fb10['b10'] + $fb11['b11'] + $fb12['b12'];
				?>
				<tbody>
					<tr>
						<?php $progres1 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b1'])->getRowArray(); ?>
						<td class="align-baseline">Januari</td>
						<td class="align-baseline"><?= isset($progres1['tahap_pekerjaan_fisik']) ? $progres1['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres1['faktor_penghambat']) ? $progres1['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres1['faktor_pendukung']) ? $progres1['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb1, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb1, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres1['realisasi_keu']) ? number_format($progres1['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres1['realisasi_fisik']) ? number_format($progres1['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres1['realisasi_keu']) ? round(($progres1['realisasi_keu'] / $bb1) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres1['realisasi_fisik']) ? number_format(round(($progres1['realisasi_fisik'] / $fbb1) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres1['created_at']) ? $progres1['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres1['bulan_lapor']) ? ($progres1['bulan_lapor'] > '01' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres1['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres1['id_emonev_progres'] . '/Januari'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b1' . '/Januari'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres1['id_dpa_indikator'])) { ?>
								<?php $indikator1 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres1['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b1'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator1['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b1' . '/Januari'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b1' . '/Januari'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres2 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b2'])->getRowArray(); ?>
						<td class="align-baseline">Februari</td>
						<td class="align-baseline"><?= isset($progres2['tahap_pekerjaan_fisik']) ? $progres2['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres2['faktor_penghambat']) ? $progres2['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres2['faktor_pendukung']) ? $progres2['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb2, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb2, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres2['realisasi_keu']) ? number_format($progres2['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres2['realisasi_fisik']) ? number_format($progres2['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres2['realisasi_keu']) ? round(($progres2['realisasi_keu'] / $bb2) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres2['realisasi_fisik']) ? number_format(round(($progres2['realisasi_fisik'] / $fbb2) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres2['created_at']) ? $progres2['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres2['bulan_lapor']) ? ($progres2['bulan_lapor'] > '02' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres2['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres2['id_emonev_progres'] . '/Februari'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b2' . '/Februari'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres2['id_dpa_indikator'])) { ?>
								<?php $indikator2 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres2['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b2'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator2['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b2' . '/Februari'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b2' . '/Februari'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres3 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b3'])->getRowArray(); ?>
						<td class="align-baseline">Maret</td>
						<td class="align-baseline"><?= isset($progres3['tahap_pekerjaan_fisik']) ? $progres3['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres3['faktor_penghambat']) ? $progres3['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres3['faktor_pendukung']) ? $progres3['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb3, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb3, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres3['realisasi_keu']) ? number_format($progres3['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres3['realisasi_fisik']) ? number_format($progres3['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres3['realisasi_keu']) ? round(($progres3['realisasi_keu'] / $bb3) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres3['realisasi_fisik']) ? number_format(round(($progres3['realisasi_fisik'] / $fbb3) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres3['created_at']) ? $progres3['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres3['bulan_lapor']) ? ($progres3['bulan_lapor'] > '03' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres3['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres3['id_emonev_progres'] . '/Maret'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b3' . '/Maret'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres3['id_dpa_indikator'])) { ?>
								<?php $indikator3 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres3['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b3'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator3['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b3' . '/Maret'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b3' . '/Maret'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres4 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b4'])->getRowArray(); ?>
						<td class="align-baseline">April</td>
						<td class="align-baseline"><?= isset($progres4['tahap_pekerjaan_fisik']) ? $progres4['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres4['faktor_penghambat']) ? $progres4['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres4['faktor_pendukung']) ? $progres4['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb4, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb4, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres4['realisasi_keu']) ? number_format($progres4['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres4['realisasi_fisik']) ? number_format($progres4['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres4['realisasi_keu']) ? round(($progres4['realisasi_keu'] / $bb4) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres4['realisasi_fisik']) ? number_format(round(($progres4['realisasi_fisik'] / $fbb4) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres4['created_at']) ? $progres4['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres4['bulan_lapor']) ? ($progres4['bulan_lapor'] > '04' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres4['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres4['id_emonev_progres'] . '/April'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b4' . '/April'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres4['id_dpa_indikator'])) {
								$indikator4 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres4['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b4'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator4['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b4' . '/April'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b4' . '/April'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres5 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b5'])->getRowArray(); ?>
						<td class="align-baseline">Mei</td>
						<td class="align-baseline"><?= isset($progres5['tahap_pekerjaan_fisik']) ? $progres5['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres5['faktor_penghambat']) ? $progres5['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres5['faktor_pendukung']) ? $progres5['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb5, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb5, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres5['realisasi_keu']) ? number_format($progres5['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres5['realisasi_fisik']) ? number_format($progres5['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres5['realisasi_keu']) ? round(($progres5['realisasi_keu'] / $bb5) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres5['realisasi_fisik']) ? number_format(round(($progres5['realisasi_fisik'] / $fbb5) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres5['created_at']) ? $progres5['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres5['bulan_lapor']) ? ($progres5['bulan_lapor'] > '05' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres5['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres5['id_emonev_progres'] . '/Mei'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b5' . '/Mei'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres5['id_dpa_indikator'])) { ?>
								<?php $indikator5 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres5['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b5'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator5['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b5' . '/Mei'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b5' . '/Mei'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres6 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b6'])->getRowArray(); ?>
						<td class="align-baseline">Juni</td>
						<td class="align-baseline"><?= isset($progres6['tahap_pekerjaan_fisik']) ? $progres6['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres6['faktor_penghambat']) ? $progres6['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres6['faktor_pendukung']) ? $progres6['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb6, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb6, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres6['realisasi_keu']) ? number_format($progres6['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres6['realisasi_fisik']) ? number_format($progres6['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres6['realisasi_keu']) ? round(($progres6['realisasi_keu'] / $bb6) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres6['realisasi_fisik']) ? number_format(round(($progres6['realisasi_fisik'] / $fbb6) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres6['created_at']) ? $progres6['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres6['bulan_lapor']) ? ($progres6['bulan_lapor'] > '06' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres6['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres6['id_emonev_progres'] . '/Juni'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b6' . '/Juni'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres6['id_dpa_indikator'])) { ?>
								<?php $indikator6 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres6['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b6'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator6['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b6' . '/Juni'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b6' . '/Juni'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres7 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b7'])->getRowArray(); ?>
						<td class="align-baseline">Juli</td>
						<td class="align-baseline"><?= isset($progres7['tahap_pekerjaan_fisik']) ? $progres7['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres7['faktor_penghambat']) ? $progres7['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres7['faktor_pendukung']) ? $progres7['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb7, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb7, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres7['realisasi_keu']) ? number_format($progres7['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres7['realisasi_fisik']) ? number_format($progres7['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres7['realisasi_keu']) ? round(($progres7['realisasi_keu'] / $bb7) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres7['realisasi_fisik']) ? number_format(round(($progres7['realisasi_fisik'] / $fbb7) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres7['created_at']) ? $progres7['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres7['bulan_lapor']) ? ($progres7['bulan_lapor'] > '07' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres7['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres7['id_emonev_progres'] . '/Juli'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b7' . '/Juli'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres7['id_dpa_indikator'])) { ?>
								<?php $indikator7 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres7['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b7'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator7['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b7' . '/Juli'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b7' . '/Juli'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres8 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b8'])->getRowArray(); ?>
						<td class="align-baseline">Agustus</td>
						<td class="align-baseline"><?= isset($progres8['tahap_pekerjaan_fisik']) ? $progres8['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres8['faktor_penghambat']) ? $progres8['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres8['faktor_pendukung']) ? $progres8['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb8, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb8, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres8['realisasi_keu']) ? number_format($progres8['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres8['realisasi_fisik']) ? number_format($progres8['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres8['realisasi_keu']) ? round(($progres8['realisasi_keu'] / $bb8) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres8['realisasi_fisik']) ? number_format(round(($progres8['realisasi_fisik'] / $fbb8) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres8['created_at']) ? $progres8['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres8['bulan_lapor']) ? ($progres8['bulan_lapor'] > '08' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres8['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres8['id_emonev_progres'] . '/Agustus'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b8' . '/Agustus'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres8['id_dpa_indikator'])) { ?>
								<?php $indikator8 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres8['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b8'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator8['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b8' . '/Agustus'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b8' . '/Agustus'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres9 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b9'])->getRowArray(); ?>
						<td class="align-baseline">September</td>
						<td class="align-baseline"><?= isset($progres9['tahap_pekerjaan_fisik']) ? $progres9['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres9['faktor_penghambat']) ? $progres9['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres9['faktor_pendukung']) ? $progres9['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb9, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb9, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres9['realisasi_keu']) ? number_format($progres9['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres9['realisasi_fisik']) ? number_format($progres9['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres9['realisasi_keu']) ? round(($progres9['realisasi_keu'] / $bb9) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres9['realisasi_fisik']) ? number_format(round(($progres9['realisasi_fisik'] / $fbb9) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres9['created_at']) ? $progres9['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres9['bulan_lapor']) ? ($progres9['bulan_lapor'] > '09' ? '<text color="red">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres9['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres9['id_emonev_progres'] . '/September'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b9' . '/September'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres9['id_dpa_indikator'])) { ?>
								<?php $indikator9 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres9['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b9'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator9['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b9' . '/September'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b9' . '/September'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres10 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b10'])->getRowArray(); ?>
						<td class="align-baseline">Oktober</td>
						<td class="align-baseline"><?= isset($progres10['tahap_pekerjaan_fisik']) ? $progres10['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres10['faktor_penghambat']) ? $progres10['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres10['faktor_pendukung']) ? $progres10['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb10, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb10, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres10['realisasi_keu']) ? number_format($progres10['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres10['realisasi_fisik']) ? number_format($progres10['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres10['realisasi_keu']) ? round(($progres10['realisasi_keu'] / $bb10) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres10['realisasi_fisik']) ? number_format(round(($progres10['realisasi_fisik'] / $fbb10) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres10['created_at']) ? $progres10['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres10['bulan_lapor']) ? ($progres10['bulan_lapor'] > '10' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres10['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres10['id_emonev_progres'] . '/Oktober'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b10' . '/Oktober'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres10['id_dpa_indikator'])) { ?>
								<?php $indikator10 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres10['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b10'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator10['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b10' . '/Oktober'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b10' . '/Oktober'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres11 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b11'])->getRowArray(); ?>
						<td class="align-baseline">November</td>
						<td class="align-baseline"><?= isset($progres11['tahap_pekerjaan_fisik']) ? $progres11['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres11['faktor_penghambat']) ? $progres11['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres11['faktor_pendukung']) ? $progres11['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb11, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb11, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres11['realisasi_keu']) ? number_format($progres11['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres11['realisasi_fisik']) ? number_format($progres11['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres11['realisasi_keu']) ? round(($progres11['realisasi_keu'] / $bb11) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres11['realisasi_fisik']) ? number_format(round(($progres11['realisasi_fisik'] / $fbb11) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres11['created_at']) ? $progres11['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres11['bulan_lapor']) ? ($progres11['bulan_lapor'] > '11' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres11['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres11['id_emonev_progres'] . '/November'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b11' . '/November'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres11['id_dpa_indikator'])) { ?>
								<?php $indikator11 = $db->table('tb_emonev_progres_indikator')
									->select('tb_emonev_progres_indikator.*')
									->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres11['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b11'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator11['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b11' . '/November'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b11' . '/November'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
					<tr>
						<?php $progres12 = $db->table('tb_emonev_progres')
							->select('tb_emonev_progres.*')
							->select('tb_dpa_indikator.id_dpa_indikator')
							->join('tb_dpa', 'tb_emonev_progres.dpa_id = tb_dpa.id_dpa', 'left')
							->join('tb_dpa_indikator', 'tb_dpa.id_dpa = tb_dpa_indikator.dpa_id', 'left')
							->getWhere(['tb_emonev_progres.dpa_id' => $dpa_id, 'tb_emonev_progres.tahun' => $_SESSION['tahun'], 'tb_emonev_progres.bulan' => 'b12'])->getRowArray(); ?>
						<td class="align-baseline">Desember</td>
						<td class="align-baseline"><?= isset($progres12['tahap_pekerjaan_fisik']) ? $progres12['tahap_pekerjaan_fisik'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres12['faktor_penghambat']) ? $progres12['faktor_penghambat'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres12['faktor_pendukung']) ? $progres12['faktor_pendukung'] : ''; ?></td>
						<td class="align-baseline text-right"><?= number_format($bb12, 0, ',', '.'); ?></td>
						<td class="align-baseline text-right"><?= number_format($fbb12, 2, ',', '.'); ?></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"></td>
						<td class="align-baseline text-right"><?= isset($progres12['realisasi_keu']) ? number_format($progres12['realisasi_keu'], 0, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres12['realisasi_fisik']) ? number_format($progres12['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres12['realisasi_keu']) ? round(($progres12['realisasi_keu'] / $bb12) * 100, 2) : ''; ?></td>
						<td class="align-baseline text-right"><?= isset($progres12['realisasi_fisik']) ? number_format(round(($progres12['realisasi_fisik'] / $fbb12) * 100, 2), 2, ',', '.') : ''; ?></td>
						<td class="align-baseline"><?= isset($progres12['created_at']) ? $progres12['created_at'] : ''; ?></td>
						<td class="align-baseline"><?= isset($progres12['bulan_lapor']) ? ($progres12['bulan_lapor'] > '12' ? '<text style="color: red;">Terlambat</text>' : 'Sudah Lapor') : 'Belum Lapor'; ?> </td>
						<td class="align-baseline text-right">
							<div class="col-md">
								<?php if (isset($progres12['id_emonev_progres'])) { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_edit/' . $dpa_id . '/' . $progres12['id_emonev_progres'] . '/Desember'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('/user/emonev/emonev/progres_add/' . $dpa_id . '/' . 'b12' . '/Desember'); ?>">
										<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
									</a>
								<?php } ?>
							</div>
							<?php if (isset($progres12['id_dpa_indikator'])) { ?>
								<?php $indikator12 = $db->table('tb_emonev_progres_indikator')->select('tb_emonev_progres_indikator.*')->getWhere(['tb_emonev_progres_indikator.dpa_indikator_id' => $progres12['id_dpa_indikator'], 'tb_emonev_progres_indikator.tahun' => $_SESSION['tahun'], 'tb_emonev_progres_indikator.bulan' => 'b12'])->getRowArray(); ?>
								<div class="col-md">
									<?php if (isset($indikator12['id_emonev_progres_indikator'])) { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_edit/' . $dpa_id . '/' . 'b12' . '/Desember'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } else { ?>
										<a href="<?= base_url('/user/emonev/emonev/progres_indikator_add/' . $dpa_id . '/' . 'b12' . '/Desember'); ?>">
											<li class="btn btn-block btn-primary btn-xs" active><i class="nav-icon fa fa-chart-bar"></i> Indikator</li>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
						</td>
						<td class="align-baseline"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>

<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"paging": false,
			"searching": false,
			"info": false,
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