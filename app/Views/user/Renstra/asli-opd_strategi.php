<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a href="<?= base_url('/user/renstra/opd_strategi/opd_strategi_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
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
				<th class="text-center" width="40px">Kode</th>
				<th>Sasaran / strategi</th>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">Kode</th>
				<th>Sasaran / strategi</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_sasaran as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="align-top font-weight-bold"><?= $row['opd_kode_sasaran']; ?></td>
					<td class="align-top font-weight-bold">[SASARAN] <?= $row['opd_sasaran']; ?></td>
					<td> </td>
				</tr>
				<?php $querz = $db->table('tb_renstra_strategi')->getWhere(['opd_sasaran_n' => $row['opd_sasaran'], 'opd_id' => user()->opd_id])->getResultArray();
				foreach ($querz as $rol) : ?>
					<tr>
						<td></td>
						<td>
							<div style="padding-left: 40px;"><?= $rol['opd_strategi']; ?></div>
						</td>
						<td class="text-center">
							<?php if (menu('renstra')->kunci == 'tidak') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_strategi/opd_strategi_edit/' . $rol['id_opd_strategi']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_strategi/opd_strategi_hapus/' . $rol['id_opd_strategi']; ?>'}" href="#">
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