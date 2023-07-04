<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> <?= $title; ?></h1>

	<div class="alert alert-secondary" role="alert">
		<h4 class="alert-heading">Selamat Datang</h4>
		<p><?= $user['name']; ?></p>
		<hr>
		<p class="mb-0">Anda sebagai admin. anda bisa melakukan akses penuh.</p>
	</div>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/footer'); ?>