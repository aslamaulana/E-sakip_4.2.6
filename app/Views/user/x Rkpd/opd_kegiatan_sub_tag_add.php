<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/rkpd/opd_kegiatan_sub_tag/opd_kegiatan_sub_tag_create') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="rkpd_kegiatan_sub" value="<?= $_GET['s']; ?>">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<?php foreach ($tag as $row) : ?>
						<tr>
							<td style="width:30px;"><input type="checkbox" name="tag[]" value="<?= $row['tag']; ?>"></td>
							<td style="width:250px;"><?= $row['tag']; ?></td>
							<td><?= $row['keterangan']; ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>