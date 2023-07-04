<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="flash-useredit-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-user"></i> <?= $title; ?></h1>

	<div class="card mb-3" style="max-width: 540px;">
		<div class="row no-gutters">
			<div class="col-md-4">
				<img src="<?= base_url('assets/img/profile/' . $user['image']); ?>" alt="<?= $user['name']; ?>" width="180" height="180">
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<h5 class="card-title"><?= $user['name']; ?></h5>
					<p class="card-text">Email: <?= $user['email']; ?></p>
					<?php if ($user['role_id'] == 1) : ?>
						<p class="card-text">Anda Sebagai <?= 'Admin' ?></p>
					<?php elseif ($user['role_id'] == 2) : ?>
						<p class="card-text">Anda Sebagai <?= 'User' ?></p>
					<?php elseif ($user['role_id'] == 6) : ?>
						<p class="card-text">Anda Sebagai <?= 'Direktur' ?></p>
					<?php endif; ?>
					<p class="card-text"><small class="text-muted">Dibuat Tanggal: <?= tgl_indo(date('Y-m-d', $user['date_created'])); ?></small></p>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/footer'); ?>
