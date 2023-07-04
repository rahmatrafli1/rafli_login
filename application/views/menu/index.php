<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="flash-menu-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-folder"></i> <?= $title; ?></h1>

	<!-- Button untuk tambah modal -->
	<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMenuModal">
		Tambah Menu
	</button>

	<div class="row">
		<div class="col-lg-6">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Menu</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$number = 1;
					foreach ($menu as $m) : ?>
						<?php if ($m['menu'] == 'Menu') : ?>
						<?php else : ?>
							<tr>
								<th scope="row"><?= $m['menu'] == 'Menu' ? '' : $number++; ?></th>
								<td><?= $m['menu'] == 'Menu' ? '' : $m['menu']; ?></td>
								<td>
									<a href="#" class="badge badge-warning" data-toggle="modal" data-target="#editMenuModal<?= $m['id']; ?>">Edit</a>
									<a href="#" class="badge badge-danger" data-toggle="modal" data-target="#hapusMenuModal<?= $m['id']; ?>">Hapus</a>
								</td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="tambahMenuModal" tabindex="-1" aria-labelledby="tambahMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahMenuModalLabel">Tambah Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/tambah_menu'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Menu</label>
						<input type="text" name="menu" class="form-control" value="<?= set_value('menu'); ?>">
						<?= form_error('menu', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Edit -->
<?php foreach ($menu as $m) : ?>
	<?php if ($m['menu'] != 'Menu') : ?>
		<div class="modal fade" id="editMenuModal<?= $m['id']; ?>" tabindex="-1" aria-labelledby="rditMenuModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('menu/edit_menu/' . $m['id']); ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name="id" value="<?= $m['id']; ?>">
							<div class="form-group">
								<label>Menu</label>
								<input type="text" name="menu" class="form-control" value="<?= set_value('menu', $m['menu']); ?>">
								<?= form_error('menu', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; ?>
<!-- End Modal Edit -->

<!-- Modal Hapus -->
<?php foreach ($menu as $m) : ?>
	<?php if ($m['menu'] != 'Menu') : ?>
		<div class="modal fade" id="hapusMenuModal<?= $m['id']; ?>" tabindex="-1" aria-labelledby="hapusMenuModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="hapusMenuModalLabel">Hapus Menu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('menu/hapus_menu/' . $m['id']); ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name="id" value="<?= $m['id']; ?>">
							<p>Yakin mau dihapus</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; ?>
<!-- End Modal Hapus -->

<?php $this->load->view('templates/footer'); ?>