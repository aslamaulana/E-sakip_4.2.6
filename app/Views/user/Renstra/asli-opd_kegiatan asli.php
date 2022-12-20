<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_kegiatan/opd_kegiatan_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/renstra/opd_kegiatan/import'); ?>">
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
				<th rowspan="2">Program / Kegiatan / Kegiatan Indikator</th>
				<th rowspan="2">Sasaran Kegiatan</th>
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
				<th class="text-center" width="30px">No</th>
				<th>
					<div style="width: 650px;">Program / Kegiatan / Kegiatan Indikator</div>
				</th>
				<th>
					<div style="width: 350px;">Sasaran Kegiatan</div>
				</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" style="width: 60px;"><?= $row['tahun']; ?></th>
					<th class="text-center" style="width: 60px;">Pagu <?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" style="width: 60px;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_program as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="font-weight-bold text-wrap">[PROGRAM] <?= $row['opd_program_n']; ?></td>
					<td></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
						<td></td>
					<?php endforeach; ?>
					<td></td>
				</tr>
				<!-- <?php //$query = $db->table('tb_renstra_kegiatan')
						//->distinct('tb_renstra_kegiatan.opd_kegiatan_sasaran_n, tb_renstra_kegiatan.opd_kegiatan_n')
						//->select('tb_renstra_kegiatan.opd_kegiatan_sasaran_n, tb_renstra_kegiatan.opd_kegiatan_n')
						//->getWhere(['tb_renstra_kegiatan.opd_program_n' => $row['opd_program_n'], 'tb_renstra_kegiatan.opd_id' => user()->opd_id])->getResultArray();
						//foreach ($query as $rol) : 
						?>
					<tr style="background: azure;">
						<td class="text-center"></td>
						<td class="font-weight-bold text-wrap">[SASARAN KEGIATAN] <? //= $rol['opd_kegiatan_sasaran_n']; 
																					?></td>
						<?php //foreach ($tahunA as $th) : 
						?>
							<td></td>
						<?php // endforeach; 
						?>
						<td></td>
					</tr> -->
				<?php $quer = $db->table('tb_renstra_kegiatan')
					->select('set_kegiatan_90.id_kegiatan, tb_renstra_kegiatan.opd_kegiatan_n, tb_renstra_kegiatan.opd_program_n,  tb_renstra_kegiatan.opd_id, tb_renstra_kegiatan.opd_kegiatan_sasaran_n')
					->distinct('set_kegiatan_90.id_kegiatan, tb_renstra_kegiatan.opd_kegiatan_n, tb_renstra_kegiatan.opd_program_n,  tb_renstra_kegiatan.opd_id, tb_renstra_kegiatan.opd_kegiatan_sasaran_n')
					->join('set_kegiatan_90', 'tb_renstra_kegiatan.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
					->getWhere(['tb_renstra_kegiatan.opd_program_n' => $row['opd_program_n'], 'tb_renstra_kegiatan.opd_id' => user()->opd_id])->getResultArray();
				foreach ($quer as $ros) : ?>
					<tr style="background: azure;">
						<td></td>
						<td class="text-wrap align-top">
							<div style="padding-left: 20px;" class="text-wrap">[<?= $ros['id_kegiatan']; ?>] <?= '<a href="/user/renstra/opd_kegiatan/opd_kegiatan_indik_add?p=' . $ros['opd_kegiatan_n'] . '&a=' . $ros['opd_program_n'] . '&m=' . $ros['opd_kegiatan_sasaran_n'] . '" title="Tambah Indikator Kegiatan">' . $ros['opd_kegiatan_n'] . '</a>'; ?></div>
						</td>
						<td class="text-wrap"><?= $ros['opd_kegiatan_sasaran_n']; ?></td>
						<td></td>
						<td class="text-right align-top">
							<?php $pagu1 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2021')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
							echo number_format($pagu1['rp_2021'], 2, ',', '.');
							?>
						</td>
						<td></td>
						<td class="text-right align-top">
							<?php $pagu2 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2022')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
							echo number_format($pagu2['rp_2022'], 2, ',', '.');
							?>
						</td>
						<td></td>
						<td class="text-right align-top">
							<?php $pagu3 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2023')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
							echo number_format($pagu3['rp_2023'], 2, ',', '.');
							?>
						</td>
						<td></td>
						<td class="text-right align-top">
							<?php $pagu4 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2024')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
							echo number_format($pagu4['rp_2024'], 2, ',', '.');
							?>
						</td>
						<td></td>
						<td class="text-right align-top">
							<?php $pagu5 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2025')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
							echo number_format($pagu5['rp_2025'], 2, ',', '.');
							?>
						</td>
						<td></td>
						<td class="text-right align-top">
							<?php $pagu6 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2026')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getRowArray();
							echo number_format($pagu6['rp_2026'], 2, ',', '.');
							?>
						</td>
						<td style="text-align: center;">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_kegiatan/opd_kegiatan_edit?p=' . $ros['opd_kegiatan_n'] . '&a=' . $ros['opd_program_n'] . '&m=' . $ros['opd_kegiatan_sasaran_n']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
							<?php } else { ?>
								<a class="btn btn-danger btn-circle btn-xs">
									<i class="nav-icon fas fa-lock"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
					<?php $querz = $db->table('tb_renstra_kegiatan')->getWhere(['opd_kegiatan_n' => $ros['opd_kegiatan_n'], 'opd_program_n' => $ros['opd_program_n'], 'opd_id' => user()->opd_id])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td></td>
							<td class="text-wrap">
								<div style="padding-left: 40px;" class="text-wrap"><?= $rom['opd_indikator_kegiatan']; ?></div>
							</td>
							<td></td>
							<td class="align-top"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
							<td></td>
							<td class="align-top"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
							<td></td>
							<td class="align-top"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
							<td></td>
							<td class="align-top"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
							<td></td>
							<td class="align-top"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
							<td></td>
							<td class="align-top"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
							<td></td>
							<td style="text-align: center;">
								<?php if (menu('renstra')->kunci == 'tidak') { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_kegiatan/opd_kegiatan_indik_edit/' . $rom['id_opd_kegiatan']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_kegiatan/opd_kegiatan_indik_hapus/' . $rom['id_opd_kegiatan']; ?>'}" href="#">
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
			],
			"columnsDefs": [{
				"width": "35%",
				"targets": 1
			}]
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