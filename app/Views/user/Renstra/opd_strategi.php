<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_strategi/opd_strategi_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<?php if ($_SESSION['perubahan'] == 'Perubahan') { ?>
		<div>
			<a onclick="if(confirm('Import langsung dari RENSTRA murni??')){location.href='<?= base_url() . '/user/renstra/opd_strategi/import_strategi'; ?>'}" href="#">
				<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
			</a>
		</div>
	<?php } ?>
<?php } else { ?>
	<div style="width:90px;">
		<a href="#">
			<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-lock"></i></li>
		</a>
	</div>
<?php } ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>Sasaran / strategi</th>
				<th></th>
				<th></th>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">Kode</th>
				<th>Sasaran / strategi</th>
				<th></th>
				<th></th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($opd_strategi as $rol) : ?>
				<tr>
					<td></td>
					<td>
						<div style="padding-left: 40px;"><?= $rol['opd_strategi']; ?></div>
					</td>
					<td class="align-top font-weight-bold"><?= $rol['opd_kode_sasaran_n']; ?></td>
					<td class="align-top font-weight-bold">[SASARAN] <?= $rol['opd_sasaran_n']; ?></td>
					<td class="text-center">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_strategi/opd_strategi_edit/' . $rol['id_opd_strategi']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_strategi/opd_strategi_hapus/' . $rol['id_opd_strategi']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
					</td>
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
				// targets: [1, 2, 3, 27]
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
							.append('<td>' + rows.data().pluck(3)[0] + '</td>')
							.append('<td></td>');
					}
				},
				dataSrc: [2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>