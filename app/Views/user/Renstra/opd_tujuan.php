<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_tujuan/opd_tujuan_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<?php if ($_SESSION['perubahan'] == 'Perubahan') { ?>
		<div>
			<a onclick="if(confirm('Import langsung dari RENSTRA murni??')){location.href='<?= base_url() . '/user/renstra/opd_tujuan/import_tujuan'; ?>'}" href="#">
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
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>Tujuan / Tujuan Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center">
						<div style="width: 120px; margin:auto;"><?= $row['tahun']; ?></div>
					</th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_tujuan as $ros) : ?>
				<!-- Tujuan -->
				<tr style="background: azure;">
					<td class="align-top text-center"><?= $ros['opd_kode_tujuan']; ?></td>
					<td class="align-top" style="padding-left: 20px;">[TUJUAN] <?= '<a href="/user/renstra/opd_tujuan/opd_tujuan_indik_add?p=' . $ros['opd_tujuan'] . '&k=' . $ros['opd_kode_tujuan'] . '" title="Add Indikator Tujuan">' . $ros['opd_tujuan'] . '</a>'; ?></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
					<?php endforeach; ?>
					<td class="text-center align-top">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_tujuan/opd_tujuan_edit?p=' . $ros['opd_tujuan'] . '&k=' . $ros['opd_kode_tujuan']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
					</td>
				</tr>
				<?php $querz = $db->table('tb_renstra_tujuan')->getWhere(['opd_tujuan' => $ros['opd_tujuan'], 'opd_kode_tujuan' => $ros['opd_kode_tujuan'], 'opd_id' => user()->opd_id, 'perubahan' => $_SESSION['perubahan']])->getResultArray();
				foreach ($querz as $rom) : ?>
					<tr>
						<td></td>
						<td class="align-top" style=" padding-left: 40px;"><?= $rom['opd_indikator_tujuan']; ?></td>
						<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
						<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
						<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
						<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
						<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
						<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
						<td class="text-center align-top">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_tujuan/opd_tujuan_indik_edit/' . $rom['id_opd_tujuan']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_tujuan/opd_tujuan_hapus/' . $rom['id_opd_tujuan']; ?>'}" href="#">
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
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"paging": false,
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