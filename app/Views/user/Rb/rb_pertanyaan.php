<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display table-sm">
		<thead>
			<tr>
				<th>
					<div style="width: 850px;">Komponen / Sub Komponen / Kriteria</div>
				</th>
				<th class="text-center">
					<div style="width: 80px;">Jawaban</div>
				</th>
				<th class="text-center">
					<div style="width: 400px;">Keterangan</div>
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
					<div style="width: 130px;">detail/Log</div>
				</th>
				<th class="text-center">
					<div style="width: 160px;">Aksi</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rb_urusan as $rom) : ?>
				<tr style="background: #666699;" class="font-weight-bold">
					<td class="text-wrap"><?= $rom['rb_urusan']; ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$rb_tahap = $db->table('tb_rb_2_tahap')->getWhere(['rb_urusan_id' => $rom['id_rb_urusan']])->getResultArray();
				foreach ($rb_tahap as $ron) :
				?>
					<tr style="background: #c0c0c0;" class="font-weight-bold">
						<td class="text-wrap">
							<div style="padding-left: 20px;"><?= $ron['rb_tahap']; ?></div>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php
					$rb_komponen = $db->table('tb_rb_3_komponen')->getWhere(['rb_tahap_id' => $ron['id_rb_tahap']])->getResultArray();
					foreach ($rb_komponen as $roo) :
					?>
						<tr style="background: #c0c0c0;" class="font-weight-bold">
							<td class="text-wrap">
								<div style="padding-left: 40px;"><?= $roo['rb_komponen']; ?></div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
						$rb_komponen_sub = $db->table('tb_rb_4_komponen_sub')->getWhere(['rb_komponen_id' => $roo['id_rb_komponen']])->getResultArray();
						foreach ($rb_komponen_sub as $rop) :
						?>
							<tr style="background: #ffffcc;" class="font-weight-bold">
								<td class="text-wrap">
									<div style="padding-left: 60px;"><?= $rop['rb_komponen_sub']; ?></div>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<?php
							$rb_pertanyaan = $db->table('tb_rb_5_pertanyaan')->getWhere(['rb_komponen_sub_id' => $rop['id_rb_komponen_sub']])->getResultArray();
							foreach ($rb_pertanyaan as $roq) :
							?>
								<tr>
									<td class="text-wrap text-justify">
										<div style="padding-left: 80px;"><?= $roq['pertanyaan']; ?></div>
									</td>
									<!-- ------------------------------------------------------ -->
									<?php
									$j = $db->table('tb_rb_5_pertanyaan_jawaban')
										->select('tb_rb_5_pertanyaan_jawaban.*, tb_rb_5_pertanyaan_jawaban_verifikasi.verifikasi_keterangan')
										->orderBy('id_rb_pertanyaan_jawaban', 'DESC')
										->join('tb_rb_5_pertanyaan_jawaban_verifikasi', 'tb_rb_5_pertanyaan_jawaban.id_rb_pertanyaan_jawaban = tb_rb_5_pertanyaan_jawaban_verifikasi.rb_pertanyaan_jawaban_id', 'LEFT')
										->getWhere([
											'rb_pertanyaan_id' => $roq['id_rb_pertanyaan'],
											'tb_rb_5_pertanyaan_jawaban.opd_id' => user()->opd_id,
											'tb_rb_5_pertanyaan_jawaban.tahun' => $_SESSION['tahun']
										])->getRowArray();
									$id_jawaban = isset($j['id_rb_pertanyaan_jawaban']) ? $j['id_rb_pertanyaan_jawaban'] : '';
									?>
									<!-- ------------------------------------------------------ -->
									<td class="text-wrap text-center"><?= isset($j['jawaban']) ? $j['jawaban'] : ''; ?></td>
									<td class="text-wrap"><?= isset($j['link_keterangan']) ? $j['link_keterangan'] : ''; ?></td>
									<td class="text-center"><?= isset($j['nilai']) ? $j['nilai'] : ''; ?></td>
									<td><?= isset($j['verifikasi_keterangan']) ? $j['verifikasi_keterangan'] : ''; ?></td>
									<td class="text-wrap text-center">
										<?= isset($j['link_1']) && $j['link_1'] != '' ? '<a href="' . $j['link_1'] . '" target="blink">Link 1</a> <i class="nav-icon fa fa-link"></i>' . '<br>' : ''; ?>
										<?= isset($j['link_2']) && $j['link_2'] != '' ? '<a href="' . $j['link_2'] . '" target="blink">Link 2</a> <i class="nav-icon fa fa-link"></i>' . '<br>' : ''; ?>
										<?= isset($j['link_3']) && $j['link_3'] != '' ? '<a href="' . $j['link_3'] . '" target="blink">Link 3</a> <i class="nav-icon fa fa-link"></i>' : ''; ?>
									</td>
									<td class="text-center align-baseline">
										<a class="btn btn-success btn-circle btn-xs" href="<?= base_url() . '/user/rb/rb_pertanyaan/rb_pertanyaan_detail/' . $roq['id_rb_pertanyaan'] . '/' . $id_jawaban; ?>">
											<i class="nav-icon fas fa-search"></i>
										</a>
										<a class="btn btn-info btn-xs" href="<?= base_url() . '/user/rb/rb_pertanyaan/rb_pertanyaan_history/' . $roq['id_rb_pertanyaan']; ?>">
											<i class="nav-icon fa fa-history"></i> History
										</a>
									</td>
									<!-- ---------------------------------------------------------------------------------------------------------------------- -->
									<td class="text-center align-baseline">
										<div class="justify-content-center">
											<?php $jawab = $db->table('tb_rb_5_pertanyaan_jawaban_verifikasi')
												->join('auth_groups', 'tb_rb_5_pertanyaan_jawaban_verifikasi.opd_id = auth_groups.id', 'left')
												->getWhere(['rb_pertanyaan_jawaban_id' => $id_jawaban])->getRow();
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
													<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/rb/rb_pertanyaan/rb_pertanyaan_add/' . $roq['id_rb_pertanyaan']; ?>">
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
													<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/rb/rb_pertanyaan/rb_pertanyaan_edit/' . $roq['id_rb_pertanyaan'] . '/' . $id_jawaban; ?>">
														<i class="nav-icon fas fa-pen-alt"></i>
													</a>
													<!-- <a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/rb/rb_pertanyaan/rb_pertanyaan_hapus/' . $id_jawaban; ?>'}" href="#">
														<i class="nav-icon fas fa-trash-alt"></i>
													</a> -->
													<!-- ------------------------------------------------------------------------------------------- -->
													<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/rb/rb_pertanyaan/rb_pertanyaan_verifikasi/' . $jawab->id_rb_pertanyaan_jawaban_verifikasi; ?>'}">
														Ajukan Verifikasi
													</a>
												<?php endif; ?>
											<?php else : ?>
												<!-- ------------------------------------------------------------------------------------ -->
												<a href="<?= base_url('/user/rb/rb_pertanyaan/rb_pertanyaan_add/' . $roq['id_rb_pertanyaan']); ?>">
													<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-pen-alt"></i> Jawab</li>
												</a>
											<?php endif; ?>
											<!-- ------------------------------------------------------------------------------------------- -->
										</div>
									</td>
									<!-- ---------------------------------------------------------------------------------------------------------------------- -->
								</tr>
							<?php endforeach; ?>
						<?php endforeach; ?>
					<?php endforeach; ?>
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
				[40, 60, 100, -1],
				[40, 60, 100, 'All']
			],
		});
	});
</script>
<?= $this->endSection(); ?>