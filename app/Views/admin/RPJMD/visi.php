<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" width="60px">Kode</th>
				<th>Visi / Misi</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">Kode</th>
				<th>Visi / Misi</th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($visi as $row) : ?>
				<tr>
					<td><?= $row['kode_misi']; ?></td>
					<td style="padding-left: 40px;"><b>[MISI]</b> <?= $row['misi']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td><?= $row['kode_visi']; ?></td>
					<td><b>[VISI]</b> <a href="<?= base_url() . '/admin/rpjmd/visi/misi_add/' . $row['id_visi']; ?>" title="add misi"><?= $row['visi']; ?></a></td>
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
			columnDefs: [{
				visible: false,
				targets: [2, 3]
			}],
			order: [
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {
					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td>' + rows.data().pluck(3)[0] + '</td>');
					}
				},
				dataSrc: [2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>