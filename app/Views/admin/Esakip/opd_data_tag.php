<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/esakip/opd_data/tag_create') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $tag['id_sakip_opd']; ?>">
		<input type="hidden" name="opd_id" value="<?= $tag['opd_id']; ?>">
		<div class="row">
			<div class="col-md-6">
				<table class="table table-bordered">
					<tr>
						<td style="width:30px;"><input type="checkbox" name="unit_utama" value="ya" <?= $tag['unit_utama'] == 'ya' ? 'checked' : ''; ?>></td>
						<td style="width:250px;">Utama</td>
						<td>Unit Utama</td>
					</tr>
					<tr>
						<td style="width:30px;"><input type="checkbox" name="unit_pendukung" value="ya" <?= $tag['unit_pendukung'] == 'ya' ? 'checked' : ''; ?>></td>
						<td style="width:250px;">Pendukung</td>
						<td>Unit Pendukung</td>
					</tr>
					<tr>
						<td style="width:30px;"><input type="checkbox" name="unit_tambahan" value="ya" <?= $tag['unit_tambahan'] == 'ya' ? 'checked' : ''; ?>></td>
						<td style="width:250px;">Tambahan</td>
						<td>Unit Tambahan</td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table class="table table-bordered">
					<tr>
						<td style="width:30px;"><input type="checkbox" name="sempel" value="ya" <?= $tag['sempel'] == 'ya' ? 'checked' : ''; ?>></td>
						<td style="width:250px;">Sample</td>
						<td>SKPD Sample</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>