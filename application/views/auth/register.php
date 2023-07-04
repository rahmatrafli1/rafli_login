<?php $this->load->view('auth/templates/header'); ?>

<div class="container">

	<div class="text-center text-white h1 my-5">
		<strong><i class="fas fa-code rotate-n-15"></i> RAFLI LOGIN</strong>
	</div>
	<div class="card o-hidden border-0 shadow-lg col-lg-7 mx-auto">
		<div class="card-body p-0">
			<!-- Nested Row within Card Body -->
			<div class="row">
				<div class="col-lg">
					<div class="p-5">
						<div class="text-center">
							<h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
						</div>
						<form class="user" action="<?= base_url('auth/register') ?>" method="post">
							<div class="form-group">
								<input type="text" name="name" class="form-control form-control-user" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
								<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group">
								<input type="text" name="email" class="form-control form-control-user" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
								<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="password" name="password1" class="form-control form-control-user" placeholder="Password">
									<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="password" class="form-control form-control-user" name="password2" placeholder="Ulangi Password">
									<?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-user btn-block">
								Register
							</button>
						</form>
						<hr>
						<div class="text-center">
							<small>Sudah Punya Akun? </small>
							<a class="small" href="<?= base_url(); ?>">Klik disini!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?php $this->load->view('auth/templates/footer'); ?>