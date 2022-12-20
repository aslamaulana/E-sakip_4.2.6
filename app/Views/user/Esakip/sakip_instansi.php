<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th>
					<div style="width: 550px;">Komponen / Sub Komponen / Kriteria</div>
				</th>
				<th></th>
				<th></th>
				<th class="text-center">
					<div style="width: 400px;">Jawaban</div>
				</th>
				<th class="text-center">
					<div style="width: 80px;">Nilai</div>
				</th>
				<th class="text-center">
					<div style="width: 250px;">Catatan</div>
				</th>
				<th class="text-center">
					<div style="width: 130px;">Daftar Evidence</div>
				</th>
				<th class="text-center">
					<div style="width: 80px;">Log</div>
				</th>
				<th class="text-center">
					<div style="width: 100px;">Aksi</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($sakip as $rom) : ?>
				<tr>
					<td class="text-wrap">
						<div style="padding-left: 60px;"><?= $rom['kriteria']; ?></div>
					</td>
					<!-- ------------------------------------------------------ -->
					<td>[Sub Komponen] <?= $rom['komponen_sub']; ?></td>
					<td>[Komponen] <?= $rom['komponen']; ?></td>
					<!-- ------------------------------------------------------ -->
					<?php
					$j = $db->table('tb_sakip_instansi_jawaban')
						->select('tb_sakip_instansi_jawaban.*, tb_sakip_instansi_jawaban_verifikasi.verifikasi_keterangan')
						->orderBy('id_sakip_instansi_jawaban', 'DESC')
						->join('tb_sakip_instansi_jawaban_verifikasi', 'tb_sakip_instansi_jawaban.id_sakip_instansi_jawaban = tb_sakip_instansi_jawaban_verifikasi.sakip_instansi_jawaban_id', 'LEFT')
						->getWhere([
							'sakip_instansi_id' => $rom['id_sakip_instansi'],
							'tb_sakip_instansi_jawaban.opd_id' => user()->opd_id,
							'tb_sakip_instansi_jawaban.tahun' => $_SESSION['tahun']
						])->getRowArray();
					$id_jawaban = isset($j['id_sakip_instansi_jawaban']) ? $j['id_sakip_instansi_jawaban'] : '';
					?>

					<td class="text-wrap"><?= isset($j['jawaban']) ? $j['jawaban'] : ''; ?></td>
					<td class="text-center"><?= isset($j['nilai']) ? $j['nilai'] : ''; ?></td>
					<td><?= isset($j['verifikasi_keterangan']) ? $j['verifikasi_keterangan'] : ''; ?></td>
					<td class="text-wrap text-center">
						<?= isset($j['link_1']) && $j['link_1'] != '' ? '<a href="' . $j['link_1'] . '" target="blink">Link 1</a> <i class="nav-icon fa fa-link"></i>' . '<br>' : ''; ?>
						<?= isset($j['link_2']) && $j['link_2'] != '' ? '<a href="' . $j['link_2'] . '" target="blink">Link 2</a> <i class="nav-icon fa fa-link"></i>' . '<br>' : ''; ?>
						<?= isset($j['link_3']) && $j['link_3'] != '' ? '<a href="' . $j['link_3'] . '" target="blink">Link 3</a> <i class="nav-icon fa fa-link"></i>' : ''; ?>
					</td>
					<td>
						<a href="<?= base_url() . '/user/esakip/sakip_instansi/sakip_instansi_history/' . $rom['id_sakip_instansi']; ?>">
							<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-history"></i> History</li>
						</a>
					</td>
					<!-- ---------------------------------------------------------------------------------------------------------------------- -->
					<td class="text-center align-baseline">
						<div class="justify-content-center">
							<?php $jawab = $db->table('tb_sakip_instansi_jawaban_verifikasi')
								->join('auth_groups', 'tb_sakip_instansi_jawaban_verifikasi.opd_id = auth_groups.id', 'left')
								->getWhere(['sakip_instansi_jawaban_id' => $id_jawaban])->getRow();
							if (isset($jawab)) : ?>
								<?php if ($jawab->verifikasi == 'lolos') : ?>
									<a class="dropdown-toggle btn btn-success btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 151px;">
										<i class="nav-icon fa fa-thumbs-up"></i> Lolos Verifikasi
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'dikembalikan') : ?>
									<!-- --------------------------------------------------------------------- -->
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/esakip/sakip_instansi/sakip_instansi_add/' . $rom['id_sakip_instansi']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<!-- --------------------------------------------------------------------- -->
									<a class="dropdown-toggle btn btn-danger btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:125px;">
										<i class="nav-icon fa fa-undo"></i> Dikembalikan
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 151px;">
										Menunggu Verifikasi
									</a>
								<?php elseif ($jawab->verifikasi == 'jawab') : ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/esakip/sakip_instansi/sakip_instansi_edit/' . $rom['id_sakip_instansi'] . '/' . $id_jawaban; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/esakip/sakip_instansi/sakip_instansi_hapus/' . $id_jawaban; ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
									<!-- ------------------------------------------------------------------------------------------- -->
									<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/esakip/sakip_instansi/sakip_instansi_verifikasi/' . $jawab->id_sakip_instansi_jawaban_verifikasi; ?>'}">
										Ajukan Verifikasi
									</a>
								<?php endif; ?>
							<?php else : ?>
								<!-- ------------------------------------------------------------------------------------ -->
								<a href="<?= base_url('/user/esakip/sakip_instansi/sakip_instansi_add/' . $rom['id_sakip_instansi']); ?>">
									<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-pen-alt"></i> Jawab</li>
								</a>
							<?php endif; ?>
							<!-- ------------------------------------------------------------------------------------------- -->
						</div>
					</td>
					<!-- ---------------------------------------------------------------------------------------------------------------------- -->
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') ?>"></script>

<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				targets: [1, 2]
			}],
			order: [
				[2, 'asc'],
				[1, 'asc']
			],
			rowGroup: {

				startRender: function(rows, group) {
					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td colspan="7" class="align-top text-wrap font-weight-bold">' + group + '</td>');
					} else if (rows.data().pluck(1)[0] == group) {
						return $('<tr class="font-weight-bold" style="background: azure;" />')
							.append('<td colspan="7" class="align-top text-wrap"><div style="padding-left: 40px;">' + group + '</div></td>');
					}
				},
				dataSrc: [2, 1]
			}
		});
	});
</script>
<?= $this->endSection(); ?>