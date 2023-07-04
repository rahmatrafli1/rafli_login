<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="flash-role-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-flag"></i> <?= $title; ?></h1>

	<!-- Button untuk tambah modal -->
	<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahAksesModal">
		Tambah Akses
	</button>

	<div class="row">
		<div class="col-lg-6">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Akses</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$number = 1;
					foreach ($role as $r) : ?>
						<tr>
							<th scope="row"><?= $number++; ?></th>
							<td><?= $r['role']; ?></td>
							<td>
								<a href="<?= base_url('admin/akses/' . $r['id']) ?>" class="badge badge-secondary">Akses</a>
								<a href="#" class="badge badge-warning" data-toggle="modal" data-target="#editAksesModal<?= $r['id'] ?>">Edit</a>
								<a href="#" class="badge badge-danger" data-toggle="modal" data-target="#hapusAksesModal<?= $r['id'] ?>">Hapus</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Akses -->
<div class="modal fade" id="tambahAksesModal" tabindex="-1" aria-labelledby="tambahAksesModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahAksesModalLabel">Tambah Akses</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/role'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Nama Akses</label>
						<input type="text" name="role" value="<?= set_value('role') ?>" class="form-control">
						<?= form_error('role', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal Tambah Akses -->

<!-- Modal Edit Akses -->
<?php foreach ($role as $r) : ?>
	<div class="modal fade" id="editAksesModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="editAksesModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editAksesModalLabel">Edit Akses</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('admin/edit_role/' . $r['id']) ?>" method="post">
					<div class="modal-body">
						<input name="id" type="hidden" value="<?= $r['id']; ?>">
						<div class="form-group">
							<label>Nama Akses</label>
							<input type="text" name="role" value="<?= set_value('role', $r['role']) ?>" class="form-control">
							<?= form_error('role', '<small class="text-danger">', '</small>'); ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- End Modal Edit Akses -->

<!-- Modal Hapus Akses -->
<?php foreach ($role as $r) : ?>
	<div class="modal fade" id="hapusAksesModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="hapusAksesModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="hapusAksesModal">Hapus Akses</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('admin/hapus_role/' . $r['id']) ?>" method="post">
					<div class="modal-body">
						<input name="id" type="hidden" value="<?= $r['id']; ?>">
						<p>Yakin Mau Dihapus?</p>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- End Modal Hapus Akses -->

<?php $this->load->view('templates/footer'); ?>