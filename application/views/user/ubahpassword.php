<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="flash-failchangepassword-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
	<div class="flash-changepassword-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-key"></i> <?= $title; ?></h1>

	<?= form_open(base_url('user/ubahpassword')); ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<label>Password Lama</label>
				<input type="password" name="old_password" class="form-control">
				<?= form_error('old_password', '<small class="text-danger">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label>Password Baru</label>
				<input type="password" name="password1" class="form-control">
				<?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label>Konfirmasi Password</label>
				<input type="password" name="password2" class="form-control">
				<?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
	<?= form_close(); ?>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/footer'); ?>
