<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<th class="col-md-6">Kegiatan / Sub Kegiatan</th>
			<th style="width:30px;" rowspan="3">&nbsp;</th>
			<th class="col-md-6">Keluaran (indikator sub kegiatan)</th>
		</tr>
		<tr>
			<td><b>[KEGIATAN]</b> <?= $DT['rkpd_kegiatan_n']; ?></td>
			<td rowspan="2" class="align-top">
				<div style="display: inline-flex;">
					<li></li>
					<div><?= ' ' . $DT['rkpd_indikator_kegiatan_sub'] . ': ' . $DT['t_tahun'] . ' ' . $DT['satuan']; ?></div>
				</div><br>
				<div style="display: inline-flex;">
					<li></li>
					<div>Rp. <?= number_format($DT['rp_tahun'], 2, ',', '.'); ?></div>
				</div><br>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:40px;">
					<b>[SUB KEGIATAN]</b> <?= $DT['rkpd_kegiatan_sub_n']; ?>
				</div>
			</td>
		</tr>
	</table><br>
	<p>&nbsp;</p>
	<form action="<?= base_url('/user/simonela/simonela/dokumen_create'); ?>" method="POST" enctype="multipart/form-data">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $DT['id_ropk_keuangan_rkpd_kegiatan_sub']; ?>">
		<input type="hidden" name="bulan" value="<?= $b; ?>">
		<input type="hidden" name="kegiatan" value="<?= $DT['rkpd_kegiatan_n']; ?>">
		<input type="hidden" name="kegiatan_sub" value="<?= $DT['rkpd_kegiatan_sub_n']; ?>">
		<input type="hidden" name="indikator_kegiatan_sub" value="<?= $DT['rkpd_indikator_kegiatan_sub']; ?>">
		<div class="row">
			<div class="col-12">
				<label>Keterangan</label>
				<div class="form-group">
					<input type="text" name="keterangan" class="form-control" maxlength="255" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-5">
				<label>Nama Dokumen</label>
				<div class="form-group">
					<input type="text" name="nama" class="form-control" maxlength="100" required>
				</div>
			</div>
			<div class="col-5">
				<label>Dokumen</label>
				<div class="form-group" style="overflow: hidden;">
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="file" class="custom-file-input" id="file" required accept=".Pdf, .pdf, .doc, .docx, .Doc, .Docx, .xls, .xlsx, .Xlsx, .Xls" /></p>
							<label class="custom-file-label">Pilih dokumen [xls, xlsx]</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2">
				<label>&nbsp;</label>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" style="width: 100%;">Upload Dokumen</button>
				</div>
			</div>
		</div>
	</form>
	<p>&nbsp;</p>
	<div class="row">
		<table id="example1" class="table table-bordered">
			<thead>
				<tr>
					<th>Keteranga Dokumen</th>
					<th style="width:600px;">Dokumen</th>
					<th class="text-center" width="60px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $querz = $db->table('tb_simonela_progres_dokumen')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => $b
					])->getResultArray();
				foreach ($querz as $rom) : ?>
					<tr>
						<td><?= $rom['keterangan']; ?></td>
						<td class="align-top">
							<a href="<?= base_url('/user/simonela/simonela/download/' . $rom['id_simonela_progres_berkas']); ?>"> <?= substr($rom['dokumen'], 0, 50); ?> </a><?= '... (' . formatBytes2($rom['size']) . 'b)'; ?>
						</td>
						<td class="text-center align-top">
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/simonela/simonela/dokumen_hapus/' . $rom['id_simonela_progres_berkas']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<script>
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	$(".file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".file-label").addClass("selected").html(fileName);
	});
</script>
<?= $this->endSection(); ?>