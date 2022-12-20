<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('admin/user/bidang/bidang_update'); ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= kunci($bidang['id']); ?>">
		<input type="hidden" name="id_g_p" value="<?= $bidang['id_g_p']; ?>">
		<div class="col-md">
			<div class="form-group">
				<label>Nama SKPD</label>
				<input type="text" name="nm" value="<?= $bidang['name']; ?>" class="form-control <?= ($validation->hasError('nm')) ? 'is-invalid' : ''; ?>" placeholder=" Nama SKPD" maxlength="255" required>
				<div class="invalid-feedback">
					<?= $validation->getError('nm'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Detail</label>
				<input type="text" name="detail" value="<?= $bidang['description']; ?>" class="form-control" placeholder="Detail" maxlength="255" required>
			</div>
			<div class="form-group">
				<label>Akses</label><br>
				<?php $query_2 = $db->table('auth_groups_permissions')->select('auth_permissions.*')->join('auth_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id', 'LEFT')->getWhere(['auth_groups_permissions.group_id' => $bidang['id'], 'auth_groups_permissions.permission_id' => '2'])->getRow(); ?>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="akses[]" value="2" <?= isset($query_2->id) == '2' ? 'checked' : ''; ?>>
					<label class="form-check-label">User</label>
				</div>
				<?php $query_3 = $db->table('auth_groups_permissions')->select('auth_permissions.*')->join('auth_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id', 'LEFT')->getWhere(['auth_groups_permissions.group_id' => $bidang['id'], 'auth_groups_permissions.permission_id' => '3'])->getRow(); ?>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="akses[]" value="3" <?= isset($query_3->id) == '3' ? 'checked' : ''; ?>>
					<label class="form-check-label">Verifikator</label>
				</div>
				<?php $query_1 = $db->table('auth_groups_permissions')->select('auth_permissions.*')->join('auth_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id', 'LEFT')->getWhere(['auth_groups_permissions.group_id' => $bidang['id'], 'auth_groups_permissions.permission_id' => '1'])->getRow(); ?>
				<div class="form-check">
					<input class="form-check-input" disabled type="checkbox" name="akses[]" value="1" <?= isset($query_1->id) == '1' ? 'checked' : ''; ?>>
					<label class="form-check-label">Admin</label>
				</div>
				<?php $query = $db->table('auth_groups_permissions')->select('auth_groups_permissions.*')->join('auth_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id', 'LEFT')->getWhere(['auth_groups_permissions.group_id' => $bidang['id']])->getResultArray();
				foreach ($query as $ros) : ?>
					<input type="hidden" name="akses_old[]" value="<?= $ros['id_g_p']; ?>">
				<?php endforeach; ?>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</div>
</form>
<?= $this->endSection(); ?>