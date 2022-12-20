<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_sasaran/opd_sasaran_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/renstra/opd_sasaran/import'); ?>">
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
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th class="text-center">
					<div style="width: 80px;">Kode</div>
				</th>
				<th>
					<div style="width: 550px;">Sasaran Pemda / Sasaran / Sasaran Indikator</div>
				</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>
					<div style="width: 350px;">Tujuan OPD</div>
				</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($sasaran as $rom) : ?>
				<tr>
					<td></td>
					<td>
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_sasaran']; ?></div>
					</td>
					<td><?= $rom['kode_sasaran']; ?></td>
					<td>[SASARAN RPJMD] <?= $rom['rpjmd_sasaran_n']; ?></td>
					<td><?= $rom['opd_kode_sasaran']; ?></td>
					<td>
						<div style="padding-left: 20px;">[SASARAN] <?= '<a href="/user/renstra/opd_sasaran/opd_sasaran_indik_add?p=' . $rom['opd_sasaran'] . '&k=' . $rom['opd_kode_sasaran'] . '&m=' . $rom['opd_tujuan_n'] . '&r=' . $rom['rpjmd_sasaran_n'] . '" title="Tambah Indikator Sasaran">' . $rom['opd_sasaran'] . '</a>'; ?></div>
					</td>
					<td class="align-top  text-wrap"><?= '[' . $rom['opd_kode_tujuan'] . '] ' . $rom['opd_tujuan_n']; ?> </td>
					<td></td>
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td class="text-center align-top">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_indik_edit/' . $rom['id_opd_sasaran']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_indik_hapus/' . $rom['id_opd_sasaran']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
					</td>
					<td class="text-center align-top">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" title="Ubah sasaran" href="<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_edit?p=' . $rom['opd_sasaran'] . '&k=' . $rom['opd_kode_sasaran'] . '&m=' . $rom['opd_tujuan_n'] . '&o=' . user()->opd_id . '&rs=' . $rom['rpjmd_sasaran_n']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
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
				targets: [2, 3, 4, 5, 6, 15]
			}],
			order: [
				[3, 'asc'],
				[5, 'asc']
			],
			rowGroup: {

				startRender: function(rows, group) {

					if (rows.data().pluck(3)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td>' + rows.data().pluck(2)[0] + '</td>')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(5)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + rows.data().pluck(4)[0] + '</td>')
							.append('<td class="align-top text-wrap">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(6)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(15)[0] + '</td>');
					}
				},
				dataSrc: [3, 5]
			}
		});
	});
</script>
<?= $this->endSection(); ?>