<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_program/opd_program_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/renstra/opd_program/import'); ?>">
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
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;" width="30px">No</th>
				<th>
					<div style="width: 550px;">Sasaran / Program / Program Indikator</div>
				</th>
				<th>
					<div style="width: 250px;">Sasaran Program</div>
				</th>
				<?php foreach ($tahunA as $row) : ?>
					<th style="width: 60px; text-align:center;"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th style="width: 60px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>No</th>
				<th>Sasaran / Program / Program Indikator</th>
				<th>Sasaran Program</th>
				<?php foreach ($tahunA as $row) : ?>
					<th style="width: 60px; text-align:center;"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th style="text-align:center;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_sasaran as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="font-weight-bold">[SASARAN] <?= $row['opd_sasaran_n']; ?></td>
					<td></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
					<?php endforeach; ?>
					<td></td>
				</tr>
				<?php $query = $db->table('tb_renstra_program')
					->select('set_program_90.id_program, tb_renstra_program.opd_program_n, tb_renstra_program.opd_sasaran_n,  tb_renstra_program.opd_id, tb_renstra_program.opd_program_sasaran_n')
					->distinct('set_program_90.id_program, tb_renstra_program.opd_program_n, tb_renstra_program.opd_sasaran_n,  tb_renstra_program.opd_id, tb_renstra_program.opd_program_sasaran_n')
					->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'left')
					->getWhere(['tb_renstra_program.opd_sasaran_n' => $row['opd_sasaran_n'], 'tb_renstra_program.opd_id' => user()->opd_id])->getResultArray();
				foreach ($query as $ros) : ?>
					<tr>
						<td></td>
						<td>
							<div style="padding-left: 20px;">[<?= $ros['id_program']; ?>] <?= '<a href="/user/renstra/opd_program/opd_program_indik_add?p=' . $ros['opd_program_n'] . '&a=' . $ros['opd_sasaran_n'] . '&m=' . $ros['opd_program_sasaran_n'] . '" title="Tambah Indikator Program">' . $ros['opd_program_n'] . '</a>'; ?></div>
						</td>
						<td class="text-wrap"><?= $ros['opd_program_sasaran_n']; ?></td>
						<?php foreach ($tahunA as $th) : ?>
							<td></td>
						<?php endforeach; ?>
						<td style="text-align: center;">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_program/opd_program_edit?p=' . $ros['opd_program_n'] . '&a=' . $ros['opd_sasaran_n'] . '&m=' . $ros['opd_program_sasaran_n']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
							<?php } else { ?>
								<a class="btn btn-danger btn-circle btn-xs">
									<i class="nav-icon fas fa-lock"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
					<?php $querz = $db->table('tb_renstra_program')->getWhere(['opd_program_n' => $ros['opd_program_n'], 'opd_sasaran_n' => $ros['opd_sasaran_n'], 'opd_id' => user()->opd_id])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td></td>
							<td>
								<div style="padding-left: 40px;"><?= $rom['opd_indikator_program']; ?></div>
							</td>
							<td></td>
							<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
							<td style="text-align: center;">
								<?php if (menu('renstra')->kunci == 'tidak') { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_program/opd_program_indik_edit/' . $rom['id_opd_program']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_program/opd_program_indik_hapus/' . $rom['id_opd_program']; ?>'}" href="#">
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