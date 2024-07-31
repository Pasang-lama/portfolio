<?php
$db = new Database();
if (isset($_GET['eid'])) {
    $editid = $_GET['eid'];
    $_SESSION['edit_blogid'] =  $editid;
    header('Location:' . url('admin/blogs/manage'));
    exit();
}
if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('blogs', 'nid', $deleteId);
    $_SESSION['success'] = "Blog Deleted Successfully";
    header('Location:' . url('admin/blogs/manage'));
    exit();
}
unset($_SESSION['edit_blogid']);

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Manage Blogs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Blogs</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->


    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Blogs List</h5>
                </div>
                <?php messages() ?>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.n</th>
                                <th>Thumbnail</th>
                                <th>Blog Tittle</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $blogs = $db->All('blogs');
                            $i = 1;
                            foreach ($blogs as $blog) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img src="<?= url($blog->image) ?>" height="100"></td>
                                    <td><?= $blog->title ?></td>
                                    <td><?= $blog -> status == 1 ? 'Published' : "Unpublished" ?></td>
                                    <td>
                                        <a href="<?= url("admin/blogs/update") ?>?eid=<?= $blog->nid ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/blogs/manage") ?>?did=<?= $blog->nid ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                </div>


            </div>

        </div>

    </section>
</main><!-- End #main -->