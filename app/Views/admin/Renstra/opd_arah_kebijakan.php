<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col-md">
			<select class="form-control" onchange="location = this.value;">
				<?php foreach ($opd as $row) : ?>
					<option <?= $_SESSION['opd_set'] == $row['id'] ? 'selected' : ''; ?> value="<?= base_url('/admin/renstra/opd_arah_kebijakan/opd/' . $row['id']); ?>"><?= $row['description']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div><br>
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th>Strategi / Arah Kebijakan</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Strategi / Arah Kebijakan</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($opd_strategi as $row) : ?>
				<tr style="background-color: blanchedalmond;">
					<td class="align-top font-weight-bold">[STRATEGI] <?= $row['opd_strategi']; ?></td>
				</tr>
				<?php $querz = $db->table('tb_renstra_arah_kebijakan')->getWhere(['opd_strategi_n' => $row['opd_strategi'], 'perubahan' => $_SESSION['perubahan'], 'opd_id' => $_SESSION['opd_set']])->getResultArray();
				foreach ($querz as $rol) : ?>
					<tr>
						<td>
							<div style="padding-left: 40px;"><?= $rol['opd_arah_kebijakan']; ?></div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
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
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"paging": false,
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