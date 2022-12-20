<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/renstra/opd_kegiatan_sub/import'); ?>">
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
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 130px;">Kode</div>
				</th>
				<th rowspan="2" class="align-middle">
					<div style="width: 800px;">Kegiatan / Sub Kegiatan / Sub Kegiatan Indikator</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th rowspan="2" class="text-center align-middle">Aksi</th>
				<th rowspan="2" class="text-center">Aksi Sub</th>
			</tr>
			<tr>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center align-middle">
						<div style="width: 150px;">Target</div>
					</th>
					<th class="text-center align-middle">
						<div style="width: 150px;">Pagu</div>
					</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th rowspan="2" colspan="2" class="text-center align-middle">
					Total Pagu Anggaran Prangkat Daerah
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th rowspan="2" class="text-center align-middle">Aksi</th>
				<th rowspan="2" class="text-center">Aksi Sub</th>
			</tr>
			<tr>
				<th colspan="2" class="text-center align-middle">
					<?php
					$pagu1 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2021')->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
					echo isset($pagu1['rp_2021']) ? number_format($pagu1['rp_2021'], 0, ',', '.') : '0';
					?>
				</th>
				<th colspan="2" class="text-center align-middle">
					<?php
					$pagu2 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2022')->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
					echo isset($pagu2['rp_2022']) ? number_format($pagu2['rp_2022'], 0, ',', '.') : '0';
					?>
				</th>
				<th colspan="2" class="text-center align-middle">
					<?php
					$pagu3 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2023')->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
					echo isset($pagu3['rp_2023']) ? number_format($pagu3['rp_2023'], 0, ',', '.') : '0';
					?>
				</th>
				<th colspan="2" class="text-center align-middle">
					<?php
					$pagu4 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2024')->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
					echo isset($pagu4['rp_2024']) ? number_format($pagu4['rp_2024'], 0, ',', '.') : '0';
					?>
				</th>
				<th colspan="2" class="text-center align-middle">
					<?php
					$pagu5 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2025')->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
					echo isset($pagu5['rp_2025']) ? number_format($pagu5['rp_2025'], 0, ',', '.') : '0';
					?>
				</th>
				<th colspan="2" class="text-center align-middle">
					<?php
					$pagu6 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2026')->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
					echo isset($pagu6['rp_2026']) ? number_format($pagu6['rp_2026'], 0, ',', '.') : '0';
					?>
				</th>
			</tr>
		</tfoot>

		<tbody>
			<?php
			$no = 1;
			foreach ($opd_kegiatan_sub as $rom) : ?>
				<tr>
					<td></td>
					<td class="text-wrap align-top">
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_kegiatan_sub']; ?></div>
					</td>
					<td>[<?= $rom['id_kegiatan']; ?>]</td>
					<td>[KEGIATAN] <?= $rom['opd_kegiatan_n']; ?></td>
					<td>[<?= $rom['id_sub_kegiatan']; ?>]</td>
					<td class="text-wrap align-top"><?= '<a href="/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_indik_add?p=' . $rom['opd_kegiatan_sub_n'] . '&a=' . $rom['opd_kegiatan_n'] . '" title="Tambah Indikator Sub Kegiatan">' . $rom['opd_kegiatan_sub_n'] . '</a>'; ?></td>
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2021'], 0, '.', ','); ?></td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2022'], 0, '.', ','); ?></td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2023'], 0, '.', ','); ?></td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2024'], 0, '.', ','); ?></td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2025'], 0, '.', ','); ?></td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2026'], 0, '.', ','); ?></td>
					<td style="text-align: center;">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_indik_edit/' . $rom['id_opd_kegiatan_sub']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_indik_hapus/' . $rom['id_opd_kegiatan_sub']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
					</td>
					<td style="text-align: center;">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_edit?p=' . $rom['opd_kegiatan_sub_n'] . '&a=' . $rom['opd_kegiatan_n']; ?>">
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

	var groupColumn = 2;
	var groupColumn2 = 3;

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
				targets: [2, 3, 4, 5, 19]
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
						var Pagu2023 = rows
							.data()
							.pluck(11)
							.reduce(function(a, b) {
								return a + b.replace(/[^\d]/g, '') * 1;
							}, 0);
						var Pagu2024 = rows
							.data()
							.pluck(13)
							.reduce(function(a, b) {
								return a + b.replace(/[^\d]/g, '') * 1;
							}, 0);
						var Pagu2025 = rows
							.data()
							.pluck(15)
							.reduce(function(a, b) {
								return a + b.replace(/[^\d]/g, '') * 1;
							}, 0);
						var Pagu2026 = rows
							.data()
							.pluck(17)
							.reduce(function(a, b) {
								return a + b.replace(/[^\d]/g, '') * 1;
							}, 0);
						Pagu2021 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2021);
						Pagu2022 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2022);
						Pagu2023 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2023);
						Pagu2024 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2024);
						Pagu2025 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2025);
						Pagu2026 = $.fn.dataTable.render.number('.', ',', 0, '').display(Pagu2026);

						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td>' + group + '</td>')
							.append('<td class="text-wrap">' + rows.data().pluck(3)[0] + ' </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right">' + Pagu2021 + ' </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right">' + Pagu2022 + ' </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right">' + Pagu2023 + ' </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right">' + Pagu2024 + ' </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right">' + Pagu2025 + ' </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right">' + Pagu2026 + ' </td>')
							.append('<td> </td>');
					} else if (rows.data().pluck(4)[0] == group) {
						return $('<tr style="background: azure;" />')
							.append('<td>' + group + '</td>')
							.append('<td class="text-wrap">' + rows.data().pluck(5)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td> </td>')
							.append('<td style="text-align: center">' + rows.data().pluck(19)[0] + '</td>');
					}
				},
				dataSrc: [2, 4]
			}
		});
	});

	// ------------------------------------
</script>

<?= $this->endSection(); ?>