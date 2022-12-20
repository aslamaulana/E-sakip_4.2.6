<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div>
		<a href="<?= base_url('/user/renstra/opd_kegiatan_sasaran/import'); ?>">
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
				<th>Sasaran Program / Sasaran Kegiatan</th>
				<th style="width: 60px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>No</th>
				<th>Sasaran Program / Sasaran Kegiatan</th>
				<th style="text-align:center;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($program_sasaran as $row) : ?>
				<tr>
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="font-weight-bold">[SASARAN PROGRAM] <a href="<?= base_url('/user/renstra/opd_kegiatan_sasaran/opd_kegiatan_sasaran_add/' . $row['opd_program_sasaran']); ?>" title="Tambah kegiatan sasaran"><?= $row['opd_program_sasaran']; ?></a></td>
					<td></td>
				</tr>
				<?php $query = $db->table('tb_renstra_kegiatan_sasaran')
					/* ->select('tb_renstra_kegiatan_sasaran.opd_kegiatan_sasaran') */
					->getWhere(['tb_renstra_kegiatan_sasaran.opd_program_sasaran_n' => $row['opd_program_sasaran'], 'tb_renstra_kegiatan_sasaran.opd_id' => user()->opd_id])->getResultArray();
				foreach ($query as $ros) : ?>
					<tr>
						<td></td>
						<td>
							<div style="padding-left: 40px;"><?= $ros['opd_kegiatan_sasaran']; ?></div>
						</td>
						<td style="text-align: center;">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_kegiatan_sasaran/opd_kegiatan_sasaran_edit/' . $ros['id_opd_kegiatan_sasaran']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_kegiatan_sasaran/opd_kegiatan_sasaran_hapus/' . $ros['id_opd_kegiatan_sasaran']; ?>'}" href="#">
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