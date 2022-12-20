<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr>
				<th rowspan="2">
					<div style="width: 700px;">Sasaran / Program / Program Indikator</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2">
					<div style="width: 350px;">Sasaran Kegiatan</div>
				</th>
				<th rowspan="2"></th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
					<th rowspan="2"></th>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center align-middle">
						<div style="width: 120px;">Target</div>
					</th>
					<th class="text-center align-middle">
						<div style="width: 150px;">Pagu</div>
					</th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($opd_program as $rom) { ?>
				<tr>
					<td class="text-wrap">
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_program']; ?></div>
					</td>
					<td>[SASARAN] <?= $rom['opd_sasaran_n']; ?></td>
					<td>
						<div style="padding-left: 20px;">[<?= $rom['id_program']; ?>] <?= $rom['opd_program_n']; ?></div>
					</td>
					<td></td>
					<td><?= $rom['opd_program_sasaran_n']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu1 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2021')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo isset($pagu1['rp_2021']) ? number_format($pagu1['rp_2021'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu2 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2022')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo isset($pagu2['rp_2022']) ? number_format($pagu2['rp_2022'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu3 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2023')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo isset($pagu3['rp_2023']) ? number_format($pagu3['rp_2023'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu4 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2024')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo isset($pagu4['rp_2024']) ? number_format($pagu4['rp_2024'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu5 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2025')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo isset($pagu5['rp_2025']) ? number_format($pagu5['rp_2025'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu6 = $db->table('vw_pagu_renstra_program')
							->selectsum('rp_2026')
							->getWhere(['vw_pagu_renstra_program.opd_program_n' => $rom['opd_program_n'], 'vw_pagu_renstra_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_renstra_program.opd_id' => user()->opd_id])->getRowArray();
						echo isset($pagu6['rp_2026']) ? number_format($pagu6['rp_2026'], 0, ',', '.') : '0';
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') ?>"></script>
<script>
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				// targets: [1, 2, 3, 27]
				targets: [1, 2, 4, 7, 10, 13, 16, 19, 22]
			}],
			order: [
				[1, 'asc'],
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(1)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(2)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top text-wrap">' + group + '</td>')
							.append('<td class="text-wrap align-top">' + rows.data().pluck(4)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(7)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(10)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(13)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(16)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(19)[0] + ' </td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(22)[0] + ' </td>');
					}
				},
				dataSrc: [1, 2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>