<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="flash-accessmenu-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-flag"></i> <?= $title; ?></h1>

	<h5>Role: <?= $role['role'] ?></h5>
	<div class="row">
		<div class="col-lg-6">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Menu</th>
						<th scope="col">Akses</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$number = 1;
					foreach ($menu as $m) : ?>
						<tr>
							<th scope="row"><?= $number++; ?></th>
							<td><?= $m['menu']; ?></td>
							<td>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" <?= check_akses($role['id'], $m['id']) ?> data-role="<?= $role['id'] ?>" data-menu="<?= $m['id'] ?>">
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/footer'); ?>