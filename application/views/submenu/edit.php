<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Menu Management</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $submenu['id']; ?>">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title Sub Menu" value="<?= $submenu['title']; ?>">
                            <?= form_error('title', '<small id="menu" class="form-text text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">Choose Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($submenu['menu_id'] == $m['id']) : ?>
                                        <option value="<?= $m['id'] ?>" selected><?= $m['menu']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['menu']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('menu_id', '<small id="menu" class="form-text text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="url" class="form-control" id="url" placeholder="URL" value="<?= $submenu['url']; ?>">
                            <?= form_error('url', '<small id="menu" class="form-text text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="icon" class="form-control" id="icon" placeholder="Icon" value="<?= $submenu['icon']; ?>">
                            <?= form_error('icon', '<small id="menu" class="form-text text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="is_active" value="1" <?php echo ($submenu['is_active'] == '1' ? ' checked' : ''); ?>> Active</label>
                            <label><input type="radio" name="is_active" value="0" <?php echo ($submenu['is_active'] == '0' ? ' checked' : ''); ?>> Deactive</label>
                        </div>
                        <a href="<?= base_url(); ?>menu/submenu" class="btn btn-secondary float-right ml-1"><i class="fas fa-undo"></i> Back</a>
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit"></i> Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->