<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_sasaran/opd_sasaran_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/renstra/opd_sasaran/import'); ?>">
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
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>
					<div style="width: 550px;">Sasaran Pemda / Sasaran / Sasaran Indikator</div>
				</th>
				<th>
					<div style="width: 350px;">Tujuan OPD</div>
				</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style="text-align: center;">Kode</th>
				<th>Sasaran Pemda / Sasaran / Sasaran Indikator</th>
				<th>Tujuan Opd</th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($rpjmd_sasaran as $rox) : ?>
				<!-- Visi -->
				<tr style="background-color: blanchedalmond;">
					<td class="font-weight-bold text-center"><?= $rox['kode_sasaran']; ?></td>
					<!--sasaran rpjmd digunakan sebagal tujuan opd -->
					<td class="text-justify font-weight-bold">[SASARAN RPJMD] <?= $rox['rpjmd_sasaran_n']; ?></td>
					<td class="text-justify font-weight-bold"></td>
					<?php foreach ($tahunA as $th) : ?>
						<td></td>
					<?php endforeach; ?>
					<td></td>
				</tr>

				<?php $query = $db->table('tb_renstra_sasaran')
					->select('tb_renstra_sasaran.opd_sasaran, tb_renstra_sasaran.opd_kode_sasaran, tb_renstra_sasaran.opd_tujuan_n, tb_renstra_sasaran.rpjmd_sasaran_n, tb_renstra_tujuan.opd_kode_tujuan')
					->distinct('tb_renstra_sasaran.opd_sasaran, tb_renstra_sasaran.opd_kode_sasaran, tb_renstra_sasaran.opd_tujuan_n, tb_renstra_sasaran.rpjmd_sasaran_n, tb_renstra_tujuan.opd_kode_tujuan')
					->join('tb_renstra_tujuan', 'tb_renstra_sasaran.opd_id = tb_renstra_tujuan.opd_id AND tb_renstra_sasaran.opd_tujuan_n = tb_renstra_tujuan.opd_tujuan', 'left')
					->getWhere(['tb_renstra_sasaran.rpjmd_sasaran_n' => $rox['rpjmd_sasaran_n'], 'tb_renstra_sasaran.opd_id' => user()->opd_id])->getResultArray();
				foreach ($query as $ros) : ?>
					<!-- Sasaran -->
					<tr>
						<td class="align-top text-center"><?= $ros['opd_kode_sasaran']; ?></td>
						<td class="align-top text-wrap">
							<div style="padding-left: 20px;">[SASARAN] <?= '<a href="/user/renstra/opd_sasaran/opd_sasaran_indik_add?p=' . $ros['opd_sasaran'] . '&k=' . $ros['opd_kode_sasaran'] . '&m=' . $ros['opd_tujuan_n'] . '" title="Tambah Indikator Sasaran">' . $ros['opd_sasaran'] . '</a>'; ?></div>
						</td>
						<td class="align-top  text-wrap"><?= '[' . $ros['opd_kode_tujuan'] . '] ' . $ros['opd_tujuan_n']; ?> </td>
						<?php foreach ($tahunA as $th) : ?>
							<td></td>
						<?php endforeach; ?>
						<td class="text-center align-top">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" title="Ubah sasaran" href="<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_edit?p=' . $ros['opd_sasaran'] . '&k=' . $ros['opd_kode_sasaran'] . '&m=' . $ros['opd_tujuan_n'] . '&o=' . user()->opd_id . '&rs=' . $ros['rpjmd_sasaran_n']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
							<?php } else { ?>
								<a class="btn btn-danger btn-circle btn-xs">
									<i class="nav-icon fas fa-lock"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
					<?php $querz = $db->table('tb_renstra_sasaran')->getWhere(['opd_sasaran' => $ros['opd_sasaran'], 'opd_kode_sasaran' => $ros['opd_kode_sasaran'], 'opd_tujuan_n' => $ros['opd_tujuan_n'], 'opd_id' => user()->opd_id, 'rpjmd_sasaran_n' => $ros['rpjmd_sasaran_n']])->getResultArray();
					foreach ($querz as $rom) : ?>
						<tr>
							<td></td>
							<td class="align-top  text-wrap">
								<div style="padding-left: 40px;"><?= $rom['opd_indikator_sasaran']; ?></div>
							</td>
							<td></td>
							<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
							<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
							<td class="text-center align-top">
								<?php if (menu('renstra')->kunci == 'tidak') { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_indik_edit/' . $rom['id_opd_sasaran']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_sasaran/opd_sasaran_indik_hapus/' . $rom['id_opd_sasaran']; ?>'}" href="#">
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
				"width": "80%",
				"targets": 1
			}]
		});
	});
</script>
<?= $this->endSection(); ?>