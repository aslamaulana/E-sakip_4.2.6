<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/user/dpa/dpa_indikator/dpa_indikator_add/' . $id_dpa . '/' . $nm); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<div style="width:80px;position: absolute;right: 90px;">
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body row">
	<div class="col-md">
		<h5><b>[SUB KEGIATAN]</b> <?= $nm; ?></h5>
	</div>
</div>
<div class="card-body row">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;" width="40px">No</th>
				<th>Indikator</th>
				<th>Satuan</th>
				<th>Target Akhir</th>
				<th>Jenis</th>
				<th style="width: 80px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<!-- <tfoot>
					<tr>
						<th style="text-align:center;">No</th>
						<th>Indikator</th>
						<th>Satuan</th>
						<th>Target Akhir</th>
						<th>Jenis</th>
						<th style="text-align:center;">Aksi</th>
					</tr>
				</tfoot> -->
		<tbody>
			<?php $nomor = 1;
			$query = $db->table('tb_dpa_indikator')
				->select('tb_dpa_indikator.*')
				->select('tb_satuan.satuan')

				->join('tb_satuan', 'tb_dpa_indikator.satuan_id = tb_satuan.id_satuan', 'left')
				->getWhere(['dpa_id' => $id_dpa])->getResultArray();
			foreach ($query as $row) : ?>
				<tr>
					<td><?= $nomor++; ?></td>
					<td><?= $row['indikator']; ?></td>
					<td><?= $row['satuan']; ?></td>
					<td><?= $row['target_akhir']; ?></td>
					<td><?= $row['type']; ?></td>
					<td style="text-align: center;">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/dpa/dpa_indikator/dpa_indikator_edit/' . $row['id_dpa_indikator'] . '/' . $id_dpa . '/' . $nm; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/dpa/dpa_indikator/dpa_indikator_hapus/' . $row['id_dpa_indikator']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>