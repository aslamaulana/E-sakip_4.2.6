<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/user/bidang/bidang_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered" id="example1" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="col-3">Nama SKPD</th>
				<th class="col-7">Keterangan</th>
				<th class="text-center col-2">Akses</th>
				<th class="text-center">User</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">No</th>
				<th>Nama SKPD</th>
				<th>Keterangan</th>
				<th class="text-center">Akses</th>
				<th class="text-center">User</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $no = 1;
			foreach ($bidang as $row) : ?>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td><?= $row['name']; ?></td>
					<td><?= $row['description']; ?></td>
					<td class="text-center">
						<?php $query = $db->table('auth_groups_permissions')->select('auth_permissions.*')->join('auth_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id', 'LEFT')->getWhere(['auth_groups_permissions.group_id' => $row['id']])->getResultArray();
						foreach ($query as $ros) : ?>
							"<?= $ros['name']; ?>"
						<?php endforeach; ?>
						</tb>
					<td class="text-center">
						<?php $user = $db->table('users')->getWhere(['users.opd_id' => $row['id']])->getNumRows(); ?>
						<a class="btn btn-success btn-circle btn-xs" title="<?= $user . ' User'; ?>" href="<?= base_url('/admin/user/users/user/' . kunci($row['id']) . '?nm=' . $row['description']); ?>">
							<?= $user . '   '; ?><i class="nav-icon fas fa-user"></i>
						</a>
					</td>
					<td class="text-center">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/admin/user/bidang/bidang_edit/' . kunci($row['id'])); ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/admin/user/bidang/hapus/' . $row['id']); ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
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
<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
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