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
				<th style="width: 90%;">Strategi / Arah Kebijakan</th>
				<th></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Strategi / Arah Kebijakan</th>
				<th></th>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($arah_kebijakan as $rol) : ?>
				<tr>
					<td>
						<div style="padding-left:40px;"><?= $rol['arah_kebijakan']; ?></div>
					</td>
					<!-- --------------------------------------------------------- -->
					<td class="align-top font-weight-bold text-justify">[STRATEGI] <?= $rol['strategi_n']; ?></td>
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
				targets: [1]
			}],
			order: [
				[1, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(1)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>');
					}
				},
				dataSrc: [1]
			},
		});
	});
</script>
<?= $this->endSection(); ?>