<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div>
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/renstra/opd_error_fix/simpanExcel_edit') ?>" method="POST" enctype="multipart/form-data">
		<?= csrf_field() ?>
		<table class="table table-bordered">
			<tr>
				<td colspan="3">Renstra Sub Kegiatan<br>
					"Dalam proses pengisian renstra sub kegiatan ke aplikasi, ada kemungkinan anda akan mengalami error data (Whoops!), error data ini kemungkinan besar di sebabkan kesalahan pengisian data pagu di Renstra Sub Kegiatan.
					Data Pagu Renstra Sub Kegiatan harus berupa angka (0-9) dan harus di perhatikan juga kemungkinan terbawanya (space) dan simbol lain yang dapat mengakibatkan error"<br><br>
					Cara yang dapat dilakukan jika terjadi error (Whoops!):<br>
					1. Backup Data (Jika anda tidak memiliki data asli berupa excel ada baiknya anda membackupnya terlebih dahulu -> Tahap 1).<br>
					2. Kosongkan Data (Tahap 2).<br>
					3. Perbaiki data Excel jika anda menggunakan file excel untuk mengisi data dan Upload Kembali.
				</td>
			</tr>
			<tr>
				<td style="width:120px;">Tahap 1 -> </td>
				<td style="width:220px;">Backup Data</td>
				<td>
					<div class="input-group">
						<a href="<?= base_url('/user/renstra/opd_error_fix/export_edit'); ?>">
							<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Format</li>
						</a>
					</div>
				</td>
			</tr>
			<tr>
				<td>Tahap 2 -> </td>
				<td>Upload File Excel</td>
				<td>
					<?php if (menu('renstra')->kunci == 'tidak') { ?>
						<a class="btn btn-danger btn-circle btn-md" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_error_fix/hapusAll'; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"> Kosongkan Data</i>
						</a>
					<?php } else { ?>
						<div style="width:78px;">
							<a href="#">
								<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-lock"></i></li>
							</a>
						</div>
					<?php } ?>
				</td>
			</tr>
		</table>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Upload</button>
		</div>
	</form>
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