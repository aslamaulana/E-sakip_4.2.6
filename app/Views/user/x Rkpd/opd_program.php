<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renja')->kunci == 'tidak') { ?>
	<div>
		<a href="<?= base_url('/user/rkpd/opd_program/import'); ?>">
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
					<div style="width: 60px; margin:auto;">Kode</div>
				</th>
				<th rowspan="2" class="align-middle">
					<div style="width: 890px;">Program / Program Indikator</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th colspan="2" class="text-center align-middle"><?= $_SESSION['tahun']; ?></th>
				<th rowspan="2"></th>
				<th colspan="2" class="text-center align-middle"><?= $_SESSION['tahun'] + 1; ?></th>
				<th rowspan="2"></th>
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
			$nomor = 1;
			$tahun = $_SESSION['tahun'];
			foreach ($rkpd_program as $rom) : ?>
				<tr>
					<td></td>
					<td class="text-wrap align-top">
						<div style="padding-left: 40px;"><?= $rom['rkpd_indikator_program']; ?></div>
					</td>
					<td><?= $rom['id_program']; ?></td>
					<td><?= $rom['rkpd_program_n']; ?> </td>

					<td class="align-top text-wrap text-center"><?= $rom['t_tahun'] . ' ' . $rom['satuan']; ?></td>
					<td><?= $rom['rp_tahun']; ?></td>
					<td>
						<?php $pagu0 = $db->table('vw_pagu_rkpd_program')->selectsum('rp_tahun')->getWhere(['vw_pagu_rkpd_program.rkpd_program_n' => $rom['rkpd_program_n'], 'vw_pagu_rkpd_program.perubahan' => $_SESSION['perubahan'], 'vw_pagu_rkpd_program.opd_id' => user()->opd_id, 'vw_pagu_rkpd_program.tahun' => $_SESSION['tahun']])->getRowArray();
						echo !empty($pagu0['rp_tahun']) ? number_format($pagu0['rp_tahun'], 2, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-wrap text-center"><?= $rom['t_tahun+n'] . ' ' . $rom['satuan']; ?></td>
					<td><?= $rom['rp_tahun+n']; ?></td>
					<td>
						<?php $pagu01 = $db->table('vw_pagun_rkpd_program')->selectsum('rp_tahun+n')->getWhere(['vw_pagun_rkpd_program.rkpd_program_n' => $rom['rkpd_program_n'], 'vw_pagun_rkpd_program.perubahan' => $_SESSION['perubahan'], 'vw_pagun_rkpd_program.opd_id' => user()->opd_id, 'vw_pagun_rkpd_program.tahun' => $_SESSION['tahun']])->getRowArray();
						echo !empty($pagu01['rp_tahun+n']) ? number_format($pagu01['rp_tahun+n'], 2, ',', '.') : '0';
						?>
					</td>
					<td style="text-align: center;">
						<?php if (menu('renja')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/rkpd/opd_program/opd_program_indik_edit/' . $rom['id_rkpd_program']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/rkpd/opd_program/opd_program_indik_hapus/' . $rom['id_rkpd_program']; ?>'}" href="#">
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
				// targets: [1, 2, 3, 27]
				targets: [2, 3, 6, 9]
			}],
			order: [
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(6)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(9)[0] + '</td>')
							.append('<td></td>');
					}
				},
				dataSrc: [2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>