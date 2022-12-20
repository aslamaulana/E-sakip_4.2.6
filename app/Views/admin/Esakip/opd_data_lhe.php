<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div style="width:150px;position: absolute;right: 0px;">
	<a href="#" onclick="if(confirm('Tetapkan LHE ??')){location.href='<?= base_url() . '/admin/esakip/sakip_instansi_lhe/tetapkan_lhe'; ?>'}" href="#">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Tetapkan LHE</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="table-responsive">
		<table id="example1" class="table table-bordered" style="max-width: 1920px;min-width: 100%;">
			<thead>
				<tr>
					<th class="text-center align-middle" width="30px">No</th>
					<th class="align-middle">Nama SKPD</th>
					<th class="text-center align-middle">Belum Diverifikasi</th>
					<th class="text-center align-middle">Lolos</th>
					<th class="text-center align-middle">Dikembalikan</th>
					<th class="text-center align-middle">Jenis Unit</th>
					<th class="text-center align-middle">Sampel</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th class="text-center align-middle" width="30px">No</th>
					<th class="align-middle">Nama SKPD</th>
					<th class="text-center align-middle">Belum Diverifikasi</th>
					<th class="text-center align-middle">Lolos</th>
					<th class="text-center align-middle">Dikembalikan</th>
					<th class="text-center align-middle">Jenis Unit</th>
					<th class="text-center align-middle">Sampel</th>
				</tr>
			</tfoot>
			<tbody>
				<?php $nomor = 1;
				foreach ($opd as $row) : ?>
					<tr>
						<td class="text-center"><?= $nomor++; ?></td>
						<td>
							<a href="<?= base_url('/admin/esakip/sakip_instansi_lhe/data/' . $row['id'] . '/' . $row['description']); ?>">
								<?= $row['description']; ?>
							</a>
						</td>
						<td class="text-center">
							<?= $diajukan = $db->table('tb_sakip_instansi_jawaban_verifikasi_lhe')->getWhere(['verifikasi' => 'diajukan', 'opd_id' => $row['id'], 'tb_sakip_instansi_jawaban_verifikasi_lhe.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $lolos = $db->table('tb_sakip_instansi_jawaban_verifikasi_lhe')->getWhere(['verifikasi' => 'lolos', 'opd_id' => $row['id'], 'tb_sakip_instansi_jawaban_verifikasi_lhe.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?= $dikembalikan = $db->table('tb_sakip_instansi_jawaban_verifikasi_lhe')->getWhere(['verifikasi' => 'dikembalikan', 'opd_id' => $row['id'], 'tb_sakip_instansi_jawaban_verifikasi_lhe.tahun' => $_SESSION['tahun']])->getNumRows(); ?>
						</td>
						<td class="text-center">
							<?php $jenis_unit = $db->table('tb_sakip_opd')
								->getWhere(['opd_id' => $row['id'], 'tahun' => $_SESSION['tahun']])->getRowArray(); ?>
							<?= $jenis_unit['unit_utama'] == 'ya' ? '[' . 'Utama' . '] ' : ''; ?>
							<?= $jenis_unit['unit_pendukung'] == 'ya' ? '[' . 'Pendukung' . '] ' : ''; ?>
							<?= $jenis_unit['unit_tambahan'] == 'ya' ? '[' . 'Tambahan' . '] ' : ''; ?>

						</td>
						<td class="text-center">
							<?= $jenis_unit['sempel'] == 'ya' ? '[' . 'Sampel' . '] ' : ''; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->endSection(); ?>