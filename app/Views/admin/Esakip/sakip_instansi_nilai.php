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
					<div style="width: 750px;">Komponen / Sub Komponen</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 80px;">Bobot %</div>
				</th>
				<th colspan="2" class="text-center text-wrap">
					<div style="width: 200px;margin: auto;">Nilai Akuntabilitas Kinerja Unit Utama</div>
				</th>
				<th colspan="2" class="text-center text-wrap">
					<div style="width: 200px;margin: auto;">Nilai Akuntabilitas Kinerja Unit Pendukung</div>
				</th>
				<th colspan="2" class="text-center text-wrap">
					<div style="width: 200px;margin: auto;">Nilai Akuntabilitas Kinerja Unit Tambahan</div>
				</th>
				<th colspan="2" class="text-center text-wrap align-middle">
					<div style="width: 200px;margin: auto;">Nilai Akuntabilitas Kinerja</div>
				</th>
			</tr>
			<tr>
				<th class="text-center">Nilai</th>
				<th class="text-center">Persentase</th>
				<th class="text-center">Nilai</th>
				<th class="text-center">Persentase</th>
				<th class="text-center">Nilai</th>
				<th class="text-center">Persentase</th>
				<th class="text-center">Nilai</th>
				<th class="text-center">Persentase</th>
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
						<?php
						$banyak_data = $db->table('tb_sakip_instansi')->getWhere(['komponen_sub_n' => $row['komponen_sub'], 'tahun' => $_SESSION['tahun']])->getNumRows();
						$banyak_opd_utama = $db->table('tb_sakip_opd')->getWhere(['unit_utama' => 'ya', 'sempel' => 'ya'])->getNumRows();
						$banyak_data_utama = $banyak_data * $banyak_opd_utama;
						?>

						<?php $NilaiSum_utama = $db->table('tb_sakip_instansi_jawaban')
							->selectSum('nilai')
							->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
							->join('tb_sakip_opd', 'tb_sakip_instansi_jawaban.opd_id = tb_sakip_opd.opd_id', 'LEFT')
							->getWhere([
								'tb_sakip_instansi.komponen_sub_n' => $row['komponen_sub'],
								'tb_sakip_opd.unit_utama' => 'ya',
								'tb_sakip_opd.sempel' => 'ya',
								'tb_sakip_instansi_jawaban.tahun' => $_SESSION['tahun']
							])->getRowArray(); ?>

						<td class="text-center">
							<?php
							try {
								echo number_format(($NilaiSum_utama['nilai'] / $banyak_data_utama), 2, ',', '.');
								$TotalNilaiSum_utama[] = ($NilaiSum_utama['nilai'] / $banyak_data_utama);
								$nilai_utama = ($NilaiSum_utama['nilai'] / $banyak_data_utama);
							} catch (DivisionByZeroError $e) {
								echo '0';
								$TotalNilaiSum_utama[] = '0';
								$nilai_utama = '0';
							} ?>
						</td>
						<td class="text-center">
							<?php
							try {
								echo round((($NilaiSum_utama['nilai'] / $banyak_data_utama) * $row['komponen_bobot_sub']) / 100, 2);
								$persen_utama = (($NilaiSum_utama['nilai'] / $banyak_data_utama) * $row['komponen_bobot_sub']) / 100;
							} catch (DivisionByZeroError $e) {
								echo '0';
								$persen_utama = '0';
							} ?>
						</td>
						<!-- ------------------------------------------------------ -->
						<!-- ------------------------------------------------------ -->
						<?php
						$banyak_opd_pendukung = $db->table('tb_sakip_opd')->getWhere(['unit_pendukung' => 'ya', 'sempel' => 'ya'])->getNumRows();
						$banyak_data_pendukung = $banyak_data * $banyak_opd_pendukung;
						?>

						<?php $NilaiSum_pendukung = $db->table('tb_sakip_instansi_jawaban')
							->selectSum('nilai')
							->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
							->join('tb_sakip_opd', 'tb_sakip_instansi_jawaban.opd_id = tb_sakip_opd.opd_id', 'LEFT')
							->getWhere([
								'tb_sakip_instansi.komponen_sub_n' => $row['komponen_sub'],
								'tb_sakip_opd.unit_pendukung' => 'ya',
								'tb_sakip_opd.sempel' => 'ya',
								'tb_sakip_instansi_jawaban.tahun' => $_SESSION['tahun']
							])->getRowArray(); ?>

						<td class="text-center">
							<?php
							try {
								echo number_format(($NilaiSum_pendukung['nilai'] / $banyak_data_pendukung), 2, ',', '.');
								$TotalNilaiSum_pendukung[] = ($NilaiSum_pendukung['nilai'] / $banyak_data_pendukung);
								$nilai_pendukung = ($NilaiSum_pendukung['nilai'] / $banyak_data_pendukung);
							} catch (DivisionByZeroError $e) {
								echo '0';
								$TotalNilaiSum_pendukung[] = '0';
								$nilai_pendukung = '0';
							} ?>
						</td>
						<td class="text-center">
							<?php
							try {
								echo round((($NilaiSum_pendukung['nilai'] / $banyak_data_pendukung) * $row['komponen_bobot_sub']) / 100, 2);
								$persen_pendukung = (($NilaiSum_pendukung['nilai'] / $banyak_data_pendukung) * $row['komponen_bobot_sub']) / 100;
							} catch (DivisionByZeroError $e) {
								echo '0';
								$persen_pendukung = '0';
							} ?>
						</td>
						<!-- ------------------------------------------------------ -->
						<!-- ------------------------------------------------------ -->
						<?php
						$banyak_opd_tambahan = $db->table('tb_sakip_opd')->getWhere(['unit_tambahan' => 'ya', 'sempel' => 'ya'])->getNumRows();
						$banyak_data_tambahan = $banyak_data * $banyak_opd_tambahan;
						?>

						<?php $NilaiSum_tambahan = $db->table('tb_sakip_instansi_jawaban')
							->selectSum('nilai')
							->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
							->join('tb_sakip_opd', 'tb_sakip_instansi_jawaban.opd_id = tb_sakip_opd.opd_id', 'LEFT')
							->getWhere([
								'tb_sakip_instansi.komponen_sub_n' => $row['komponen_sub'],
								'tb_sakip_opd.unit_tambahan' => 'ya',
								'tb_sakip_opd.sempel' => 'ya',
								'tb_sakip_instansi_jawaban.tahun' => $_SESSION['tahun']
							])->getRowArray(); ?>

						<td class="text-center">
							<?php
							try {
								echo number_format(($NilaiSum_tambahan['nilai'] / $banyak_data_tambahan), 2, ',', '.');
								$TotalNilaiSum_tambahan[] = ($NilaiSum_tambahan['nilai'] / $banyak_data_tambahan);
								$nilai_tambahan = ($NilaiSum_tambahan['nilai'] / $banyak_data_tambahan);
							} catch (DivisionByZeroError $e) {
								echo '0';
								$TotalNilaiSum_tambahan[] = '0';
								$nilai_tambahan = '0';
							} ?>
						</td>
						<td class="text-center">
							<?php
							try {
								echo round((($NilaiSum_tambahan['nilai'] / $banyak_data_tambahan) * $row['komponen_bobot_sub']) / 100, 2);
								$persen_tambahan = (($NilaiSum_tambahan['nilai'] / $banyak_data_tambahan) * $row['komponen_bobot_sub']) / 100;
							} catch (DivisionByZeroError $e) {
								echo '0';
								$persen_tambahan = '0';
							} ?>
						</td>
						<!-- ------------------------------------------------------ -->
						<td class="text-center"><?= number_format($Akuntabilitas_Kinerja[] = ($nilai_utama + $nilai_pendukung + $nilai_tambahan), 2, ',', '.'); ?> </td>
						<td class="text-center"><?= round(($persen_utama + $persen_pendukung + $persen_tambahan), 2); ?> </td>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr style="width: 1302.04px;background-color: rgb(204 208 211);">
				<th colspan="8" class="text-center"> Nilai Akuntabilitas Kinerja </th>
				<th class="text-center"><?= round(array_sum($Akuntabilitas_Kinerja), 2); ?></th>
				<th></th>
			</tr>
		</tfoot>
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
			"paging": true,
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