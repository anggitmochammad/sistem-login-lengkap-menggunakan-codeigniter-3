<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($role as $r) { ?>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $r['id']; ?>">
                    <div class="form-group">
                        <label for="edit-role">Role Name</label>
                        <input type="text" class="form-control" id="edit-role" name="edit-role" placeholder="Role name" value="<?= $r['role']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            <?php } ?>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



</div>
</div>
</div>