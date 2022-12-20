<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-hover table-sm">
		<thead>
			<tr>
				<th class="text-center" width="30px">No</th>
				<th> Kegiatan / Sub Kegiatan </th>
				<th class="text-center">Pagu 2022</th>
				<th style="width:300px;"> Lokasi </th>
				<th> Sumber Dana </th>
				<th class="text-center">
					<div style="width:100px; margin:auto;">Aksi</div>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">No</th>
				<th>Kegiatan / Sub Kegiatan</th>
				<th class="text-center">Pagu 2022</th>
				<th> Lokasi </th>
				<th> Sumber Dana </th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php
			$nomor = 1;
			foreach ($rkpd_kegiatan as $rol) : ?>
				<tr class="font-weight-bold" style="background-color: blanchedalmond;">
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="text-wrap align-top"><?= $rol['rkpd_kegiatan_n']; ?> </td>
					<td style="text-align: center;"> </td>
					<td style="text-align: center;"> </td>
					<td style="text-align: center;"> </td>
					<td style="text-align: center;"> </td>
				</tr>
				<?php $query = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
					->join('set_kegiatan_90', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
					->join('set_sub_kegiatan_90', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan AND set_kegiatan_90.id_kegiatan = set_sub_kegiatan_90.kegiatan_id', 'left')
					->getWhere([
						'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n' => $rol['rkpd_kegiatan_n'],
						'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id,
						'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun'],
						'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan']
					])->getResultArray();
				foreach ($query as $ros) : ?>
					<tr data-toggle="collapse" id="<?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" data-target=".<?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" class="clickable">
						<td class="align-top"><?= $ros['id_sub_kegiatan']; ?></td>
						<td class="text-wrap align-top"><i class="glyphicon glyphicon-plus nav-icon fas fa-plus"></i> <?= $ros['rkpd_kegiatan_sub_n']; ?> </td>
						<td class="text-right align-top">
							<?php $pagu = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')->selectsum('rp_tahun')->getWhere(['tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n' => $rol['rkpd_kegiatan_n'], 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n' => $ros['rkpd_kegiatan_sub_n'], 'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id, 'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']])->getRowArray(); ?>
							<?= number_format($pagu['rp_tahun'], 2, ',', '.'); ?>
						</td>
						<td class="align-top text-wrap"><?= $ros['lokasi']; ?></td>
						<td class="align-top"><?= $ros['sumber_dana']; ?></td>
						<td style="text-align: center;">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ropk/ropk_fisik/fisik/' . $ros['id_ropk_keuangan_rkpd_kegiatan_sub']; ?>">
								<i class="nav-icon fas fa-chart-bar"> Rencana</i>
							</a>
						</td>
					</tr>
					<?php

					$qu = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
						->select('tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n,	tb_renstra_kegiatan.opd_kegiatan_n,	tb_renstra_program.opd_program_n, tb_renstra_sasaran.opd_sasaran,tb_renstra_sasaran.rpjmd_sasaran_n,tb_rpjmd_tujuan.tujuan,	tb_misi.misi,	tb_misi.visi')
						->distinct('tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n,tb_renstra_kegiatan.opd_kegiatan_n,tb_renstra_program.opd_program_n,tb_renstra_sasaran.opd_sasaran,tb_renstra_sasaran.rpjmd_sasaran_n,	tb_rpjmd_tujuan.tujuan,	tb_misi.misi,	tb_misi.visi')
						->join('tb_renstra_kegiatan', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n = tb_renstra_kegiatan.opd_kegiatan_n AND tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id = tb_renstra_kegiatan.opd_id', 'left')
						->join('tb_renstra_program', 'tb_renstra_kegiatan.opd_id = tb_renstra_program.opd_id AND tb_renstra_kegiatan.opd_program_n = tb_renstra_program.opd_program_n', 'left')
						->join('tb_renstra_sasaran', 'tb_renstra_program.opd_id = tb_renstra_sasaran.opd_id AND	tb_renstra_program.opd_sasaran_n = tb_renstra_sasaran.opd_sasaran', 'left')
						->join('tb_rpjmd_sasaran', 'tb_renstra_sasaran.rpjmd_sasaran_n = tb_rpjmd_sasaran.sasaran', 'left')
						->join('tb_rpjmd_tujuan', 'tb_rpjmd_sasaran.tujuan_n = tb_rpjmd_tujuan.tujuan', 'left')
						->join('tb_misi', 'tb_rpjmd_tujuan.misi_n = tb_misi.misi', 'left')
						->getWhere(['tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n' => $rol['rkpd_kegiatan_n'], 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n' => $ros['rkpd_kegiatan_sub_n'], 'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id, 'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']])->getResultArray();

					foreach ($qu as $child) : ?>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">1.</td>
							<td colspan="3">
								<?= $child['visi']; ?>
							</td>
							<td colspan="2">1. Visi</td>
						</tr>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">2.</td>
							<td colspan="3">
								<div style="padding-left:20px;"><?= $child['misi']; ?></div>
							</td>

							<td colspan="2">2. Misi</td>
						</tr>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">3.</td>
							<td colspan="3">
								<div style="padding-left:40px;"><?= $child['tujuan']; ?></div>
							</td>
							<td colspan="2">3. Tujuan RPJMD</td>
						</tr>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">4.</td>
							<td colspan="3">
								<div style="padding-left:60px;"><?= $child['rpjmd_sasaran_n']; ?></div>
							</td>

							<td colspan="2">4. Sasaran RPJMD</td>
						</tr>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">5.</td>
							<td colspan="3">
								<div style="padding-left:80px;"><?= $child['opd_sasaran']; ?></div>
							</td>
							<td colspan="2">5. Sasaran Renstra</td>
						</tr>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">6.</td>
							<td colspan="3">
								<div style="padding-left:100px;"><?= $child['opd_program_n']; ?></div>
							</td>

							<td colspan="2">6. Program</td>
						</tr>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">7.</td>
							<td colspan="3">
								<div style="padding-left:120px;"><?= $child['opd_kegiatan_n']; ?></div>
							</td>
							<td colspan="2">7. Kegiatan</td>
						</tr>
						<tr class="collapse <?= 'row-' . str_replace('.', '', $ros['id_sub_kegiatan']); ?>" style="background-color:azure;">
							<td class="text-center">8.</td>
							<td colspan="3">
								<div style="padding-left:140px;"><?= $child['rkpd_kegiatan_sub_n']; ?></div>
							</td>
							<td colspan="2">8. Sub Kegiatan</td>
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
			"paging": false,
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