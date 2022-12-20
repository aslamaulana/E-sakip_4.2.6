<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_program/opd_program_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/renstra/opd_program/import'); ?>">
			<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
		</a>
	</div>
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
				<th rowspan="2" class="text-center"> Aksi </th>
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
		<tbody id="listUser">
			<!-- Untuk menampilkan datanya, menggunakan JQuery + AJAX -->
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
		listUsers();
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
				targets: [1, 2, 4, 7, 10, 13, 16, 19, 22, 24]
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
							.append('<td class="align-top text-right">' + rows.data().pluck(22)[0] + ' </td>')
							.append('<td class="text-center align-top">' + rows.data().pluck(24)[0] + '</td>');
					}
				},
				dataSrc: [1, 2]
			}
		});

		// list all user in datatable
		function listUsers() {
			$.ajax({
				url: '<?php echo base_url('/user/renstra/opd_program/tampilkanData'); ?>',
				async: false,
				dataType: 'json',
				success: function(data) {
					var html = '';
					var i;
					var no = 1;
					for (i = 0; i < data.length; i++) {
						html += '<tr id="' + data[i].id_opd_program + '">' +
							'<td>' + data[i].opd_indikator_program + '</td>' +
							'<td>' + '[SASARAN] ' + data[i].opd_sasaran_n + '</td>' +
							'<td>' + '[' + data[i].id_program + ']' + data[i].opd_program_n + '</td>' +
							'<td></td>' +
							'<td>' + data[i].opd_program_sasaran_n + '</td>' +
							'<td>' + data[i].t_2021 + ' ' + data[i].satuan + '</td>' +
							'<td></td>' +
							'<td></td>' +
							'<td>' + data[i].t_2022 + ' ' + data[i].satuan + '</td>' +
							'<td></td>' +
							'<td></td>' +
							'<td>' + data[i].t_2023 + ' ' + data[i].satuan + '</td>' +
							'<td></td>' +
							'<td></td>' +
							'<td>' + data[i].t_2024 + ' ' + data[i].satuan + '</td>' +
							'<td></td>' +
							'<td></td>' +
							'<td>' + data[i].t_2025 + ' ' + data[i].satuan + '</td>' +
							'<td></td>' +
							'<td></td>' +
							'<td>' + data[i].t_2026 + ' ' + data[i].satuan + '</td>' +
							'<td></td>' +
							'<td></td>' +
							'<td style="text-align:right;">' +
							'<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="' + data[i].id + '" data-username="' + data[i].username + '"data-email="' + data[i].email + '">Edit</a>' + ' ' +
							'<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="' + data[i].id + '">Delete</a>' +
							'</td>' +
							'<td style="text-align:right;">' +
							'<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="' + data[i].id + '" data-username="' + data[i].username + '"data-email="' + data[i].email + '">Edit</a>' + ' ' +
							'<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="' + data[i].id + '">Delete</a>' +
							'</td>' +
							'</tr>';
					}
					$('#listUser').html(html);
				}
			});
			return false;
		}
	});
</script>
<?= $this->endSection(); ?>