<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="align-middle">
					<div style="width: 550px;">Komponen / Sub Komponen</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 80px;">Bobot %</div>
				</th>
				<th colspan="3" class="text-center">
					<div style="width: 250px;">Nilai Akuntabilitas Kinerja</div>
				</th>
				<th rowspan="2" class="text-center align-middle" style="margin:0;">
					<div style="width: 150px;">Keterangan</div>
				</th>
			</tr>
			<tr>
				<th class="text-center">Nilai</th>
				<th class="text-center">Persentase</th>
				<th class="text-center">Predikat</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$komponen = $db->table('tb_sakip_komponen')->get()->getResultArray();
			foreach ($komponen as $rom) : ?>
				<tr class="font-weight-bold" style="background-color: blanchedalmond;">
					<td>[Komponen] <?= $rom['komponen']; ?></td>
					<td class="text-center"><?= number_format($rom['komponen_bobot'], 2, ',', '.'); ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$komponen_sub = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen']])->getResultArray();
				foreach ($komponen_sub as $row) : ?>
					<tr>
						<td class="text-wrap">
							<div style="padding-left: 40px;"><?= $row['komponen_sub']; ?></div>
						</td>
						<td class="text-center"><?= number_format($row['komponen_bobot_sub'], 2, ',', '.'); ?></td>

						<!-- ------------------------------------------------------ -->
						<?php $banyak_data = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $row['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						<?php $NilaiSum = $db->table('tb_sakip_instansi_jawaban_lhe')
							->selectSum('nilai')
							->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
							->getWhere([
								'tb_sakip_instansi.komponen_sub_n' => $row['komponen_sub'],
								'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
								'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun']
							])->getRowArray(); ?>

						<td class="text-center">
							<?php
							try {
								echo number_format($TotalNilaiSum[] = ($NilaiSum['nilai'] / $banyak_data), 2, ',', '.');
							} catch (DivisionByZeroError $e) {
								$TotalNilaiSum[] = '0';
								echo "0";
							}
							?>
						</td>
						<td class="text-center">
							<?php
							try {
								echo round((($NilaiSum['nilai'] / $banyak_data) * $row['komponen_bobot_sub']) / 100, 2);
							} catch (DivisionByZeroError $e) {
								echo "0";
							}
							?>
						</td>
						<td class="text-center">
							<?php
							try {
								echo ($NilaiSum['nilai'] / $banyak_data) == '100' ? 'AA' : (($NilaiSum['nilai'] / $banyak_data) < '100' && ($NilaiSum['nilai'] / $banyak_data) >= '90' ? 'A' : (($NilaiSum['nilai'] / $banyak_data) < '90' && ($NilaiSum['nilai'] / $banyak_data) >= '80' ? 'BB' : (($NilaiSum['nilai'] / $banyak_data) < '80' && ($NilaiSum['nilai'] / $banyak_data) >= '70' ? 'B' : (($NilaiSum['nilai'] / $banyak_data) < '70' && ($NilaiSum['nilai'] / $banyak_data) >= '60' ? 'CC' : (($NilaiSum['nilai'] / $banyak_data) < '60' && ($NilaiSum['nilai'] / $banyak_data) >= '50' ? 'C' : (($NilaiSum['nilai'] / $banyak_data) < '50' && ($NilaiSum['nilai'] / $banyak_data) >= '30' ? 'D' : 'E'))))));
							} catch (DivisionByZeroError $e) {
								echo "0";
							}
							?>
						</td>
						<td class="text-center">
							<?php
							if ($NilaiSum['nilai'] > 0) {
								if (($NilaiSum['nilai'] / $banyak_data) == '100') {
									echo 'Seluruh kriteria telah terpenuhi dan terdapat upaya inovatif serta layak menjadi percontohan secara nasional.';
								} elseif (($NilaiSum['nilai'] / $banyak_data) < '100' && ($NilaiSum['nilai'] / $banyak_data) >= '90') {
									echo 'Seluruh kriteria telah terpenuhi dan terdapat beberapa upaya yang bisa dihargai dari pemenuhan kriteria tersebut.';
								} elseif (($NilaiSum['nilai'] / $banyak_data) < '90' && ($NilaiSum['nilai'] / $banyak_data) >= '80') {
									echo 'Seluruh kriteria telah terpenuhi  sesuai dengan mandat kebijakan.';
								} elseif (($NilaiSum['nilai'] / $banyak_data) < '80' && ($NilaiSum['nilai'] / $banyak_data) >= '70') {
									echo 'Sebagian besar kriteria telah terpenuhi';
								} elseif (($NilaiSum['nilai'] / $banyak_data) < '70' && ($NilaiSum['nilai'] / $banyak_data) >= '60') {
									echo 'Sebagian besar kriteria telah terpenuhi';
								} elseif (($NilaiSum['nilai'] / $banyak_data) < '60' && ($NilaiSum['nilai'] / $banyak_data) >= '50') {
									echo 'Sebagian kecil kriteria telah terpenuhi';
								} elseif (($NilaiSum['nilai'] / $banyak_data) < '50' && ($NilaiSum['nilai'] / $banyak_data) >= '30') {
									echo 'Penilaian akuntabilitas kinerja telah mulai dipenuhi';
								} else {
									echo 'Tidak ada upaya dalam pemenuhan kriteria penialaian akuntabilitas Kinerja.';
								};
							}
							?></td>
						<!-- ------------------------------------------------------ -->
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr style="width: 1302.04px;background-color: rgb(204 208 211);">
				<th colspan="2" class="text-center">
					Jumlah
				</th>
				<th colspan="3" class="text-center"><?= round(array_sum($TotalNilaiSum), 2); ?></th>
				<th></th>
			</tr>
			<tr style="width: 1302.04px;background-color: rgb(204 208 211);">
				<th colspan="2" class="text-center">
					Predikat
				</th>

				<th colspan="3" class="text-center">
					<?php
					try {
						echo (array_sum($TotalNilaiSum) / $banyak_data) == '100' ? 'AA' : ((array_sum($TotalNilaiSum) / $banyak_data) < '100' && (array_sum($TotalNilaiSum) / $banyak_data) >= '90' ? 'A' : ((array_sum($TotalNilaiSum) / $banyak_data) < '90' && (array_sum($TotalNilaiSum) / $banyak_data) >= '80' ? 'BB' : ((array_sum($TotalNilaiSum) / $banyak_data) < '80' && (array_sum($TotalNilaiSum) / $banyak_data) >= '70' ? 'B' : ((array_sum($TotalNilaiSum) / $banyak_data) < '70' && (array_sum($TotalNilaiSum) / $banyak_data) >= '60' ? 'CC' : ((array_sum($TotalNilaiSum) / $banyak_data) < '60' && (array_sum($TotalNilaiSum) / $banyak_data) >= '50' ? 'C' : ((array_sum($TotalNilaiSum) / $banyak_data) < '50' && (array_sum($TotalNilaiSum) / $banyak_data) >= '30' ? 'D' : 'E'))))));
					} catch (DivisionByZeroError $e) {
						echo "0";
					}
					?>
				</th>
				<th></th>
			</tr>
		</tfoot>
	</table>
	<br>
	<br>
	<!-- ================================================== -->
	<!-- ====================Table 1======================= -->
	<!-- ================================================== -->
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th rowspan="3" class="align-middle">
					<div style="width: 150px;">Komponen</div>
				</th>
				<th colspan="9" class="text-center align-middle">sub Komponen </th>
				<th colspan="3" rowspan="2" class="text-center align-middle">sub Komponen </th>
			</tr>
			<tr>
				<th colspan="3" class="text-center">Sub Komponen 1 <br> Keberadaan (20%)</th>
				<th colspan="3" class="text-center">Sub Komponen 2 <br> Kualitas (30%)</th>
				<th colspan="3" class="text-center">Sub Komponen 3 <br> Pemanfaatan (50%)</th>
			</tr>
			<tr>
				<th class="text-center">Bobot</th>
				<th class="text-center">Capaian</th>
				<th class="text-center">Nilai</th>
				<th class="text-center">Bobot</th>
				<th class="text-center">Capaian</th>
				<th class="text-center">Nilai</th>
				<th class="text-center">Bobot</th>
				<th class="text-center">Capaian</th>
				<th class="text-center">Nilai</th>
				<th class="text-center">Total Bobot</th>
				<th class="text-center">Total Capaian</th>
				<th class="text-center">Total Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$komponen = $db->table('tb_sakip_komponen')->get()->getResultArray();
			foreach ($komponen as $rom) : ?>
				<tr>
					<td><?= $rom['komponen']; ?></td>
					<?php $bobot1 = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '1'])->getRowArray(); ?>
					<td class="text-center"><?= $TotalBobot1[] = $bobot1['komponen_bobot_sub']; ?></td>
					<?php $banyak_data1 = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot1['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows(); ?>
					<?php $NilaiSum1 = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot1['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun']
						])->getRowArray(); ?>
					<td class="text-center">
						<?php
						try {
							echo number_format($TotalNilaiSum1[] = ($NilaiSum1['nilai'] / $banyak_data1), 2, ',', '.');
						} catch (DivisionByZeroError $e) {
							$TotalNilaiSum[] = '0';
							echo "0";
						}
						?>
					</td>
					<td class="text-center">
						<?php
						try {
							$Nilai1 = (($NilaiSum1['nilai'] / $banyak_data1) * $bobot1['komponen_bobot_sub']) / 100;
							$TotalNilai1[] = (($NilaiSum1['nilai'] / $banyak_data1) * $bobot1['komponen_bobot_sub']) / 100;
							echo round((($NilaiSum1['nilai'] / $banyak_data1) * $bobot1['komponen_bobot_sub']) / 100, 2);
						} catch (DivisionByZeroError $e) {
							$Nilai1 = '0';
							$TotalNilai1[] = '0';
							echo "0";
						}
						?>
					</td>

					<?php $bobot2 = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '2'])->getRowArray(); ?>
					<td class="text-center"><?= $TotalBobot2[] = $bobot2['komponen_bobot_sub']; ?></td>
					<?php $banyak_data2 = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot2['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows(); ?>
					<?php $NilaiSum2 = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot2['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun']
						])->getRowArray(); ?>
					<td class="text-center">
						<?php
						try {
							echo number_format($TotalNilaiSum2[] = ($NilaiSum2['nilai'] / $banyak_data2), 2, ',', '.');
						} catch (DivisionByZeroError $e) {
							$TotalNilaiSum2[] = '0';
							echo "0";
						}
						?>
					</td>
					<td class="text-center">
						<?php
						try {
							$Nilai2 = (($NilaiSum2['nilai'] / $banyak_data2) * $bobot2['komponen_bobot_sub']) / 100;
							$TotalNilai2[] = (($NilaiSum2['nilai'] / $banyak_data2) * $bobot2['komponen_bobot_sub']) / 100;
							echo round((($NilaiSum2['nilai'] / $banyak_data2) * $bobot2['komponen_bobot_sub']) / 100, 2);
						} catch (DivisionByZeroError $e) {
							$Nilai2 = '0';
							$TotalNilai2[] = '0';
							echo "0";
						}
						?>
					</td>

					<?php $bobot3 = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '3'])->getRowArray(); ?>
					<td class="text-center"><?= $TotalBobot3[] = $bobot3['komponen_bobot_sub']; ?></td>
					<?php $banyak_data3 = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot3['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows(); ?>
					<?php $NilaiSum3 = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot3['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun']
						])->getRowArray(); ?>
					<td class="text-center">
						<?php
						try {
							echo number_format($TotalNilaiSum3[] = ($NilaiSum3['nilai'] / $banyak_data3), 2, ',', '.');
						} catch (DivisionByZeroError $e) {
							echo "0";
						}
						?>
					</td>
					<td class="text-center">
						<?php
						try {
							$Nilai3 = (($NilaiSum3['nilai'] / $banyak_data3) * $bobot3['komponen_bobot_sub']) / 100;
							$TotalNilai3[] = (($NilaiSum3['nilai'] / $banyak_data3) * $bobot3['komponen_bobot_sub']) / 100;
							echo round((($NilaiSum3['nilai'] / $banyak_data3) * $bobot3['komponen_bobot_sub']) / 100, 2);
						} catch (DivisionByZeroError $e) {
							$Nilai3 = '0';
							$TotalNilai3[] = '0';
							echo "0";
						}
						?>
					</td>

					<td class="text-center">
						<?php $BobotKomponen[] = $rom['komponen_bobot']; ?>
						<?= $rom['komponen_bobot']; ?>
					</td>
					<td class="text-center">
						<?= round((($Nilai1 + $Nilai2 + $Nilai3) / $rom['komponen_bobot']) * 100, 2); ?>
					</td>
					<td class="text-center">
						<?php $NilaiTotal[] = ($Nilai1 + $Nilai2 + $Nilai3); ?>
						<?= round(($Nilai1 + $Nilai2 + $Nilai3), 2); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			<tr style="background: azure;">
				<th class="text-center">Nilai Akuntabilitas Kinerja</th>
				<th class="text-center"><?= array_sum($TotalBobot1); ?></th>
				<th class="text-center"></th>
				<th class="text-center"><?= round(array_sum($TotalNilai1), 2); ?></th>
				<th class="text-center"><?= array_sum($TotalBobot2); ?></th>
				<th class="text-center"></th>
				<th class="text-center"><?= round(array_sum($TotalNilai2), 2); ?></th>
				<th class="text-center"><?= array_sum($TotalBobot3); ?></th>
				<th class="text-center"></th>
				<th class="text-center"><?= round(array_sum($TotalNilai3), 2); ?></th>
				<th class="text-center"><?= round(array_sum($BobotKomponen), 2); ?></th>
				<th class="text-center"></th>
				<th class="text-center"><?= round(array_sum($NilaiTotal), 2); ?></th>
			</tr>
		</tbody>
	</table><br><br>

	<!-- ================================================== -->
	<!-- ====================Table 2======================= -->
	<!-- ================================================== -->

	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th class="align-middle">
					<div style="width: 150px;">Komponen</div>
				</th>
				<th class="text-center">Total Bobot</th>
				<th class="text-center">Tahun Sebelumnya</th>
				<th class="text-center">Tahun Ini</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$komponen = $db->table('tb_sakip_komponen')->get()->getResultArray();
			foreach ($komponen as $rom) : ?>
				<tr>
					<td><?= $rom['komponen']; ?></td>
					<!-- ------------------------------------------------------------------------ -->
					<?php $bobot1_n = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '1'])->getRowArray(); ?>
					<?php $banyak_data1_n = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot1_n['komponen_sub'], 'tahun' => $_SESSION['tahun'] - 1])->getNumRows(); ?>
					<?php $NilaiSum1_n = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot1_n['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun'] - 1
						])->getRowArray(); ?>
					<?php
					try {
						$Nilai1_n = (($NilaiSum1_n['nilai'] / $banyak_data1_n) * $bobot1_n['komponen_bobot_sub']) / 100;
						$TotalNilai1_n[] = (($NilaiSum1_n['nilai'] / $banyak_data1_n) * $bobot1_n['komponen_bobot_sub']) / 100;
					} catch (DivisionByZeroError $e) {
						$Nilai1_n = '0';
						$TotalNilai1_n[] = '0';
					} ?>

					<?php $bobot2_n = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '2'])->getRowArray(); ?>
					<?php $banyak_data2_n = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot2_n['komponen_sub'], 'tahun' => $_SESSION['tahun'] - 1])->getNumRows(); ?>
					<?php $NilaiSum2_n = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot2_n['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun'] - 1
						])->getRowArray(); ?>
					<?php
					try {
						$Nilai2_n = (($NilaiSum2_n['nilai'] / $banyak_data2_n) * $bobot2_n['komponen_bobot_sub']) / 100;
						$TotalNilai2_n[] = (($NilaiSum2_n['nilai'] / $banyak_data2_n) * $bobot2_n['komponen_bobot_sub']) / 100;
					} catch (DivisionByZeroError $e) {
						$Nilai2_n = '0';
						$TotalNilai2_n[] = '0';
					} ?>

					<?php $bobot3_n = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '3'])->getRowArray(); ?>
					<?php $banyak_data3_n = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot3_n['komponen_sub'], 'tahun' => $_SESSION['tahun'] - 1])->getNumRows(); ?>
					<?php $NilaiSum3_n = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot3_n['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun'] - 1
						])->getRowArray(); ?>
					<?php
					try {
						$Nilai3_n = (($NilaiSum3_n['nilai'] / $banyak_data3_n) * $bobot3_n['komponen_bobot_sub']) / 100;
						$TotalNilai3_n[] = (($NilaiSum3_n['nilai'] / $banyak_data3_n) * $bobot3_n['komponen_bobot_sub']) / 100;
					} catch (DivisionByZeroError $e) {
						$Nilai3_n = '0';
						$TotalNilai3_n[] = '0';
					} ?>
					<!-- ------------------------------------------------------------------------ -->
					<!-- ------------------------------------------------------------------------ -->
					<?php $bobot1 = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '1'])->getRowArray(); ?>
					<?php $banyak_data1 = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot1['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows(); ?>
					<?php $NilaiSum1 = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot1['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun']
						])->getRowArray(); ?>
					<?php
					try {
						$Nilai1 = (($NilaiSum1['nilai'] / $banyak_data1) * $bobot1['komponen_bobot_sub']) / 100;
						$TotalNilai1[] = (($NilaiSum1['nilai'] / $banyak_data1) * $bobot1['komponen_bobot_sub']) / 100;
					} catch (DivisionByZeroError $e) {
						$Nilai1 = '0';
						$TotalNilai1[] = '0';
					}
					?>
					<?php $bobot2 = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '2'])->getRowArray(); ?>
					<?php $banyak_data2 = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot2['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows(); ?>
					<?php $NilaiSum2 = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot2['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun']
						])->getRowArray(); ?>
					<?php
					try {
						$Nilai2 = (($NilaiSum2['nilai'] / $banyak_data2) * $bobot2['komponen_bobot_sub']) / 100;
						$TotalNilai2[] = (($NilaiSum2['nilai'] / $banyak_data2) * $bobot2['komponen_bobot_sub']) / 100;
					} catch (DivisionByZeroError $e) {
						$Nilai2 = '0';
						$TotalNilai2[] = '0';
					}
					?>
					<?php $bobot3 = $db->table('tb_sakip_komponen_sub')->getWhere(['komponen_n' => $rom['komponen'], 'kode_komponen_sub' => '3'])->getRowArray(); ?>
					<?php $banyak_data3 = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $bobot3['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows(); ?>
					<?php $NilaiSum3 = $db->table('tb_sakip_instansi_jawaban_lhe')
						->selectSum('nilai')
						->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban_lhe.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
						->getWhere([
							'tb_sakip_instansi.komponen_sub_n' => $bobot3['komponen_sub'],
							'tb_sakip_instansi_jawaban_lhe.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban_lhe.tahun' => $_SESSION['tahun']
						])->getRowArray(); ?>
					<?php
					try {
						$Nilai3 = (($NilaiSum3['nilai'] / $banyak_data3) * $bobot3['komponen_bobot_sub']) / 100;
						$TotalNilai3[] = (($NilaiSum3['nilai'] / $banyak_data3) * $bobot3['komponen_bobot_sub']) / 100;
					} catch (DivisionByZeroError $e) {
						$Nilai3 = '0';
						$TotalNilai3[] = '0';
					}
					?>
					<!-- ------------------------------------------------------------------------ -->

					<td class="text-center">
						<?php $BobotKomponen[] = $rom['komponen_bobot']; ?>
						<?= $rom['komponen_bobot']; ?>
					</td>
					<td class="text-center">
						<?php $NilaiTotal_n[$rom['kode_komponen']][] = ($Nilai1_n + $Nilai2_n + $Nilai3_n); ?>
						<?= round(($Nilai1_n + $Nilai2_n + $Nilai3_n), 2); ?>
					</td>
					<td class="text-center">
						<?php $NilaiTotal[$rom['kode_komponen']][] = ($Nilai1 + $Nilai2 + $Nilai3); ?>
						<?= round(($Nilai1 + $Nilai2 + $Nilai3), 2); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table><br><br>

	<!-- ================================================== -->
	<!-- ====================Grafik======================== -->
	<!-- ================================================== -->

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['bar']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			/* var data = google.visualization.arrayToDataTable([
				['Tahun', 'Perencanaan Kinerja', 'Pengukuran Kinerja', 'Pelaporan Kinerja', 'Evaluasi Akuntabilitas Kinerja Internal'],
				['2021', 1, 2, 3, 4],
				['2022', 7, 8, 9, 10]
			]); */
			var data = google.visualization.arrayToDataTable([
				['Tahun', 'Perencanaan Kinerja', 'Pengukuran Kinerja', 'Pelaporan Kinerja', 'Evaluasi Akuntabilitas Kinerja Internal'],
				['2021', <?= array_sum($NilaiTotal_n['01']); ?>, <?= array_sum($NilaiTotal_n['02']); ?>, <?= array_sum($NilaiTotal_n['03']); ?>, <?= array_sum($NilaiTotal_n['04']); ?>],
				['2022', <?= array_sum($NilaiTotal['01']); ?>, <?= array_sum($NilaiTotal['02']); ?>, <?= array_sum($NilaiTotal['03']); ?>, <?= array_sum($NilaiTotal['04']); ?>]
			]);

			var options = {
				chart: {
					title: 'Grafik Hasil Evaluasi',
					subtitle: '<?php echo $_SESSION['tahun'] - 1 . ' - ' . $_SESSION['tahun']; ?>',
				}
			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		}
	</script>

	<table id="example1" class="table table-bordered display nowrap table-sm">
		<tr>
			<td style="text-align: center;">
				<div id="columnchart_material" style="width: 1200px;height: 500px;text-align: center;margin: auto;"></div>
			</td>
		</tr>
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
			"info": false,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			/* columnDefs: [{
				visible: false,
				targets: [1, 2]
			}],
			order: [
				[2, 'asc'],
				[1, 'asc']
			],
			rowGroup: {

				startRender: function(rows, group) {
					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td colspan="7" class="align-top text-wrap font-weight-bold">' + group + '</td>');
					} else if (rows.data().pluck(1)[0] == group) {
						return $('<tr class="font-weight-bold" style="background: azure;" />')
							.append('<td colspan="7" class="align-top text-wrap"><div style="padding-left: 40px;">' + group + '</div></td>');
					}
				},
				dataSrc: [2, 1]
			} */
		});
	});
</script>
<?= $this->endSection(); ?>