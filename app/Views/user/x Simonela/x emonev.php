<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/user/dpa/dpa/dpa_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" width="40px">No</th>
				<th>Kode</th>
				<th>Program / Kegiatan / Sub Kegiatan</th>
				<th>Lokasi</th>
				<th>Pagu</th>
				<th>Bobot(%)</th>
				<th>Sub Unit Organisasi SKPD</th>
				<th style="width: 100px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style="text-align:center;">No</th>
				<th>Kode</th>
				<th>Program / Kegiatan / Sub Kegiatan</th>
				<th>Lokasi</th>
				<th>Pagu</th>
				<th>Bobot(%)</th>
				<th>Sub Unit Organisasi SKPD</th>
				<th style="text-align:center;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($dpa as $row) : ?>
				<tr style="background-color: antiquewhite;">
					<td><?= $nomor++; ?></td>
					<td><b><?= $row['id_program']; ?></b></td>
					<td><b>[PROGRAM] <?= $row['program']; ?></b></td>
					<td></td>
					<?php $pagu = $db->table('tb_opd_program')->selectsum('tb_ropk_keuangan_rekening.pagu_rekening')
						->join('tb_opd_kegiatan', 'tb_opd_program.id_opd_program = tb_opd_kegiatan.opd_program_id', 'left')
						->join('tb_opd_kegiatan_sub', 'tb_opd_kegiatan.id_opd_kegiatan = tb_opd_kegiatan_sub.opd_kegiatan_id', 'left')
						->join('tb_dpa', 'tb_opd_kegiatan_sub.id_opd_kegiatan_sub = tb_dpa.opd_kegiatan_sub_id', 'left')
						->join('tb_ropk_keuangan_group', 'tb_dpa.id_dpa = tb_ropk_keuangan_group.dpa_id', 'left')
						->join('tb_ropk_keuangan_rekening', 'tb_ropk_keuangan_group.id_ropk_keuangan_group = tb_ropk_keuangan_rekening.ropk_keuangan_group_id', 'left')
						->getWhere(['id_opd_program' => $row['id_opd_program']])->getRowArray(); ?>
					<td class="text-right"><b><?= number_format($pagu['pagu_rekening'], 0, ',', '.'); ?></b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php $query = $db->table('tb_dpa')
					->distinct('set_kegiatan_90.id_kegiatan')
					->orderBy('set_kegiatan_90.id_kegiatan', 'ASC')
					->select('tb_opd_kegiatan.id_opd_kegiatan')
					->select('set_kegiatan_90.id_kegiatan')
					->select('set_kegiatan_90.kegiatan')

					->join('tb_opd_kegiatan_sub', 'tb_dpa.opd_kegiatan_sub_id = tb_opd_kegiatan_sub.id_opd_kegiatan_sub', 'left')
					->join('tb_opd_kegiatan', 'tb_opd_kegiatan_sub.opd_kegiatan_id = tb_opd_kegiatan.id_opd_kegiatan', 'left')
					->join('set_kegiatan_90', 'tb_opd_kegiatan.kegiatan_id = set_kegiatan_90.id_kegiatan', 'left')
					->getWhere(['opd_program_id' => $row['id_opd_program']])->getResultArray();
				foreach ($query as $rol) : ?>
					<tr style="background-color: azure;">
						<td></td>
						<td><b><?= $rol['id_kegiatan']; ?></b></td>
						<td><b><?= $rol['kegiatan']; ?></b></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php $query = $db->table('tb_dpa')
						->select('set_sub_kegiatan_90.id_sub_kegiatan')
						->select('set_sub_kegiatan_90.sub_kegiatan')
						->select('tb_dpa.*')
						->select('tb_opd_bidang_sub.nama_bidang_sub')
						->select('tb_opd_bidang.nama_bidang')

						->join('tb_opd_kegiatan_sub', 'tb_dpa.opd_kegiatan_sub_id = tb_opd_kegiatan_sub.id_opd_kegiatan_sub', 'left')
						->join('set_sub_kegiatan_90', 'tb_opd_kegiatan_sub.kegiatan_sub_id = set_sub_kegiatan_90.id_sub_kegiatan', 'left')
						->join('tb_opd_bidang_sub', 'tb_dpa.bidang_sub_id = tb_opd_bidang_sub.id_opd_bidang_sub', 'left')
						->join('tb_opd_bidang', 'tb_opd_bidang_sub.opd_bidang_id = tb_opd_bidang.id_opd_bidang', 'left')
						->getWhere(['opd_kegiatan_id' => $rol['id_opd_kegiatan']])->getResultArray();
					foreach ($query as $ros) : ?>
						<tr>
							<td></td>
							<td><?= $ros['id_sub_kegiatan']; ?></td>
							<td><?= $ros['sub_kegiatan']; ?></td>
							<td><?= $ros['lokasi']; ?></td>
							<?php $pagu_r = $db->table('tb_ropk_keuangan_group')->selectsum('tb_ropk_keuangan_rekening.pagu_rekening')
								->join('tb_ropk_keuangan_rekening', 'tb_ropk_keuangan_group.id_ropk_keuangan_group = tb_ropk_keuangan_rekening.ropk_keuangan_group_id', 'left')
								->getWhere(['tb_ropk_keuangan_group.dpa_id' => $ros['id_dpa']])->getRowArray(); ?>
							<td class="text-right"><?= number_format($pagu_r['pagu_rekening'], 0, ',', '.'); ?></td>
							<td class="text-center">
								<?php
								try {
									$result = round(($pagu_r['pagu_rekening'] / $pagu['pagu_rekening']) * 100, 2);
									echo $result;
								} catch (DivisionByZeroError $e) {
									echo '-';
								}
								?>
							</td>
							<td><?= $ros['nama_bidang'] . '-' . $ros['nama_bidang_sub']; ?></td>
							<td class="text-center">
								<a class="btn btn-primary btn-circle btn-xs" title="Progres" href="<?= base_url() . '/user/emonev/emonev/progres/' . $ros['id_dpa'] . '/' . $ros['sub_kegiatan']; ?>">
									Progres <i class="nav-icon fas fa-chart-bar"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>