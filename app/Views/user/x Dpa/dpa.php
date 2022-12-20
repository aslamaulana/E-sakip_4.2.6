<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/user/dpa/dpa/dpa_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<!-- <div class="row"> -->
	<!-- <div class="table-responsive"> -->
	<!-- <table id="example1" class="table table-bordered" style="max-width: 2000;min-width: 1920px;"> -->
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th class="text-center" width="40px">No</th>
				<th>Kode</th>
				<th>Program / Kegiatan / Sub Kegiatan</th>
				<th class="text-center">Lokasi</th>
				<th class="text-center">Hasil</th>
				<th class="text-center">Keluaran</th>
				<th class="text-center">Pagu</th>
				<th>Bobot(%)</th>
				<th>Sub Unit Organisasi SKPD</th>
				<th>Keterangan</th>
				<th style="width: 122220px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style="text-align:center;">No</th>
				<th>Kode</th>
				<th>Program / Kegiatan / Sub Kegiatan</th>
				<th class="text-center">Lokasi</th>
				<th class="text-center">Hasil</th>
				<th class="text-center">Keluaran</th>
				<th class="text-center">Pagu</th>
				<th>Bobot(%)</th>
				<th>Sub Unit Organisasi SKPD</th>
				<th>Keterangan</th>
				<th style="text-align:center;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($dpa as $row) : ?>
				<tr style="background-color: antiquewhite;">
					<td><?= $nomor++; ?></td>
					<td class="font-weight-bold"><?= $row['id_program']; ?></td>
					<td class="font-weight-bold">[PROGRAM] <?= $row['program']; ?></td>
					<td></td>
					<td></td>
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
					<td class="text-center">

					</td>
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
						<td class="font-weight-bold"><?= $rol['id_kegiatan']; ?></td>
						<td class="text-wrap font-weight-bold"><?= $rol['kegiatan']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td class="text-center">

						</td>
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
							<td class="align-baseline"><?= $ros['id_sub_kegiatan']; ?></td>
							<td class="align-baseline text-justify"><?= $ros['sub_kegiatan']; ?></td>
							<td class="align-baseline"><?= $ros['lokasi']; ?></td>
							<td class="align-baseline text-justify">
								<?php $hasil = $db->table('tb_dpa_indikator')->select('tb_satuan.satuan')->select('tb_dpa_indikator.*')->join('tb_satuan', 'tb_dpa_indikator.satuan_id = tb_satuan.id_satuan', 'left')->getWhere(['dpa_id' => $ros['id_dpa'], 'type' => 'Hasil'])->getResultArray();
								foreach ($hasil as $ro_1) :	?>
									<?= empty($ro_1['indikator']) ? '' : $ro_1['indikator'] . ': ' . $ro_1['target_akhir'] . ' ' . $ro_1['satuan']; ?><br>
								<?php endforeach; ?>
							</td>
							<td class="align-baseline text-justify">
								<?php $keluaran = $db->table('tb_dpa_indikator')->select('tb_satuan.satuan')->select('tb_dpa_indikator.*')->join('tb_satuan', 'tb_dpa_indikator.satuan_id = tb_satuan.id_satuan', 'left')->getWhere(['dpa_id' => $ros['id_dpa'], 'type' => 'Keluaran'])->getResultArray();
								foreach ($keluaran as $ro_2) :	?>
									<?= empty($ro_2['indikator']) ? '' : $ro_2['indikator'] . ': ' . $ro_2['target_akhir'] . ' ' . $ro_2['satuan']; ?><br>
								<?php endforeach; ?>
							</td class="align-baseline">
							<?php $pagu_r = $db->table('tb_ropk_keuangan_group')->selectsum('tb_ropk_keuangan_rekening.pagu_rekening')
								->join('tb_ropk_keuangan_rekening', 'tb_ropk_keuangan_group.id_ropk_keuangan_group = tb_ropk_keuangan_rekening.ropk_keuangan_group_id', 'left')
								->getWhere(['tb_ropk_keuangan_group.dpa_id' => $ros['id_dpa']])->getRowArray(); ?>
							<td class="text-right align-baseline"><?= number_format($pagu_r['pagu_rekening'], 0, ',', '.'); ?></td>
							<td class="text-center align-baseline">
								<?php
								try {
									$result = round(($pagu_r['pagu_rekening'] / $pagu['pagu_rekening']) * 100, 2);
									echo $result;
								} catch (DivisionByZeroError $e) {
									echo '-';
								}
								?>
							</td>
							<td class="align-baseline"><?= $ros['nama_bidang'] . '-' . $ros['nama_bidang_sub']; ?></td>
							<td class="align-baseline"><?= $ros['keterangan']; ?></td>
							<td class="text-center">
								<a class="btn btn-success btn-circle btn-xs" title="Indikator" href="<?= base_url() . '/user/dpa/dpa_indikator/dpa_indikator/' . $ros['id_dpa'] . '/' . $ros['sub_kegiatan']; ?>">
									<i class="nav-icon fas fa-chart-bar"></i>
								</a>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/dpa/dpa/dpa_edit/' . $ros['id_dpa']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/dpa/dpa/dpa_hapus/' . $ros['id_dpa']; ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	<!-- </div> -->
	<!-- </div> -->
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
			scrollX: true,
			scrollY: '65vh',
			scrollCollapse: false,
			paging: false,
			responsive: true,
			autoWidth: false,
			ordering: false,
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