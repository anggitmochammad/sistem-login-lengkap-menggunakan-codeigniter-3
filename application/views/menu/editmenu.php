<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($menu as $m) { ?>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $m['id']; ?>">
                    <div class="form-group">
                        <label for="edit-menu">Menu Name</label>
                        <input type="text" class="form-control" id="edit-menu" name="edit-menu" placeholder="Menu name" value="<?= $m['menu']; ?>">
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