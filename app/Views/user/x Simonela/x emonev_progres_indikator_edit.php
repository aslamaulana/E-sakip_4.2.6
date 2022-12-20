<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col">
			<table class="table table-bordered">
				<tr>
					<td><b>Program</b></td>
					<td><?= isset($emonev_program['program']) ? $emonev_program['program'] : ''; ?></td>
				</tr>
				<tr>
					<td><b>Kegiatan</b></td>
					<td><?= isset($emonev_program['kegiatan']) ?  $emonev_program['kegiatan'] : ''; ?></td>
				</tr>
				<tr>
					<td><b>Sub Kegiatan</b></td>
					<td><?= isset($emonev_program['sub_kegiatan']) ?  $emonev_program['sub_kegiatan'] : ''; ?></td>
				</tr>
				<tr>
					<td><b>Bulan</b></td>
					<td><?= isset($bulan) ?  $bulan : ''; ?></td>
				</tr>
			</table><br>
		</div>
	</div>
	<form action="<?= base_url('/user/emonev/emonev/progres_indikator_update') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col">
				<table id="example1" class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 30%;">Indikator</th>
							<th style="width: 10%;">Satuan</th>
							<th style="width: 10%">Target</th>
							<th style="width: 20%;">Realisasi</th>
							<th style="width: 10%;">Jenis</th>
							<th style="width: 10%;">Waktu Entri</th>
							<th style="width: 10%;">Waktu Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php $tb_dpa_indikator = $db->table('tb_dpa_indikator')
							->select('tb_dpa_indikator.*')
							->select('tb_satuan.satuan')
							->select('tb_emonev_progres_indikator.realisasi_dpa_indikator')
							->select('tb_emonev_progres_indikator.id_emonev_progres_indikator')
							->select('tb_emonev_progres_indikator.created_at')
							->select('tb_emonev_progres_indikator.updated_at')
							->join('tb_emonev_progres_indikator', 'tb_dpa_indikator.id_dpa_indikator = tb_emonev_progres_indikator.dpa_indikator_id', 'left')
							->join('tb_satuan', 'tb_dpa_indikator.satuan_id = tb_satuan.id_satuan', 'left')
							->getWhere(['tb_dpa_indikator.dpa_id' => $dpa_id, 'tb_emonev_progres_indikator.bulan' => $b, 'tb_dpa_indikator.tahun' => $_SESSION['tahun']])->getResultArray();
						foreach ($tb_dpa_indikator as $row) :
						?>
							<tr>
								<td class="align-baseline"><?= $row['indikator']; ?></td>
								<td class="align-baseline"><?= $row['satuan']; ?></td>
								<td class="align-baseline"><?= $row['target_akhir']; ?></td>
								<td class="align-center">
									<!-- <input type="hidden" name="id_dpa_indikator[]" value="<?= $row['id_dpa_indikator']; ?>"> -->
									<!-- <input type="hidden" name="bulan" value="<?= $b; ?>"> -->
									<!-- <input type="hidden" name="bulan1" value="<?= $bulan; ?>"> -->
									<input type="hidden" name="dpa_id" value="<?= $dpa_id; ?>">
									<input type="hidden" name="id_emonev_progres_indikator[]" value="<?= $row['id_emonev_progres_indikator']; ?>">
									<input type="text" name="realisasi[]" value="<?= $row['realisasi_dpa_indikator']; ?>" class="form-control" maxlength="20">
								</td>
								<td class="align-baseline text-center"><?= $row['type']; ?></td>
								<td class="align-baseline text-center"><?= $row['created_at']; ?></td>
								<td class="align-baseline text-center"><?= $row['updated_at']; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
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
			"info": false,
			"searching": false,
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