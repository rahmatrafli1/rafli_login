<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Menu Management</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                        <div class="form-group">
                            <label for="menu">Menu Name</label>
                            <input type="text" name="menu" class="form-control" id="menu" placeholder="Menu Name" value="<?= $menu['menu']; ?>">
                            <small class="form-text text-danger"><?= form_error('menu'); ?></small>
                        </div>
                        <a href="<?= base_url(); ?>menu" class="btn btn-secondary float-right ml-1"><i class="fas fa-undo"></i> Back</a>
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