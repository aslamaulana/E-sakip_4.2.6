<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered table-sm">
		<tr style="background: #666699;" class="font-weight-bold">
			<td><b> <?= $pertanyaan['rb_urusan']; ?></td>
		</tr>
		<tr style="background: #c0c0c0;" class="font-weight-bold">
			<td>
				<div style="padding-left:20px;">
					<?= $pertanyaan['rb_tahap']; ?>
				</div>
			</td>
		</tr>
		<tr style="background: #c0c0c0;" class="font-weight-bold">
			<td>
				<div style="padding-left:40px;">
					<?= $pertanyaan['rb_komponen']; ?>
				</div>
			</td>
		</tr>
		<tr style="background: #ffffcc;" class="font-weight-bold">
			<td>
				<div style="padding-left:60px;">
					<?= $pertanyaan['rb_komponen_sub']; ?>
				</div>
			</td>
		</tr>

	</table><br><br>
	<form action="<?= base_url('/user/rb/rb_pertanyaan/rb_pertanyaan_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $pertanyaan['id_rb_pertanyaan']; ?>">
		<table id="example1" class="table table-bordered table-sm">
			<thead>
				<tr>
					<th class="text-center align-middle">
						<div style="width: 700px;">Pertanyaan</div>
					</th>
					<th class="text-center align-middle">
						<div style="width: 700px;">Penjelasan</div>
					</th>
					<th class="text-center align-middle">
						<div style="width: 80px;">Pilihan Jawaban</div>
					</th>
					<th class="text-center align-middle">
						<div style="width: 100px;">Jawaban</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-wrap"> <?= $pertanyaan['pertanyaan']; ?> </td>
					<td><?= $pertanyaan['penjelasan']; ?></td>
					<td class="text-center"><?= $pertanyaan['pilihan_jawaban']; ?></td>
					<td>
						<input type="text" value="<?= $jawaban['jawaban']; ?>" class="form-control" style="height:30px;" name="jawaban_pertanyaan" maxlength="10">
						<input type="hidden" name="id_rb_pertanyaan_jawaban" value="<?= $jawaban['id_rb_pertanyaan_jawaban']; ?>">
					</td>
				</tr>
				<?php
				$rb_pertanyaan_sub = $db->table('tb_rb_6_pertanyaan_sub')->getWhere(['rb_pertanyaan_id' => $pertanyaan['id_rb_pertanyaan']])->getResultArray();
				foreach ($rb_pertanyaan_sub as $rop) :
				?>
					<tr>
						<td class="text-wrap">
							<div style="padding-left: 20px;"><?= $rop['pertanyaan_sub']; ?></div>
						</td>
						<td><?= $rop['penjelasan_sub']; ?></td>
						<td class="text-center"><?= $rop['pilihan_jawaban_sub']; ?></td>
						<td>
							<?php $rb_pertanyaan_jawaban_sub = $db->table('tb_rb_6_pertanyaan_sub_jawaban')->orderBy('id_rb_pertanyaan_sub_jawaban', 'DESC')->getWhere(['rb_pertanyaan_sub_id' => $rop['id_rb_pertanyaan_sub'], 'tahun' => $_SESSION['tahun'], 'opd_id' => user()->opd_id])->getRowArray(); ?>
							<input type="text" class="form-control" style="height:30px;" value="<?= $rb_pertanyaan_jawaban_sub['jawaban']; ?>" name="jawaban_pertanyaan_sub[]" maxlength="10">
							<input type="hidden" name="rb_pertanyaan_sub_id[]" value="<?= $rop['id_rb_pertanyaan_sub']; ?>">
							<input type="hidden" name="id_rb_pertanyaan_sub_jawaban[]" value="<?= $rb_pertanyaan_jawaban_sub['id_rb_pertanyaan_sub_jawaban']; ?>">
						</td>
					</tr>
					<?php
					$rb_pertanyaan_sub_sub = $db->table('tb_rb_7_pertanyaan_sub_sub')->getWhere(['rb_pertanyaan_sub_id' => $rop['id_rb_pertanyaan_sub']])->getResultArray();
					foreach ($rb_pertanyaan_sub_sub as $ros) :
					?>
						<tr>
							<td class="text-wrap">
								<div style="padding-left: 50px;"><?= $ros['pertanyaan_sub_sub']; ?></div>
							</td>
							<td><?= $ros['penjelasan_sub_sub']; ?></td>
							<td class="text-center"><?= $ros['pilihan_jawaban_sub_sub']; ?></td>
							<td>
								<?php $rb_pertanyaan_jawaban_sub_sub = $db->table('tb_rb_7_pertanyaan_sub_sub_jawaban')->orderBy('id_rb_pertanyaan_sub_sub_jawaban', 'DESC')->getWhere(['rb_pertanyaan_sub_sub_id' => $ros['id_rb_pertanyaan_sub_sub'], 'tahun' => $_SESSION['tahun'], 'opd_id' => user()->opd_id])->getRowArray(); ?>
								<input type="text" class="form-control" style="height:30px;" value="<?= $rb_pertanyaan_jawaban_sub_sub['jawaban']; ?>" name="jawaban_pertanyaan_sub_sub[]" maxlength="10">
								<input type="hidden" name="rb_pertanyaan_sub_sub_id[]" value="<?= $ros['id_rb_pertanyaan_sub_sub']; ?>">
								<input type="hidden" name="id_rb_pertanyaan_sub_sub_jawaban[]" value="<?= $rb_pertanyaan_jawaban_sub_sub['id_rb_pertanyaan_sub_sub_jawaban']; ?>">
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<br>
		<br>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Keterangan <medium class="text-danger">*</medium></label>
					<textarea name="link_keterangan" class="form-control" placeholder="Keterangan" maxlength="300" rows="8" required><?= $jawaban['link_keterangan']; ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Link Evidence 1</label>
					<input type="text" class="form-control" name="e_1" value="<?= $jawaban['link_1']; ?>" maxlength="255" required>
				</div>
				<div class="form-group">
					<label>Link Evidence 2</label>
					<input type="text" class="form-control" name="e_2" value="<?= $jawaban['link_2']; ?>" maxlength="255">
				</div>
				<div class="form-group">
					<label>Link Evidence 3</label>
					<input type="text" class="form-control" name="e_3" value="<?= $jawaban['link_3']; ?>" maxlength="255">
				</div>
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
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
		$("#example2").DataTable({
			"scrollX": true,
			"scrollCollapse": true,
			"paging": false,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
		});
		$('#example1').DataTable({
			"paging": false,
			"scrollX": true,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?= $this->endSection(); ?>