<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<style>
	.c1 {
		width: 60px;
		text-align: center;
	}

	.c2 {
		width: 800px;
	}

	.c2a {
		width: 400px;
	}

	.c2b {
		width: 400px;
	}

	.c3 {
		width: 80px;
		text-align: center;
	}

	.c4 {
		width: 60px;
		text-align: center;
	}
</style>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/user/renstra/opd_sasaran/opd_sasaran_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered table-responsive" style="height: 69vh;">
		<thead>
			<tr class="d-flex">
				<th class="c1">No</th>
				<th class="c2">Tujuan / Sasaran / Sasaran Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="c3"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="c4">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr class="d-flex">
				<th class="c1">No</th>
				<th class="c2">Tujuan / Sasaran / Sasaran Indikator</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="c3"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="c4">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_tujuan as $row) : ?>
				<tr class="d-flex" style="background-color: blanchedalmond;">
					<td class="c1"><?= $nomor++; ?></td>
					<td class="c2"><b>[TUJUAN] <?= $row['sasaran']; ?></b></td>
					<?php foreach ($tahunA as $th) : ?>
						<td class="c3"></td>
					<?php endforeach; ?>
					<td class="c4"></td>
				</tr>
				<?php $query = $db->table('tb_opd_sasaran')->getWhere(['opd_tujuan_id' => $row['id_opd_tujuan'], 'opd_id' => user()->opd_id])->getResultArray();
				foreach ($query as $ros) : ?>
					<tr class="d-flex">
						<td class="c1"></td>
						<td class="c2">
							<div style="padding-left:20px;">[SASARAN] <?= '<a href="/user/renstra/opd_sasaran/opd_sasaran_indik_add/' . $ros['id_opd_sasaran'] . '/' . $ros['opd_sasaran'] . '" title="Add Indikator sasaran">' . $ros['opd_sasaran'] . '</a>'; ?></div>
						</td>
						<?php foreach ($tahunA as $th) : ?>
							<td class="c3"></td>
						<?php endforeach; ?>
						<td class="c4">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_edit/' . $ros['id_opd_sasaran']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_hapus/' . $ros['id_opd_sasaran']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
					<?php $querz = $db->table('tb_opd_sasaran_indikator')->getWhere(['opd_sasaran_id' => $ros['id_opd_sasaran']])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr class="d-flex">
							<td class="c1"></td>
							<td class="c2">
								<div style="padding-left:40px;"><?= $rom['opd_sasaran_indikator']; ?></div>
							</td>
							<?php $querl = $db->table('vw_opd_sasaran_indik')->getWhere(['opd_sasaran_indik_id' => $rom['id_opd_sasaran_indik']])->getResultArray();
							foreach ($querl as $roy) : ?>
								<td class="c3"><?= $roy['target'] . ' ' . $roy['satuan']; ?></td>
							<?php endforeach; ?>
							<td class="c4">
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_indik_edit/' . $rom['id_opd_sasaran_indik']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_indik_hapus/' . $rom['id_opd_sasaran_indik']; ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
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
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
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