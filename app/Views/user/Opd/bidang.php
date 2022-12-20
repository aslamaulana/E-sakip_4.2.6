<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/user/opd/bidang/bidang_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>Bidang / Sub Bidang</th>
				<th>Kepala Bidang / Kepala Sub Bidang</th>
				<th>NIP</th>
				<th>Golongan</th>
				<th>Eselon</th>
				<th>Aktif</th>
				<th class="text-center" width="80px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>Bidang / Sub Bidang</th>
				<th>Kepala Bidang / Kepala Sub Bidang</th>
				<th>NIP</th>
				<th>Golongan</th>
				<th>Eselon</th>
				<th>Aktif</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($bidang as $row) : ?>
				<tr>
					<td><?= $row['kode']; ?></td>
					<td><b>[BIDANG]</b> <a href="<?= base_url() . '/user/opd/bidang/bidang_sub_add/' . $row['id_opd_bidang']; ?>" title="add sub bidang"><?= $row['nama_bidang']; ?></a></td>
					<td><?= $row['kepala_bidang']; ?></td>
					<td><?= $row['nip']; ?></td>
					<td><?= $row['golongan']; ?></td>
					<td><?= $row['eselon']; ?></td>
					<td><?= $row['aktif'] == 'Y' ? '<i style="color: green;font-style: inherit;">Aktif</i>' : '<i style="color: red;font-style: inherit;">Tidak Aktif</i>'; ?></td>
					<td class="text-center">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/opd/bidang/bidang_edit/' . $row['id_opd_bidang']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/opd/bidang/bidang_hapus/' . $row['id_opd_bidang']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>
				<?php $query = $db->table('tb_opd_bidang_sub')->getWhere(['opd_bidang_id' => $row['id_opd_bidang']])->getResultArray();
				foreach ($query as $rol) : ?>
					<tr>
						<td><?= $rol['kode_sub']; ?></td>
						<td style="padding-left: 40px;"><b>[SUB BIDANG]</b> <?= $rol['nama_bidang_sub']; ?></td>
						<td><?= $rol['kepala_bidang_sub']; ?></td>
						<td><?= $rol['nip_sub']; ?></td>
						<td><?= $rol['golongan_sub']; ?></td>
						<td><?= $rol['eselon_sub']; ?></td>
						<td><?= $rol['aktif_sub'] == 'Y' ? '<i style="color: green;font-style: inherit;">Aktif</i>' : '<i style="color: red;font-style: inherit;">Tidak Aktif</i>'; ?></td>
						<td class="text-center">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/opd/bidang/bidang_sub_edit/' . $rol['id_opd_bidang_sub'] . '/' . $row['id_opd_bidang']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/opd/bidang/bidang_sub_hapus/' . $rol['id_opd_bidang_sub']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>