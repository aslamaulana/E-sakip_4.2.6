<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_arah_kebijakan/opd_arah_kebijakan_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<?php if ($_SESSION['perubahan'] == 'Perubahan') { ?>
		<div>
			<a onclick="if(confirm('Import langsung dari RENSTRA murni??')){location.href='<?= base_url() . '/user/renstra/opd_arah_kebijakan/import_arah_kebijakan'; ?>'}" href="#">
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
				<th>Strategi / Arah Kebijakan</th>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Strategi / Arah Kebijakan</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_strategi as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="align-top font-weight-bold">[STRATEGI] <?= $row['opd_strategi']; ?></td>
					<td> </td>
				</tr>
				<?php $querz = $db->table('tb_renstra_arah_kebijakan')->getWhere(['opd_strategi_n' => $row['opd_strategi'], 'perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->getResultArray();
				foreach ($querz as $rol) : ?>
					<tr>
						<td>
							<div style="padding-left: 40px;"><?= $rol['opd_arah_kebijakan']; ?></div>
						</td>
						<td class="text-center">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_arah_kebijakan/opd_arah_kebijakan_edit/' . $rol['id_opd_arah_kebijakan']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_arah_kebijakan/opd_arah_kebijakan_hapus/' . $rol['id_opd_arah_kebijakan']; ?>'}" href="#">
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