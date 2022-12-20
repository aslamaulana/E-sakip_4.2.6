<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col-md">
			<select class="form-control" onchange="location = this.value;">
				<?php foreach ($opd as $row) : ?>
					<option <?= $_SESSION['opd_set'] == $row['id'] ? 'selected' : ''; ?> value="<?= base_url('/admin/renstra/opd_sasaran/opd/' . $row['id']); ?>"><?= $row['description']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div><br>
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th class="text-center">
					<div style="width: 80px;">Kode</div>
				</th>
				<th>
					<div style="width: 550px;">Sasaran Pemda / Sasaran / Sasaran Indikator</div>
				</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>
					<div style="width: 350px;">Tujuan OPD</div>
				</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($sasaran as $rom) : ?>
				<tr>
					<td></td>
					<td>
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_sasaran']; ?></div>
					</td>
					<td><?= $rom['kode_sasaran']; ?></td>
					<td>[SASARAN RPJMD] <?= $rom['rpjmd_sasaran_n']; ?></td>
					<td><?= $rom['opd_kode_sasaran']; ?></td>
					<td>
						<div style="padding-left: 20px;">[SASARAN] <?= $rom['opd_sasaran']; ?></div>
					</td>
					<td class="align-top  text-wrap"><?= '[' . $rom['opd_kode_tujuan'] . '] ' . $rom['opd_tujuan_n']; ?> </td>
					<td></td>
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
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
				targets: [2, 3, 4, 5, 6]
			}],
			order: [
				[3, 'asc'],
				[5, 'asc']
			],
			rowGroup: {

				startRender: function(rows, group) {

					if (rows.data().pluck(3)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td>' + rows.data().pluck(2)[0] + '</td>')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(5)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + rows.data().pluck(4)[0] + '</td>')
							.append('<td class="align-top text-wrap">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(6)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					}
				},
				dataSrc: [3, 5]
			}
		});
	});
</script>
<?= $this->endSection(); ?>