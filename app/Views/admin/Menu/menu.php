<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th style="width:30px;">No</th>
				<th>Menu</th>
				<th>Kunci</th>
				<th style="width:540px;">Timer</th>
				<th style="width:20px;">Timer</th>
				<th style="width:30px;text-align: center;"> </th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor = 1;
			foreach ($menu as $row) : ?>
				<tr>
					<form action="<?= base_url('/admin/menu/menu/create') ?>" method="POST">
						<input type="hidden" name="id" value="<?= $row['id_menu']; ?>">
						<td><?= $nomor++; ?></td>
						<td><?= $row['name']; ?></td>
						<td>
							<select name="kunci" class="form-control">
								<option value="<?= $row['kunci']; ?>"><?= $row['kunci']; ?></option>
								<option value="<?= $row['kunci'] == 'ya' ? 'tidak' : 'ya'; ?>"><?= $row['kunci'] == 'ya' ? 'tidak' : 'ya'; ?></option>
							</select>
						</td>
						<td>
							<?php if ($row['timer_a'] != 'aktif') { ?>
								<div class="row" style="text-align: center;">
									<div class="col-sm-3">
										<select name="bulan" class="form-control">
											<option value="Jan">Januari</option>
											<option value="Feb">Februari</option>
											<option value="Mar">Maret</option>
											<option value="Apr">April</option>
											<option value="May">Mei</option>
											<option value="Jun">Juni</option>
											<option value="Jul">Juli</option>
											<option value="Aug">Agustus</option>
											<option value="Sep">September</option>
											<option value="Oct">Oktober</option>
											<option value="Nov">November</option>
											<option value="Dec">Desember</option>
										</select>
									</div>
									<div class="col-sm-2"><input type="number" name="hari" max="31" min="1" class="form-control" step="1" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;" /></div>
									<div class="col-sm-2"><input type="number" name="tahun" max="2025" min="2022" class="form-control"></div> |
									<div class="col-sm-2"><input type="number" name="jam" max="23" min="1" class="form-control" step="1" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;" /></div>
									<div class="col-sm-2"><input type="number" name="menit" max="59" min="0" class="form-control" step="1" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;" /></div>
								</div>
							<?php } else { ?>
								<?= $row['timer']; ?>
							<?php } ?>
						</td>
						<td style=" text-align: center;">
							<input type="checkbox" name="timer_a" class="form-control" value="aktif" <?= $row['timer_a'] == "aktif" ? 'checked' : ''; ?>>
						</td>
						<td style=" text-align: center;">
							<button type="submit" class="btn-sm btn-primary">Simpan</button>
						</td>
					</form>
				</tr>

			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>