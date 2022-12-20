<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col-md">
			<select class="form-control" onchange="location = this.value;">
				<?php foreach ($opd as $row) : ?>
					<option <?= $_SESSION['opd_set'] == $row['id'] ? 'selected' : ''; ?> value="<?= base_url('/admin/renstra/opd_tujuan/opd/' . $row['id']); ?>"><?= $row['description']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div><br>
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
			</tr>
		</thead>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_tujuan as $ros) : ?>
				<!-- Tujuan -->
				<tr style="background: azure;">
					<td class="align-top text-center"><?= $ros['opd_kode_tujuan']; ?></td>
					<td class="align-top" style="padding-left: 20px;">[TUJUAN] <?= $ros['opd_tujuan']; ?></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
					<?php endforeach; ?>
				</tr>
				<?php $querz = $db->table('tb_renstra_tujuan')->getWhere(['opd_tujuan' => $ros['opd_tujuan'], 'opd_kode_tujuan' => $ros['opd_kode_tujuan'], 'opd_id' => $_SESSION['opd_set'], 'perubahan' => $_SESSION['perubahan']])->getResultArray();
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