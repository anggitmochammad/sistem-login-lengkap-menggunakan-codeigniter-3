<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($submenu as $sm) { ?>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $sm['id']; ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="edit_title" placeholder="Title" value="<?= $sm['title']; ?>">
                        <?= form_error('edit_title', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu">Select Menu</label>
                        <select class="form-control" id="menu" name="edit_menu_id">
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($m['menu'] == $sm['menu']) : ?>
                                    <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></>
                                    <?php else : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="edit_url" placeholder="url" value="<?= $sm['url']; ?>">
                        <?= form_error('edit_url', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="edit_icon" placeholder="icon" value="<?= $sm['icon']; ?>">
                        <?= form_error('edit_icon', '<small class="text-danger">', '</small>'); ?>
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