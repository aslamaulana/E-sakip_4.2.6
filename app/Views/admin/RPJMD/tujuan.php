<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>
					<div style="width: 750px;">Visi / Misi / Tujuan / Tujuan Indikator</div>
				</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center">
						<div style="width: 120px;"><?= $row['tahun']; ?></div>
					</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tujuan as $row) : ?>
				<tr>
					<td></td>
					<td class="align-top" style=" padding-left: 40px;"><?= $row['indikator_tujuan']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td><?= $row['kode_tujuan']; ?></td>
					<td>[TUJUAN] <?= '<a href="/admin/rpjmd/tujuan/tujuan_indik_add?p=' . $row['tujuan'] . '&k=' . $row['kode_tujuan'] . '&m=' . $row['misi_n'] . '" title="Add Indikator Tujuan">' . $row['tujuan'] . '</a>'; ?></td>
					<!-- --------------------------------------------------------- -->
					<td><?= $row['kode_misi']; ?></td>
					<td>[MISI] <?= $row['misi_n']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td><?= $row['kode_visi']; ?></td>
					<td>[Visi] <?= $row['visi']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td class="align-top text-center"><?= $row['t_2021'] . ' ' . $row['satuan']; ?></td>
					<td class="align-top text-center"><?= $row['t_2022'] . ' ' . $row['satuan']; ?></td>
					<td class="align-top text-center"><?= $row['t_2023'] . ' ' . $row['satuan']; ?></td>
					<td class="align-top text-center"><?= $row['t_2024'] . ' ' . $row['satuan']; ?></td>
					<td class="align-top text-center"><?= $row['t_2025'] . ' ' . $row['satuan']; ?></td>
					<td class="align-top text-center"><?= $row['t_2026'] . ' ' . $row['satuan']; ?></td>
					<!-- --------------------------------------------------------- -->
				</tr>
			<?php endforeach; ?>
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
				targets: [2, 3, 4, 5, 6, 7]
			}],
			order: [
				[6, 'asc'],
				[4, 'asc'],
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(6)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(7)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(4)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(5)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(2)[0] == group) {

						return $('<tr />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					}
				},
				dataSrc: [6, 4, 2]
			},
		});
	});
</script>
<?= $this->endSection(); ?>