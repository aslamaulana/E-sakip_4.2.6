<?= $this->extend('_layout/template'); ?>

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
		<div class="card-body row">
			<div class="col-md">
				<h5><?= $_GET['p']; ?></h5>
			</div>
		</div>
		<div class="card-body">
			<form action="<?= base_url('/user/kla/pertanyaan/jawaban_create') ?>" method="POST" enctype="multipart/form-data">
				<?= csrf_field() ?>
				<input type="hidden" name="id_kla_pertanyaan" value="<?= $id; ?>">
				<input type="hidden" name="p" value="<?= $_GET['p']; ?>">
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label>Jawaban</label>
						</div>
					</div>
					<div class="col-md-10">
						<div class="input-group">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="jawaban" id="inlineRadio1" value="YA">
								<label class="form-check-label" for="inlineRadio1">Ada</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="jawaban" id="inlineRadio2" value="TIDAK">
								<label class="form-check-label" for="inlineRadio2">Tidak</label>
							</div>

						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label>Dokumen</label>
						</div>
					</div>
					<div class="col-md-10">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="jawaban_doc" class="custom-file-input <?= ($validation->hasError('file')) ? 'is-invalid' : ''; ?>">
								<label class="custom-file-label">Pilih dokumen</label>
							</div>
						</div>
						<div class="invalid-feedback">
							<?= $validation->getError('jawaban_doc'); ?>
						</div>
						<small class="text-danger">Dokumen surat, bisa berupa doc, docx, pdf. Max 10Mb</small>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</section>
<?= $this->endSection(); ?>
<?= $this->section('Javascript'); ?>
<script>
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
<?= $this->endSection(); ?>