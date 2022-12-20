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
	<form action="<?= base_url('/admin/rpjmd/program/simpanExcel') ?>" method="POST" enctype="multipart/form-data">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>File Excel</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="input-group">
					<div class="custom-file">
						<input type="file" name="fileexcel" class="custom-file-input" id="file" required accept=".xls, .xlsx" /></p>
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