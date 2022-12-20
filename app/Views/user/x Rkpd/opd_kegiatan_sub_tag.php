<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php

use CodeIgniter\Format\JSONFormatter;

if (menu('renja')->kunci == 'tidak') { ?>
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
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 120px; margin:auto;">Tag</div>
				</th>
				<th colspan="2" class="text-center align-middle"><?= $_SESSION['tahun']; ?></th>
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
			</tr>
		</thead>
		<tbody>
			<?php
			$nomor = 1;
			foreach ($rkpd_kegiatan as $rol) : ?>
				<tr class="font-weight-bold" style="background-color: blanchedalmond;">
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="text-wrap align-top"><?= $rol['rkpd_kegiatan_n']; ?> </td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$query = $db->table('tb_rkpd_kegiatan_sub')
					->select('tb_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n, set_sub_kegiatan_90.id_sub_kegiatan')
					->distinct('tb_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n, set_sub_kegiatan_90.id_sub_kegiatan')
					->join('set_kegiatan_90', 'tb_rkpd_kegiatan_sub.rkpd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
					->join('set_sub_kegiatan_90', 'tb_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan AND set_kegiatan_90.id_kegiatan = set_sub_kegiatan_90.kegiatan_id', 'left')
					->getWhere(['tb_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_rkpd_kegiatan_sub.rkpd_kegiatan_n' => $rol['rkpd_kegiatan_n'], 'tb_rkpd_kegiatan_sub.opd_id' => user()->opd_id, 'tb_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']])->getResultArray();
				foreach ($query as $ros) : ?>
					<tr class="font-weight-bold" style="background: azure;">
						<td><?= $ros['id_sub_kegiatan']; ?></td>
						<td class="text-wrap align-top"><?= $ros['rkpd_kegiatan_sub_n']; ?> </td>
						<td class="text-center">
							<?php
							$tag = $db->table('tb_rkpd_kegiatan_sub_tag')
								->select('tb_tag.tag, tb_tag.keterangan')
								->join('tb_tag', 'tb_rkpd_kegiatan_sub_tag.tag = tb_tag.tag', 'LEFT')
								->getWhere([
									'rkpd_kegiatan_sub_n' => $ros['rkpd_kegiatan_sub_n'],
									'tahun' => $_SESSION['tahun'],
									'perubahan' => $_SESSION['perubahan'],
									'opd_id' => user()->opd_id
								])->getResultArray();
							foreach ($tag as $tag) : ?>
								<?= '[<a href="#" title="' . $tag['keterangan'] . '">' . $tag['tag'] . '</a>]'; ?>
								<?php $tagA[$ros['id_sub_kegiatan']][] = $tag['tag']; ?>
							<?php endforeach; ?>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align: center;">
							<?php if (menu('renja')->kunci == 'tidak') { ?>
								<?php if (!empty($tagA[$ros['id_sub_kegiatan']])) { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/rkpd/opd_kegiatan_sub_tag/opd_kegiatan_sub_tag_edit?s=' . $ros['rkpd_kegiatan_sub_n']; ?>">
										<i class="nav-icon fas fa-tag"></i>
									</a>
								<?php } else { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/rkpd/opd_kegiatan_sub_tag/opd_kegiatan_sub_tag_add?s=' . $ros['rkpd_kegiatan_sub_n']; ?>">
										<i class="nav-icon fas fa-tag"></i>
									</a>
								<?php } ?>
							<?php } else { ?>
								<a class="btn btn-danger btn-circle btn-xs">
									<i class="nav-icon fas fa-lock"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
					<?php
					$querz = $db->table('tb_rkpd_kegiatan_sub')->getWhere(['perubahan' => $_SESSION['perubahan'], 'rkpd_kegiatan_sub_n' => $ros['rkpd_kegiatan_sub_n'], 'tahun' => $_SESSION['tahun'], 'opd_id' => user()->opd_id])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td></td>
							<td class="text-wrap align-top">
								<div style="padding-left: 40px;"><?= $rom['rkpd_indikator_kegiatan_sub']; ?></div>
							</td>
							<td></td>
							<td class="align-top text-wrap text-center"><?= $rom['t_tahun'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-wrap text-right"><?= number_format($rom['rp_tahun'], 2, ',', '.'); ?></td>
							<td class="align-top text-wrap text-center"><?= $rom['lokasi']; ?></td>
							<td class="align-top text-wrap text-center"><?= $rom['sumber_dana']; ?></td>
							<td></td>
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
			"info": false,
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