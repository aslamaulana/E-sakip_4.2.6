<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered table-sm">
		<tr>
			<td><b>[KOMPONEN]</b> <?= $komponen['komponen']; ?></td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:40px;">
					<b>[SUB KOMPONEN]</b> <?= $komponen['komponen_sub']; ?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:60px;">
					<b>[KRITERIA]</b> <?= $komponen['kriteria']; ?>
				</div>
			</td>
		</tr>
	</table><br><br>
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th class="text-center">
					<div style="width: 60px;">NO</div>
				</th>
				<th class="text-center">
					<div style="width: 500px;">Jawaban</div>
				</th>
				<th class="text-center">
					<div style="width: 80px;">Nilai</div>
				</th>
				<th class="text-center">
					<div style="width: 450px;">Catatan</div>
				</th>
				<th class="text-center">
					<div style="width: 130px;">Daftar Evidence</div>
				</th>
				<th class="text-center">
					<div style="width: 80px; margin:auto;">Log</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			foreach ($sakip as $rom) : ?>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td class="text-wrap"><?= $rom['jawaban']; ?></td>
					<td class="text-center"><?= $rom['nilai']; ?></td>
					<td><?= $rom['verifikasi_keterangan']; ?></td>
					<td class="text-wrap text-center">
						<?= isset($rom['link_1']) && $rom['link_1'] != '' ? '<a href="' . $rom['link_1'] . '" target="blink">Link 1</a> <i class="nav-icon fa fa-link"></i>' . '<br>' : ''; ?>
						<?= isset($rom['link_2']) && $rom['link_2'] != '' ? '<a href="' . $rom['link_2'] . '" target="blink">Link 2</a> <i class="nav-icon fa fa-link"></i>' . '<br>' : ''; ?>
						<?= isset($rom['link_3']) && $rom['link_3'] != '' ? '<a href="' . $rom['link_3'] . '" target="blink">Link 3</a> <i class="nav-icon fa fa-link"></i>' : ''; ?>
					</td>
					<td class="text-center"><?= $rom['created_at']; ?></td>
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
		});
	});
</script>
<?= $this->endSection(); ?>