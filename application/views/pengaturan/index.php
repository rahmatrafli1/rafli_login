<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-cogs"></i> <?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-6">
			<a href="<?= base_url('user/ubahpassword') ?>"><i class="fas fa-fw fa-key"></i> Ubah Password</a>
			<a href="<?= base_url('user/edit') ?>"><i class="fas fa-fw fa-user-edit"></i> Edit Profil</a>
		</div>
	</div>
</div>

<?php $this->load->view('templates/footer'); ?>
