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
						<?php $NilaiSum = $db->table('tb_sakip_instansi_jawaban')
							->selectSum('nilai')
							->join('tb_sakip_instansi', 'tb_sakip_instansi_jawaban.sakip_instansi_id = tb_sakip_instansi.id_sakip_instansi', 'LEFT')
							->getWhere([
								'tb_sakip_instansi.komponen_sub_n' => $row['komponen_sub'],
								'tb_sakip_instansi_jawaban.opd_id' => user()->opd_id,
								'tb_sakip_instansi_jawaban.tahun' => $_SESSION['tahun']
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