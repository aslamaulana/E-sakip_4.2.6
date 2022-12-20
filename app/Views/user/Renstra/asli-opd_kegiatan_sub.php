<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
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
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th rowspan="2" class="text-center">No</th>
				<th rowspan="2">Kegiatan / Sub Kegiatan / Sub Kegiatan Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th rowspan="2" class="text-center">Aksi</th>
			</tr>
			<tr>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center align-middle">Target</th>
					<th class="text-center align-middle">Pagu</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>No</th>
				<th>
					<div style="width: 1000px;"> Kegiatan / Sub Kegiatan / Sub Kegiatan Indikator</div>
				</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center">
						<div style="width: 120px;"><?= $row['tahun']; ?></div>
					</th>
					<th class="text-center">
						<div style="width: 120px;">Pagu <?= $row['tahun']; ?></div>
					</th>
				<?php endforeach; ?>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_kegiatan as $row) : ?>
				<tr class="font-weight-bold" style="background-color: blanchedalmond;">
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="text-wrap align-top">[KEGIATAN] <?= $row['opd_kegiatan_n']; ?></td>
					<td></td>
					<td class="text-right">
						<?php $pagu1 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2021')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu1['rp_2021'], 2, ',', '.');
						?>
					</td>
					<td></td>
					<td class="text-right">
						<?php $pagu2 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2022')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu2['rp_2022'], 2, ',', '.');
						?>
					</td>
					<td></td>
					<td class="text-right">
						<?php $pagu3 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2023')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu3['rp_2023'], 2, ',', '.');
						?>
					</td>
					<td></td>
					<td class="text-right">
						<?php $pagu4 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2024')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu4['rp_2024'], 2, ',', '.');
						?>
					</td>
					<td></td>
					<td class="text-right">
						<?php $pagu5 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2025')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu5['rp_2025'], 2, ',', '.');
						?>
					</td>
					<td></td>
					<td class="text-right">
						<?php $pagu6 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2026')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
						echo number_format($pagu6['rp_2026'], 2, ',', '.');
						?>
					</td>
					<td></td>
				</tr>
				<?php
				// $query = $db->table('tb_renstra_kegiatan_sub')
				// 	->select('tb_renstra_kegiatan_sub.opd_kegiatan_sub_n, tb_renstra_kegiatan_sub.opd_kegiatan_n,  tb_renstra_kegiatan_sub.opd_id')
				// 	->distinct('tb_renstra_kegiatan_sub.opd_kegiatan_sub_n, tb_renstra_kegiatan_sub.opd_kegiatan_n,  tb_renstra_kegiatan_sub.opd_id')
				// 	->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getResultArray();

				$query = $db->table('tb_renstra_kegiatan_sub')
					->select('tb_renstra_kegiatan_sub.opd_kegiatan_sub_n, tb_renstra_kegiatan_sub.opd_kegiatan_n, set_sub_kegiatan_90.id_sub_kegiatan')
					->distinct('tb_renstra_kegiatan_sub.opd_kegiatan_sub_n, tb_renstra_kegiatan_sub.opd_kegiatan_n, set_sub_kegiatan_90.id_sub_kegiatan')
					->join('set_kegiatan_90', 'tb_renstra_kegiatan_sub.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
					->join('set_sub_kegiatan_90', 'tb_renstra_kegiatan_sub.opd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan AND set_kegiatan_90.id_kegiatan = set_sub_kegiatan_90.kegiatan_id', 'left')
					->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $row['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getResultArray();

				foreach ($query as $ros) : ?>
					<tr>
						<td></td>
						<td class="text-wrap align-top">[<?= $ros['id_sub_kegiatan']; ?>] <?= '<a href="/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_indik_add?p=' . $ros['opd_kegiatan_sub_n'] . '&a=' . $ros['opd_kegiatan_n'] . '" title="Tambah Indikator Sub Kegiatan">' . $ros['opd_kegiatan_sub_n'] . '</a>'; ?></td>
						<?php foreach ($tahunA as $th) : ?>
							<td></td>
							<td></td>
						<?php endforeach; ?>
						<td style="text-align: center;">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_kegiatan_sub/opd_kegiatan_sub_edit?p=' . $ros['opd_kegiatan_sub_n'] . '&a=' . $ros['opd_kegiatan_n']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
							<?php } else { ?>
								<a class="btn btn-danger btn-circle btn-xs">
									<i class="nav-icon fas fa-lock"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
					<?php $querz = $db->table('tb_renstra_kegiatan_sub')->getWhere(['opd_kegiatan_sub_n' => $ros['opd_kegiatan_sub_n'], 'opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'opd_id' => user()->opd_id])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td></td>
							<td class="text-wrap align-top">
								<div style="padding-left: 40px;"><?= $rom['opd_indikator_kegiatan_sub']; ?></div>
							</td>
							<td class="align-top text-wrap text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-wrap text-right"><?= number_format($rom['rp_2021'], 2, ',', '.'); ?></td>
							<td class="align-top text-wrap text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-wrap text-right"><?= number_format($rom['rp_2022'], 2, ',', '.'); ?></td>
							<td class="align-top text-wrap text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-wrap text-right"><?= number_format($rom['rp_2023'], 2, ',', '.'); ?></td>
							<td class="align-top text-wrap text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-wrap text-right"><?= number_format($rom['rp_2024'], 2, ',', '.'); ?></td>
							<td class="align-top text-wrap text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-wrap text-right"><?= number_format($rom['rp_2025'], 2, ',', '.'); ?></td>
							<td class="align-top text-wrap text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-wrap text-right"><?= number_format($rom['rp_2026'], 2, ',', '.'); ?></td>
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
						</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
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
			]
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?= $this->endSection(); ?>