<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="#" class="brand-link" style="text-align: center;">
		<div class="image">
			<img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" style="width: -webkit-fill-available;max-width: 40px;margin-left: .8rem;">
			<span class="brand-text font-weight-light" style="font-family: monospace;" title="Transpormasi Birokrasi Untuk Perwujudan Birokrasi Kabupaten Pangandaran yang Lebih Adaptive, Agile dan Fluid"> Tarasi Donan</span>
		</div>
		<!-- <img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 text-center">
			<!-- <div class="image">
				<img src="<?= base_url('/toping/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
			</div> -->
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
				<?php if (has_permission('Admin')) : ?>
					<li class="nav-item ">
						<a href="<?= base_url('/'); ?>" class="nav-link <?= $mn == 'home' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								Dashboard
								<!-- <i class="right fas fa-angle-left"></i> -->
							</p>
						</a>
					</li>
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
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
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
						</ul>
					</li>
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'a-esakip' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'a-esakip' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								E-Sakip
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/opd_data'); ?>" class="nav-link <?= $mn == 'a-instansi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> SAKIP-LKE</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>

				<!-- --------------------------------------------------------------------------------------------------------------------------------------------------- -->
				<?php if (has_permission('User')) : ?>
					<li class="nav-item ">
						<a href="<?= base_url('/'); ?>" class="nav-link <?= $mn == 'home' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								Dashboard
								<!-- <i class="right fas fa-angle-left"></i> -->
							</p>
						</a>
					</li>
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
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
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
								<a href="<?= base_url('/user/rpjmd/visi'); ?>" class="nav-link <?= $mn == 'visi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> VISI / MISI</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/rpjmd/tujuan'); ?>" class="nav-link <?= $mn == 'tujuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Tujuan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/rpjmd/sasaran'); ?>" class="nav-link <?= $mn == 'sasaran' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Sasaran</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/rpjmd/strategi'); ?>" class="nav-link <?= $mn == 'strategi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>4. </small> Strategi</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/user/rpjmd/arah_kebijakan'); ?>" class="nav-link <?= $mn == 'arah_kebijakan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>5. </small> Arah Kebijakan</p>
								</a>
							</li>
						</ul>
					</li>
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'esakip' ||  $gr == 'a-esakip' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'esakip' ||  $gr == 'a-esakip' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								E-Sakip
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/esakip/sakip_instansi'); ?>" class="nav-link <?= $mn == 'instansi' ? 'active' : ''; ?>" title="Lembar Kerja Evaluasi">
									<i class="far nav-icon"></i>
									<p><small>1. </small> SAKIP-LKE</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/esakip/sakip_instansi_nilai'); ?>" class="nav-link <?= $mn == 'instansi_nilai' ? 'active' : ''; ?>" title="Hasil Evaluasi Sementara">
									<i class="far nav-icon"></i>
									<p><small>2. </small> SAKIP-HES</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/esakip/sakip_instansi_lhe'); ?>" class="nav-link <?= $mn == 'instansi_lhe' ? 'active' : ''; ?>" title="Laporan Hasil Evaluasi">
									<i class="far nav-icon"></i>
									<p><small>3. </small> SAKIP-LHE</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/esakip/sakip_instansi_nilai_lhe'); ?>" class="nav-link <?= $mn == 'instansi_nilai_lhe' ? 'active' : ''; ?>" title="Hasil Evaluasi">
									<i class="far nav-icon"></i>
									<p><small>2. </small> SAKIP-HE</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>

				<!-- ============================Verifikator sakip=================================== -->
				<?php if (has_permission('Verifikator')) : ?>
					<li class="nav-item <?= $gr == 'esakip-v' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'esakip-v' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								E-Sakip Verifikator
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/opd_data'); ?>" class="nav-link <?= $mn == 'a-instansi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> SAKIP-Verifikator</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/sakip_instansi_nilai'); ?>" class="nav-link <?= $mn == 'a-instansi_nilai' ? 'active' : ''; ?>" title="Hasil Evaluasi Sementara">
									<i class="far nav-icon"></i>
									<p><small>2. </small> SAKIP-GAB</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/opd_data_lhe'); ?>" class="nav-link <?= $mn == 'a-instansi-lhe' ? 'active' : ''; ?>" title="Laporan Hasil Evaluasi">
									<i class="far nav-icon"></i>
									<p><small>3. </small> SAKIP-LHE</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<!-- ============================Verifikator=================================== -->

				<?php if (has_permission('User')) : ?>
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'rb' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'rb' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								PMPRB
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/rb/rb_pertanyaan'); ?>" class="nav-link <?= $mn == 'rb_pertanyaan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> PMPRB</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>

				<!-- ============================Verifikator RB=================================== -->
				<?php if (has_permission('Verifikator')) : ?>
					<li class="nav-item <?= $gr == 'rb-v' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'rb-v' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								PMPRB Verifikator
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/rb/opd_data'); ?>" class="nav-link <?= $mn == 'opd' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> PMPRB-Verifikasi</p>
								</a>
							</li>
						</ul>
						<!-- <ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/sakip_instansi_nilai'); ?>" class="nav-link <?= $mn == 'a-instansi_nilai' ? 'active' : ''; ?>" title="Hasil Evaluasi Sementara">
									<i class="far nav-icon"></i>
									<p><small>2. </small> SAKIP-GAB</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/opd_data_lhe'); ?>" class="nav-link <?= $mn == 'a-instansi-lhe' ? 'active' : ''; ?>" title="Laporan Hasil Evaluasi">
									<i class="far nav-icon"></i>
									<p><small>3. </small> SAKIP-LHE</p>
								</a>
							</li>
						</ul> -->
					</li>
				<?php endif; ?>
				<!-- ============================Verifikator=================================== -->

				<?php if (has_permission('User')) : ?>
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'SPIP' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'SPIP' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								SPIP Terintegrasi
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/opd_data'); ?>" class="nav-link <?= $mn == 'a-instansi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> SPIP Terintegrasi</p>
								</a>
							</li>
						</ul>
					</li>
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'MCP' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'MCP' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								MCP
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/opd_data'); ?>" class="nav-link <?= $mn == 'a-instansi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> MCP</p>
								</a>
							</li>
						</ul>
					</li>
					<!-- =============================================================== -->
					<li class="nav-header">=====================</li>
					<!-- =============================================================== -->
					<li class="nav-item <?= $gr == 'LAKIP' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'LAKIP' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-copy"></i>
							<p>
								LAKIP
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/esakip/opd_data'); ?>" class="nav-link <?= $mn == 'a-instansi' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> LAKIP</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>

				<br><br>
				<br><br>
			</ul>
		</nav>
	</div>
</aside>