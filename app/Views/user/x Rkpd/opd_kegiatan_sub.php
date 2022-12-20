<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renja')->kunci == 'tidak') { ?>
	<div>
		<a href="<?= base_url('/user/rkpd/opd_kegiatan_sub/import'); ?>">
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
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 130px; margin:auto;">Kode</div>
				</th>
				<th rowspan="2" class="align-middle">
					<div style="width: 890px;">Program / Kegiatan / Sub Kegiatan Indikator</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th colspan="2" class="text-center align-middle"><?= $_SESSION['tahun']; ?></th>
				<th colspan="2" class="text-center align-middle"><?= $_SESSION['tahun'] + 1; ?></th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 120px; margin:auto;">Lokasi</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 120px; margin:auto;">Sumber Dana</div>
				</th>
				<th rowspan="2" class="text-center align-middle"> Aksi </th>
			</tr>
			<tr>
				<th class="text-center align-middle">
					<div style="width: 120px; margin:auto;">Target</div>
				</th>
				<th class="text-center align-middle">
					<div style="width: 130px; margin:auto;">Pagu</div>
				</th>
				<th class="text-center align-middle">
					<div style="width: 120px; margin:auto;">Target</div>
				</th>
				<th class="text-center align-middle">
					<div style="width: 130px; margin:auto;">Pagu</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$tahun = $_SESSION['tahun'];
			foreach ($rkpd_kegiatan_sub as $rom) : ?>
				<tr>
					<td></td>
					<td class="text-wrap align-top">
						<div style="padding-left: 40px;"><?= $rom['rkpd_indikator_kegiatan_sub']; ?></div>
					</td>
					<td><?= $rom['id_kegiatan']; ?> </td>
					<td><?= $rom['rkpd_kegiatan_n']; ?> </td>
					<td><?= $rom['id_sub_kegiatan']; ?></td>
					<td><?= $rom['rkpd_kegiatan_sub_n']; ?> </td>
					<td class="align-top text-wrap text-center"><?= $rom['t_tahun'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-wrap text-right"><?= number_format($rom['rp_tahun'], 0, ',', '.'); ?></td>
					<td class="align-top text-wrap text-center"><?= $rom['t_tahun+n'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-wrap text-right"><?= number_format($rom['rp_tahun+n'], 0, ',', '.'); ?></td>
					<td class="align-top text-wrap text-center"><?= $rom['lokasi']; ?></td>
					<td class="align-top text-wrap text-center"><?= $rom['sumber_dana']; ?></td>
					<td style="text-align: center;">
						<?php if (menu('renja')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/rkpd/opd_kegiatan_sub/opd_kegiatan_sub_indik_edit/' . $rom['id_rkpd_kegiatan_sub']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/rkpd/opd_kegiatan_sub/opd_kegiatan_sub_indik_hapus/' . $rom['id_rkpd_kegiatan_sub']; ?>'}" href="#">
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
	/* 	jQuery('#example1 thead th').css('background-color', 'rgb(204 208 211)'); */

	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": false,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				targets: [2, 3, 4, 5]
			}],
			order: [
				[2, 'asc'],
				[4, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(2)[0] == group) {
						var Pagu2021 = rows
							.data()
							.pluck(7)
							.reduce(function(a, b) {
								return a + b.replace(/[^\d]/g, '') * 1;
							}, 0);
						var Pagu2022 = rows
							.data()
							.pluck(9)
							.reduce(function(a, b) {
								return a + b.replace(/[^\d]/g, '') * 1;
							}, 0);

						Pagu2021 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2021);
						Pagu2022 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2022);
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + Pagu2021 + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + Pagu2022 + '</td>')
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
							.append('<td></td>')
							.append('<td></td>');
					}
				},
				dataSrc: [2, 4]
			}
		});
	});
</script>

<?= $this->endSection(); ?>