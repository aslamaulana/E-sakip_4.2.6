<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/user/rkpd/opd_kegiatan_sub_tag/opd_kegiatan_sub_tag_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="rkpd_kegiatan_sub" value="<?= $_GET['s']; ?>">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<?php foreach ($tag as $row) : ?>
						<tr>
							<?php $tag = $db->table('tb_rkpd_kegiatan_sub_tag')->getWhere(['rkpd_kegiatan_sub_n' =>  $_GET['s'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tag' => $row['tag']])->getRow(); ?>
							<td style="width:30px;"><input type="checkbox" name="tag[]" value="<?= $row['tag']; ?>" <?= isset($tag->tag) == $row['tag'] ? 'checked' : ''; ?>></td>
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