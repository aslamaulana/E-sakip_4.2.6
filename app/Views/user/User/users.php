<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (user()->level == '1') { ?>
	<div style="width:90px;position: absolute;right: 0px;">
		<a href="<?= base_url('/user/user/users/users_add/2'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
<?php } ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card-body">
	<table class="table table-bordered  display nowrap" id="example1" cellspacing="0">
		<thead>
			<tr>
				<th style="width:160px;">Username</th>
				<th>Nama Pengguna</th>
				<th style="width:175px;">Nip</th>
				<th>Bidang</th>
				<th style="width:150px;">Sub Bagian / Klompok Subtansi</th>
				<th style="width:100px;">Jabatan</th>
				<th style="width:60px;">Golongan</th>
				<th style="width:60px;" class="text-center">Aktif</th>
				<th style="width:80px;" class="text-center">Aksi</th>
			</tr>
		</thead>
		<!-- <tfoot>
			<tr>
				<th>SKPD</th>
				<th>Nama Pengguna</th>
				<th>Username</th>
				<th>Aktif</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot> -->
		<tbody>
			<?php foreach ($users as $row) : ?>
				<tr style="background-color: antiquewhite;">
					<td><?= $row['username']; ?></td>
					<td>[KEPALA OPD] <?= $row['full_name']; ?> </a>
					</td>
					<td>
						<div style="width:175px;"> <?= $row['nip']; ?></div>
					</td>
					<td></td>
					<td><?= $row['sub_bidang']; ?></td>
					<td><?= $row['jabatan']; ?></td>
					<td class="text-center"><?= $row['golongan']; ?></td>
					<td class="text-center"><?= $row['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
					<td class="text-center">
						<?php if (user()->level == '1') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/user/user/users/users_edit/' . kunci($row['id'])); ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
						<?php } ?>
					</td>
				</tr>
				<?php $level_2 = $db->table('users')->getWhere(['opd_id' => user()->opd_id, 'level' => '2'])->getResultArray();
				foreach ($level_2 as $rol) : ?>
					<tr style="background: azure;">
						<td> <?= $rol['username']; ?> </td>
						<td>
							<div style="padding-left:20px;">
								<?php if (user()->level == '1' || user()->level == '2') { ?>
									<a href="<?= base_url('/user/user/users/users_add/3/' . $rol['id']); ?>" title="Tambah User">
										<?= $rol['full_name']; ?>
									</a>
								<?php } else { ?>
									<?= $rol['full_name']; ?>
								<?php } ?>
							</div>
						</td>
						<td><?= $rol['nip']; ?></td>
						<td><?= isset($rol['nama_singkat_bidang']) ? '(' . $rol['nama_singkat_bidang'] . ') ' . $rol['nama_panjang_bidang'] : ''; ?></td>
						<td><?= $rol['sub_bidang']; ?></td>
						<td><?= $rol['jabatan']; ?></td>
						<td class="text-center"><?= $rol['golongan']; ?></td>
						<td class="text-center"><?= $rol['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
						<td class="text-center">
							<?php if (user()->level == '1') { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/user/user/users/users_edit/' . kunci($rol['id']) . '/2'); ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/user/user/users/hapus/' . $rol['id'] . '/2/?nsb=' . $rol['nama_singkat_bidang'] . '&npb=' . $rol['nama_panjang_bidang']); ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
							<?php } ?>
							<?php if (user()->level == '2' && user()->nama_singkat_bidang == $rol['nama_singkat_bidang']) { ?>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/user/user/users/users_edit/' . kunci($rol['id']) . '/2'); ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
					<?php $level_3 = $db->table('users')->getWhere(['opd_id' => user()->opd_id, 'level' => '3', 'nama_singkat_bidang' => $rol['nama_singkat_bidang']])->getResultArray();
					foreach ($level_3 as $ros) : ?>
						<tr>
							<td><?= $ros['username']; ?></td>
							<td>
								<div style="padding-left:40px;">
									<?php if (user()->level == '1' || user()->level == '2' && user()->nama_singkat_bidang == $rol['nama_singkat_bidang'] || user()->level == '3') { ?>
										<a href="<?= base_url('/user/user/users/users_add/4/' . $ros['id']); ?>" title="Tambah User">
											<?= $ros['full_name']; ?>
										</a>
									<?php } else { ?>
										<?= $ros['full_name']; ?>
									<?php } ?>
								</div>
							</td>
							<td><?= $ros['nip']; ?></td>
							<td><?= isset($ros['nama_singkat_bidang']) ? '(' . $ros['nama_singkat_bidang'] . ') ' . $ros['nama_panjang_bidang'] : ''; ?></td>
							<td><?= $ros['sub_bidang']; ?></td>
							<td><?= $ros['jabatan']; ?></td>
							<td class="text-center"><?= $ros['golongan']; ?></td>
							<td class="text-center"><?= $ros['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
							<td class="text-center">
								<?php if (user()->nama_singkat_bidang == $ros['nama_singkat_bidang'] && user()->nip == $ros['nip'] && user()->level == '3' || user()->nama_singkat_bidang == $ros['nama_singkat_bidang'] && user()->level == '2' || user()->level == '1') { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/user/user/users/users_edit/' . kunci($ros['id']) . '/3'); ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
								<?php } ?>
								<?php if (user()->level == '2' && user()->nama_singkat_bidang == $ros['nama_singkat_bidang'] || user()->level == '1') { ?>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/user/user/users/hapus/' . $ros['id']); ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
								<?php } ?>
							</td>
						</tr>
						<?php $level_4 = $db->table('users')->getWhere(['opd_id' => user()->opd_id, 'level' => '4', 'nama_singkat_bidang' => $rol['nama_singkat_bidang']])->getResultArray();
						foreach ($level_4 as $rop) : ?>
							<tr>
								<td><?= $rop['username']; ?></td>
								<td>
									<div style="padding-left:60px;"> <?= $rop['full_name']; ?></div>
								</td>
								<td><?= $rop['nip']; ?></td>
								<td><?= isset($rop['nama_singkat_bidang']) ? '(' . $rop['nama_singkat_bidang'] . ') ' . $rop['nama_panjang_bidang'] : ''; ?></td>
								<td><?= $rop['sub_bidang']; ?></td>
								<td><?= $rop['jabatan']; ?></td>
								<td class="text-center"><?= $rop['golongan']; ?></td>
								<td class="text-center"><?= $rop['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
								<td class="text-center">
									<?php if (user()->sub_bidang == $rop['sub_bidang']  && user()->nama_singkat_bidang == $rop['nama_singkat_bidang'] || user()->level == '3' && user()->nama_singkat_bidang == $rop['nama_singkat_bidang'] ||  user()->level == '2' && user()->nama_singkat_bidang == $rop['nama_singkat_bidang'] || user()->level == '1') { ?>
										<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/user/user/users/users_edit/' . kunci($rop['id']) . '/4'); ?>">
											<i class="nav-icon fas fa-pen-alt"></i>
										</a>
									<?php } ?>
									<?php if (user()->level == '3' && user()->nama_singkat_bidang == $rop['nama_singkat_bidang'] ||  user()->level == '2' && user()->nama_singkat_bidang == $rop['nama_singkat_bidang'] || user()->level == '1') { ?>
										<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/user/user/users/hapus/' . $rop['id']); ?>'}" href="#">
											<i class="nav-icon fas fa-trash-alt"></i>
										</a>
									<?php } ?>
								</td>
							</tr>
						<?php endforeach; ?>
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
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
		});
	});
</script>
<?= $this->endSection(); ?>