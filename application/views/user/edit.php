<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-user-edit"></i> <?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-8">
			<?= form_open_multipart('user/edit'); ?>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control" value="<?= $user['email']; ?>" readonly>
					<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="<?= set_value('name', $user['name']); ?>">
					<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar</label>
				<div class="col-sm-10">
					<div class="custom-file">
						<input type="file" name="image" class="custom-file-input" id="image">
						<label class="custom-file-label" for="image">Pilih File</label>
						<?= form_error('image', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<img src="<?= base_url('assets/img/profile/' . $user['image']); ?>" alt="<?= $user['name']; ?>" width="150" height="150" class="img-thumbnail mt-3">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Ubah</button>
				</div>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/footer'); ?>
