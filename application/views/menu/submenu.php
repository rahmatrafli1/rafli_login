<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="flash-submenu-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>


	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-folder-open"></i> <?= $title; ?></h1>

	<!-- Button untuk tambah modal -->
	<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahSubMenuModal">
		Tambah Sub Menu
	</button>

	<div class="row">
		<div class="col-lg">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Menu</th>
						<th scope="col">Sub Menu</th>
						<th scope="col">URL</th>
						<th scope="col">Icon</th>
						<th scope="col">Aktif?</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$number = 1;
					foreach ($submenu as $sm) : ?>
						<?php if ($sm['menu'] == 'Menu') : ?>
						<?php else : ?>
							<tr>
								<th scope="row"><?= $number++; ?></th>
								<td><?= $sm['menu']; ?></td>
								<td><?= $sm['title']; ?></td>
								<td><?= $sm['url']; ?></td>
								<td><?= $sm['icon']; ?></td>
								<td><?= $sm['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
								<td>
									<a href="#" class="badge badge-warning" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['id'] ?>">Edit</a>
									<a href="#" class="badge badge-danger" data-toggle="modal" data-target="#hapusSubMenuModal<?= $sm['id'] ?>">Hapus</a>
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

<!-- Modal Tambah Sub Menu-->
<div class="modal fade" id="tambahSubMenuModal" tabindex="-1" aria-labelledby="tambahSubMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahSubMenuModalLabel">Tambah Sub Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/submenu') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Menu</label>
						<select name="menu_id" class="form-control">
							<option value="">--Pilih Menu--</option>
							<?php foreach ($menu as $m) : ?>
								<option value="<?= $m['id'] ?>" <?= $m['id'] == set_value('menu_id') ? 'selected' : '' ?>><?= $m['menu'] ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('menu_id', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Sub Menu</label>
						<input type="text" name="title" class="form-control" value="<?= set_value('title'); ?>">
						<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>URL</label>
						<input type="text" name="url" class="form-control" value="<?= set_value('url'); ?>">
						<?= form_error('url', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Icon</label>
						<input type="text" name="icon" class="form-control" value="<?= set_value('icon'); ?>">
						<?= form_error('icon', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="is_active" value="1" <?= set_value('is_active') == 1 ? "checked" : ""; ?>>
							<label class="form-check-label">Aktif</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="is_active" value="0" <?= set_value('is_active') == 0 ? "checked" : ""; ?>>
							<label class="form-check-label">Tidak Aktif</label>
						</div>
						<?= form_error('is_active', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal Tambah Sub Menu -->

<!-- Modal Edit Sub Menu -->
<?php foreach ($submenu as $sm) : ?>
	<?php if ($sm['menu'] != 'Menu') : ?>
		<div class="modal fade" id="editSubMenuModal<?= $sm['id'] ?>" tabindex="-1" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editSubMenuModalLabel">Edit Sub Menu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('menu/edit_submenu/' . $sm['id']) ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name="id" value="<?= $sm['id']; ?>">
							<div class="form-group">
								<label>Menu</label>
								<select name="menu_id" class="form-control">
									<option value="">--Pilih Menu--</option>
									<?php foreach ($menu as $m) : ?>
										<?php if ($sm['menu_id'] == $m['id']) : ?>
											<option value="<?= $m['id'] ?>" selected><?= $m['menu'] ?></option>
										<?php else : ?>
											<option value="<?= $m['id'] ?>" <?= $m['id'] == set_value('menu_id') ? 'selected' : '' ?>><?= $m['menu'] ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
								<?= form_error('menu_id', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Sub Menu</label>
								<input type="text" name="title" class="form-control" value="<?= set_value('title', $sm['title']); ?>">
								<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>URL</label>
								<input type="text" name="url" class="form-control" value="<?= set_value('url', $sm['url']); ?>">
								<?= form_error('url', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Icon</label>
								<input type="text" name="icon" class="form-control" value="<?= set_value('icon', $sm['icon']); ?>">
								<?= form_error('icon', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<?php if ($sm['is_active'] == 1) : ?>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="is_active" value="1" checked>
										<label class="form-check-label">Aktif</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="is_active" value="0">
										<label class="form-check-label">Tidak Aktif</label>
									</div>
								<?php elseif ($sm['is_active'] == 0) : ?>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="is_active" value="1">
										<label class="form-check-label">Aktif</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="is_active" value="0" checked>
										<label class="form-check-label">Tidak Aktif</label>
									</div>
								<?php else : ?>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="is_active" value="1" <?= set_value('is_active') == 1 ? "checked" : ""; ?>>
										<label class="form-check-label">Aktif</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="is_active" value="0" <?= set_value('is_active') == 0 ? "checked" : ""; ?>>
										<label class="form-check-label">Tidak Aktif</label>
									</div>
								<?php endif; ?>
								<?= form_error('is_active', '<small class="text-danger">', '</small>'); ?>
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
<!-- End Modal Edit Sub Menu -->

<!-- Modal Hapus Sub Menu -->
<?php foreach ($submenu as $sm) : ?>
	<?php if ($sm['menu'] != 'Menu') : ?>
		<div class="modal fade" id="hapusSubMenuModal<?= $sm['id'] ?>" tabindex="-1" aria-labelledby="hapusSubMenuModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="hapusSubMenuModalLabel">Hapus Sub Menu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('menu/hapus_submenu/' . $sm['id']) ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name="id" value="<?= $sm['id']; ?>">
							<p>Yakin Mau dihapus?</p>
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
<!-- End Modal Hapus Sub Menu -->

<?php $this->load->view('templates/footer'); ?>