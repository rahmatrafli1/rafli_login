<?php $this->load->view('auth/templates/header'); ?>

<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xl-7 col-lg-9 col-md-9 my-5">
			<div class="text-center text-white h1 mb-5">
				<strong><i class="fas fa-code rotate-n-15"></i> RAFLI LOGIN</strong>
			</div>
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
								</div>
								<?= $this->session->flashdata('pesan'); ?>
								<form class="user" action="<?= base_url(); ?>" method="post">
									<div class="form-group">
										<input type="text" name="email" class="form-control form-control-user" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
										<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" name="password" placeholder="Password">
										<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">
										Login
									</button>
								</form>
								<hr>
								<div class="text-center">
									<small>Lupa Password? </small>
									<a class="small" href="<?= base_url('auth/lupapassword'); ?>">Klik disini!</a>
								</div>
								<div class="text-center">
									<small>Belum Punya Akun? </small>
									<a class="small" href="<?= base_url('auth/register'); ?>">Klik disini!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

<?php $this->load->view('auth/templates/footer'); ?>