<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content">

	<div class="card shadow <?= !isset($_SESSION['max']) ? '' : $_SESSION['max']; ?>">
		<div class="card-header">
			<div class="row mb-0" style="height: 24px;">
				<fount style="color: gray;"><b>Home</b> -> <?= $lok; ?></fount>
			</div>
		</div>
		<div class="card-header" style="background: #343a40;">
			<!-- <h5 class="card-title">Shadow - Regular</h5> -->
			<div class="card-tools">
				<a type="button" class="btn btn-tool btn-xs" onclick="location.href = '<?= isset($_SESSION['max']) ? base_url('/home/max/min') : base_url('/home/max/max'); ?>'">
					<i class="fas fa-expand"></i>
				</a>
				<button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool btn-xs" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<table id="example1" class="table table-bordered">
				<thead>
					<tr>
						<th style="text-align: center;" width="30px">No</th>
						<th>Indikator / Pertanyaan</th>
						<th style="text-align: center;" width="40px">Ada</th>
						<th style="text-align: center;" width="40px">Tidak</th>
						<th style="text-align: center;" width="60px">Lampiran</th>
						<th style="width: 60px; text-align:center;">Aksi</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th style="text-align:center;">No</th>
						<th>Indikator / Pertanyaan</th>
						<th style="text-align: center;">Ada</th>
						<th style="text-align: center;">Tidak</th>
						<th style="text-align: center;">Lampiran</th>
						<th style="text-align:center;">Aksi</th>
					</tr>
				</tfoot>
				<tbody>
					<?php $nomor = 1;
					foreach ($indik as $row) : ?>
						<tr>
							<td style="text-align: center;"><?= $nomor++; ?></td>
							<td><b><?= $row['kla_indik']; ?></b></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php $query = $db->table('tb_kla_pertanyaan')
							->select('tb_kla_pertanyaan.id_kla_pertanyaan')
							->select('tb_kla_pertanyaan.kla_indik_id')
							->select('tb_kla_pertanyaan.kla_pertanyaan')
							->getWhere(['tb_kla_pertanyaan.kla_indik_id' => $row['id_kla_indik']])->getResultArray();

						foreach ($query as $ros) : ?>
							<tr>
								<td></td>
								<td style="padding-left: 20px;"><?= $ros['kla_pertanyaan']; ?></td>
								<?php $jawab = $db->table('tb_kla_jawaban')->select('tb_kla_jawaban.*')->getWhere(['kla_pertanyaan_id' => $ros['id_kla_pertanyaan'], 'tb_kla_jawaban.opd_id' => user()->opd_id])->getRow();
								if (isset($jawab)) :
								?>
									<td style="text-align: center;"><?= $jawab->kla_jawaban == 'YA' ? '<span>&#10003;</span>' : ''; ?></td>
									<td style="text-align: center;"><?= $jawab->kla_jawaban == 'TIDAK' ? '<span>&#10003;</span>' : ''; ?></td>
									<td style="text-align: center;">
										<a target="_BLANK" href="<?= base_url() . '/FileBerkasData/' . $jawab->opd_id . '/KLA/' . $jawab->kla_jawaban_doc;  ?>"><?= $jawab->kla_jawaban_doc != '' ? '<i class="fa fa-paperclip" aria-hidden="true"></i>' : ''; ?></a>
										<small><?= $jawab->kla_jawaban_doc_size != '0' ? formatBytes2($jawab->kla_jawaban_doc_size) : ''; ?></small>
									</td>
									<td style="text-align: center;">
										<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/kla/pertanyaan/jawaban_edit/' . $jawab->id_kla_jawaban . '?p=' . $ros['kla_pertanyaan']; ?>">
											<i class="nav-icon fas fa-pen-alt"></i>
										</a>
										<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/kla/pertanyaan/jawaban_hapus/' . $jawab->id_kla_jawaban; ?>'}" href="#">
											<i class="nav-icon fas fa-trash-alt"></i>
										</a>
									</td>
								<?php else : ?>
									<td></td>
									<td></td>
									<td></td>
									<td style="text-align: center;">
										<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/kla/pertanyaan/jawaban/' . $ros['id_kla_pertanyaan'] . '?p=' . $ros['kla_pertanyaan']; ?>">
											<i class="nav-icon fas fa-pen-alt"></i>
										</a>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>

<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
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