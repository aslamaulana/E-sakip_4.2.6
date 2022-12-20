<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="<?= base_url('/admin/rpjmd/program/program_add'); ?>" title="Tambah Program">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<div>
	<a href="<?= base_url('/admin/rpjmd/program/import'); ?>">
		<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle">Kode</th>
				<th rowspan="2" class="align-middle">Sasaran / Program / Program Indikator</th>
				<th rowspan="2" class="text-center align-middle">Penanggung Jawab</th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th rowspan="2" class="text-center align-middle">Aksi</th>
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
				<th class="text-center">Kode</th>
				<th>Sasaran / Program / Program Indikator</th>
				<th class="text-center">Penanggung Jawab</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center align-middle">Target</th>
					<th class="text-center align-middle">Pagu</th>
				<?php endforeach; ?>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($sasaran as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="c1"><?= $row['kode_sasaran']; ?></td>
					<td class="c2 text-justify font-weight-bold">[SASARAN] <?= $row['sasaran']; ?></td>
					<td class=""></td>
					<?php foreach ($tahunA as $th) : ?>
						<td class="c4"></td>
						<td class="c5"></td>
					<?php endforeach; ?>
					<td class="c6"></td>
				</tr>
				<?php $query = $db->table('tb_rpjmd_program')
					->select('tb_rpjmd_program.urusan_90, tb_rpjmd_program.bidang_90, tb_rpjmd_program.sasaran_n, tb_rpjmd_program.program_90, tb_rpjmd_program.opd_id, auth_groups.name, set_program_90.id_program as kode_program')
					->distinct('tb_rpjmd_program.urusan_90, tb_rpjmd_program.bidang_90, tb_rpjmd_program.sasaran_n, tb_rpjmd_program.program_90, tb_rpjmd_program.opd_id, auth_groups.name, set_program_90.id_program')
					->join('auth_groups', 'tb_rpjmd_program.opd_id = auth_groups.id', 'LEFT')
					->join('set_program_90', 'tb_rpjmd_program.program_90 = set_program_90.program', 'LEFT')
					->getWhere(['sasaran_n' => $row['sasaran']])->getResultArray();
				foreach ($query as $ros) : ?>
					<tr style="background: azure;">
						<td class="c1"></td>
						<td class="c2 text-wrap">[<?= $ros['kode_program']; ?>] <?= '<a href="/admin/rpjmd/program/program_indik_add?u=' . $ros['urusan_90'] . '&b=' . $ros['bidang_90'] . '&p=' . $ros['program_90'] . '&s=' . $ros['sasaran_n'] . '&k=' . $ros['kode_program'] . '&o=' . $ros['opd_id'] . '" title="Add Indikator program">' . $ros['program_90'] . '</a>'; ?></td>
						<td class="text-center"><?= $ros['name']; ?></td>
						<?php foreach ($tahunA as $th) : ?>
							<td class="c4" style="background: aliceblue;"></td>
							<td class="c5"></td>
						<?php endforeach; ?>
						<td class="c6" style="text-align: center;">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/program/program_edit?u=' . $ros['urusan_90'] . '&b=' . $ros['bidang_90'] . '&p=' . $ros['program_90'] . '&s=' . $ros['sasaran_n'] . '&k=' . $ros['kode_program'] . '&o=' . $ros['opd_id']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
						</td>
					</tr>
					<?php $querz = $db->table('tb_rpjmd_program')->getWhere(['program_90' => $ros['program_90'], 'urusan_90' => $ros['urusan_90'], 'bidang_90' => $ros['bidang_90'], 'sasaran_n' => $ros['sasaran_n'], 'opd_id' => $ros['opd_id']])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td class="c1"></td>
							<td class="c2">
								<div style="padding-left: 40px;"> <?= $rom['indikator_program']; ?></div>
							</td>
							<td class=""></td>
							<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-right"><?= number_format($rom['rp_2021'], 2, ',', '.'); ?></td>
							<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-right"><?= number_format($rom['rp_2022'], 2, ',', '.'); ?></td>
							<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-right"><?= number_format($rom['rp_2023'], 2, ',', '.'); ?></td>
							<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-right"><?= number_format($rom['rp_2024'], 2, ',', '.'); ?></td>
							<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-right"><?= number_format($rom['rp_2025'], 2, ',', '.'); ?></td>
							<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-right"><?= number_format($rom['rp_2026'], 2, ',', '.'); ?></td>
							<td class="c6" style="text-align: center;">
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/program/program_indik_edit/' . $rom['id_program']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/program/program_indik_hapus/' . $rom['id_program']; ?>'}" href="#">
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
				"width": "50%",
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