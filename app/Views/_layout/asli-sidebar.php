<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link" style="text-align: center;">
		<div class="image">
			<img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" style="width: -webkit-fill-available;max-width: 40px;margin-left: .8rem;">
			<span class="brand-text font-weight-light" style="font-family: monospace;" title="Sistem Informasi Pengendalian dan Evaluasi Kinerja Pembangunan Daerah"> SiGenah</span>
		</div>
		<!-- <img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('/toping/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= user()->username; ?></a>
			</div>
		</div>

		<!-- SidebarSearch Form -->
		<div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item ">
					<a href="<?= base_url('/'); ?>" class="nav-link <?= $mn == 'home' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
							<!-- <i class="right fas fa-angle-left"></i> -->
						</p>
					</a>
				</li>
				<?php if (has_permission('Admin')) : ?>
					<li class="nav-item <?= $gr == 'skpd' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'skpd' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-university"></i>
							<p>
								SKPD
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/user/bidang'); ?>" class="nav-link <?= $mn == 'skpd' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small></small> SKPD</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'menu' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'menu' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Menu
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/menu/menu'); ?>" class="nav-link <?= $mn == 'menu' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small></small> Setting</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<!-- <li class="nav-header">PD</li> -->
				<?php if (has_permission('Admin')) : ?>
					<li class="nav-item <?= $gr == 'rpjmd' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'rpjmd' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								RPJMD
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/rpjmd/visi'); ?>" class="nav-link <?= $mn == 'visi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> VISI / MISI</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rpjmd/tujuan'); ?>" class="nav-link <?= $mn == 'tujuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Tujuan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rpjmd/sasaran'); ?>" class="nav-link <?= $mn == 'sasaran' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Sasaran</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rpjmd/strategi'); ?>" class="nav-link <?= $mn == 'strategi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>4. </small> Strategi</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rpjmd/arah_kebijakan'); ?>" class="nav-link <?= $mn == 'arah_kebijakan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>5. </small> Arah Kebijakan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/rpjmd/program'); ?>" class="nav-link <?= $mn == 'program' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>6. </small> Program</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<?php if (has_permission('User')) : ?>
					<li class="nav-item <?= $gr == 'opd' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'opd' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-house-user"></i>
							<p>
								OPD
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/user/users/user'); ?>" class="nav-link <?= $mn == 'bidang' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Bidang & Sub Bidang</p>
								</a>
							</li>
						</ul>
					</li>

					<li class="nav-item <?= $gr == 'Renstra' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'Renstra' ? 'active' : ''; ?>">
							<i class="nav-icon fab fa-buffer"></i>
							<p>
								RENSTRA
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_tujuan'); ?>" class="nav-link <?= $mn == 'opd_tujuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Tujuan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_sasaran'); ?>" class="nav-link <?= $mn == 'opd_sasaran' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Sasaran</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_strategi'); ?>" class="nav-link <?= $mn == 'opd_strategi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Strategi</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_arah_kebijakan'); ?>" class="nav-link <?= $mn == 'opd_arah_kebijakan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>4. </small> Arah Kebijakan</p>
								</a>
							</li>
							<!-- <li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_program_sasaran'); ?>" class="nav-link <?= $mn == 'opd_program_sasaran' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>5. a. </small> Sasaran Program</p>
								</a>
							</li> -->
							<li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_program'); ?>" class="nav-link <?= $mn == 'opd_program' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>5.</small> Program</p>
								</a>
							</li>
							<!-- <li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_kegiatan_sasaran'); ?>" class="nav-link <?= $mn == 'opd_kegiatan_sasaran' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>6. a. </small> Sasaran Kegiatan</p>
								</a>
							</li> -->
							<li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_kegiatan'); ?>" class="nav-link <?= $mn == 'opd_kegiatan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>6. </small> Kegiatan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/renstra/opd_kegiatan_sub'); ?>" class="nav-link <?= $mn == 'opd_kegiatan_sub' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>7. </small> Kegiatan Sub</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'rkpd' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'rkpd' ? 'active' : ''; ?>">
							<i class="nav-icon fab fa-buffer"></i>
							<p>
								RENJA
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/rkpd/opd_program'); ?>" class="nav-link <?= $mn == 'rkpd_program' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Program</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/rkpd/opd_kegiatan'); ?>" class="nav-link <?= $mn == 'rkpd_kegiatan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Kegiatan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/rkpd/opd_kegiatan_sub'); ?>" class="nav-link <?= $mn == 'rkpd_kegiatan_sub' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Kegiatan Sub</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/rkpd/opd_kegiatan_sub_tag'); ?>" class="nav-link <?= $mn == 'rkpd_kegiatan_sub_tag' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Pelabelan</p>
								</a>
							</li>
						</ul>
					</li>
					<!-- <li class="nav-item <?= $gr == 'dpa' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'dpa' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-money-bill-wave"></i>
							<p>
								DPA
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/dpa/dpa'); ?>" class="nav-link <?= $mn == 'dpa' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> DPA</p>
								</a>
							</li>
						</ul>
					</li> -->
					<li class="nav-item <?= $gr == 'ropk' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'ropk' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerja">
							<i class="nav-icon fas fa-chart-bar"></i>
							<p>
								Cantik
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/organisasi'); ?>" class="nav-link <?= $mn == 'ropk_organisasi' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerja Organisasi">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Cantik Organisasi</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/keuangan'); ?>" class="nav-link <?= $mn == 'ropk_keuangan' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerja Keuangan">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Cantik Keuangan</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/fisik'); ?>" class="nav-link <?= $mn == 'ropk_fisik' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerja Fisik">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Cantik Fisik</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'emonev' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'emonev' ? 'active' : ''; ?>" title="Minitoring, Evaluasi dan Pelaporan Kinerja">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								Simonela
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/emonev/emonev'); ?>" class="nav-link <?= $mn == 'e_progres' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Entri Progres</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/ropk/ropk_fisik'); ?>" class="nav-link <?= $mn == 'e_fisik' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Laporan</p>
								</a>
							</li>
						</ul>
					</li>
					<br><br>
					<!-- <li class="nav-item <?= $gr == 'kla_u' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'kla_u' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								KLA
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">

							<li class="nav-item">
								<a href="<?= base_url('/user/kla/pertanyaan'); ?>" class="nav-link <?= $mn == 'kla_pertanyaan_u' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pertanyaan KLA</p>
								</a>
							</li>
						</ul>
					</li> -->
				<?php endif; ?>
			</ul>
		</nav>
	</div>
</aside>