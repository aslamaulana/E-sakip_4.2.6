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
	<div class="row">
		<div class="col-md-12 text-center">
			<h3> Tambah Data Sasaran</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">
			<div class="form-group">
				<label>Tahap 1 -> </label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Download Format Excel</label>
			</div>
		</div>
		<div class="col-md-8">
			<div class="input-group">
				<a href="<?= base_url('/user/renstra/opd_program_sasaran/export'); ?>">
					<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Format</li>
				</a>
			</div>
		</div>
	</div>
	<form action="<?= base_url('/user/renstra/opd_program_sasaran/simpanExcel') ?>" method="POST" enctype="multipart/form-data">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label>Tahap 2 -> </label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Upload File Excel</label>
				</div>
			</div>
			<div class="col-md-8">
				<div class="input-group">
					<div class="custom-file">
						<input type="file" name="fileexcel" class="custom-file-input" id="file" required accept=".xls, .xlsx, .Xlsx, .Xls" /></p>
						<label class="custom-file-label">Pilih dokumen [xls, xlsx]</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Upload</button>
		</div>
	</form>
</div>
<div class="card-body">
	<div class="row">
		<div class="col-md-12 text-center">
			<h3> Ubah Data Sasaran</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">
			<div class="form-group">
				<label>Tahap 1 -> </label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Download Format Excel</label>
			</div>
		</div>
		<div class="col-md-8">
			<div class="input-group">
				<a href="<?= base_url('/user/renstra/opd_program_sasaran/export_edit'); ?>">
					<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Format</li>
				</a>
			</div>
		</div>
	</div>
	<form action="<?= base_url('/user/renstra/opd_program_sasaran/simpanExcel_edit') ?>" method="POST" enctype="multipart/form-data">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label>Tahap 2 -> </label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Upload File Excel</label>
				</div>
			</div>
			<div class="col-md-8">
				<div class="input-group">
					<div class="custom-file">
						<input type="file" name="fileexcel" class="custom-file-input" id="file" required accept=".xls, .xlsx, .Xlsx, .Xls" /></p>
						<label class="custom-file-label">Pilih dokumen [xls, xlsx]</label>
					</div>
				</div>
			</div>
		</div>
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
</script>
<?= $this->endSection(); ?>