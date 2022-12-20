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
					<option <?= $_SESSION['opd_set'] == $row['id'] ? 'selected' : ''; ?> value="<?= base_url('/admin/renstra/opd_kegiatan/opd/' . $row['id']); ?>"><?= $row['description']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div><br>
	<table id="example1" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr>
				<th rowspan="2" class="align-middle">
					<div style="width: 120px;">Kode</div>
				</th>
				<th rowspan="2" class="align-middle">
					<div style="width: 700px;">Program / Kegiatan / Kegiatan Indikator</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2" class="align-middle">
					<div style="width: 350px;">Sasaran Kegiatan</div>
				</th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
					<th rowspan="2"></th>
				<?php endforeach; ?>
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

		<tbody>
			<?php $no = 1;
			foreach ($opd_kegiatan as $rom) : ?>
				<tr>
					<td></td>
					<td class="text-wrap">
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_kegiatan']; ?></div>
					</td>
					<td>[<?= $rom['id_program']; ?>]</td>
					<td>[PROGRAM] <?= $rom['opd_program_n']; ?></td>
					<td>[<?= $rom['id_kegiatan']; ?>]</td>
					<td><?= $rom['opd_kegiatan_n']; ?> </td>
					<td><?= $rom['opd_kegiatan_sasaran_n']; ?></td>
					<td></td>
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td>
						<?php $pagu1 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2021')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $rom['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => $_SESSION['opd_set']])->getRowArray();
						echo isset($pagu1['rp_2021']) ? number_format($pagu1['rp_2021'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td>
						<?php $pagu2 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2022')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $rom['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => $_SESSION['opd_set']])->getRowArray();
						echo isset($pagu2['rp_2022']) ? number_format($pagu2['rp_2022'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td>
						<?php $pagu3 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2023')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $rom['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => $_SESSION['opd_set']])->getRowArray();
						echo isset($pagu3['rp_2023']) ? number_format($pagu3['rp_2023'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td>
						<?php $pagu4 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2024')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $rom['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => $_SESSION['opd_set']])->getRowArray();
						echo isset($pagu4['rp_2024']) ? number_format($pagu4['rp_2024'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td>
						<?php $pagu5 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2025')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $rom['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => $_SESSION['opd_set']])->getRowArray();
						echo isset($pagu5['rp_2025']) ? number_format($pagu5['rp_2025'], 0, ',', '.') : '0';
						?>
					</td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td></td>
					<td>
						<?php $pagu6 = $db->table('tb_renstra_kegiatan_sub')->selectsum('rp_2026')->getWhere(['tb_renstra_kegiatan_sub.opd_kegiatan_n' => $rom['opd_kegiatan_n'], 'tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan_sub.opd_id' => $_SESSION['opd_set']])->getRowArray();
						echo isset($pagu6['rp_2026']) ? number_format($pagu6['rp_2026'], 0, ',', '.') : '0';
						?>
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
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				targets: [2, 3, 4, 5, 6, 10, 13, 16, 19, 22, 25]
			}],
			order: [
				[2, 'asc'],
				[4, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + ' </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right"> </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right">  </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right"> </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right"> </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right"> </td>')
							.append('<td> </td>')
							.append('<td style="text-align: right"> </td>')
							.append('<td> </td>');
					} else if (rows.data().pluck(4)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="text-wrap align-top">' + rows.data().pluck(5)[0] + '</td>')
							.append('<td class="text-wrap">' + rows.data().pluck(6)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(10)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(13)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(16)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(19)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(22)[0] + '</td>')
							.append('<td> </td>')
							.append('<td class="align-top text-right">' + rows.data().pluck(25)[0] + '</td>');
					}
				},
				dataSrc: [2, 4]
			}
		});

	});
</script>
<?= $this->endSection(); ?>