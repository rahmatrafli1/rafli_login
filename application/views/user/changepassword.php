<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('user/changepassword'); ?>" method="post">
                <div class="form-group">
                    <label for="currentPassword">Old Password:</label>
                    <input type="password" class="form-control" name="currentPassword" id="currentPassword">
                    <?= form_error('currentPassword', '<small id="currentPassword" class="form-text text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="newPassword1">New Password: </label>
                    <input type="password" class="form-control" name="newPassword1" id="newPassword1">
                    <?= form_error('newPassword1', '<small id="newPassword1" class="form-text text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="newPassword2">Repeat Password: </label>
                    <input type="password" class="form-control" name="newPassword2" id="newPassword2">
                    <?= form_error('newPassword2', '<small id="newPassword2" class="form-text text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->