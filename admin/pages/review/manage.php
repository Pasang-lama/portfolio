<?php
$db = new Database();


if (isset($_GET['eid'])) {
    $editid = $_GET['eid'];
    $_SESSION['edit_id'] =  $editid;
    header('Location:' . url('admin/review/update'));
    exit();
}


if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('review', 'id', $deleteId);
    $_SESSION['success'] = "Review Deleted Successfully";
    header('Location:' . url('admin/review/manage'));
    exit();
}
unset($_SESSION['edit_id']);
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Manage Review</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Review</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Review List</h5>
                </div>
                <?php messages() ?>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $reviews = $db->All('review');
                            $i = 1;
                            foreach ($reviews as $review) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img src="<?= url($review->profile) ?>" height="100"></td>
                                    <td><?= $review->name ?></td>
                                    <td><?= $review -> status == 1 ? 'Published' : "Unpublished" ?></td>
                                    <td>
                                        <a href="<?= url("admin/review/manage") ?>?eid=<?= $review->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/review/manage") ?>?did=<?= $review->id ?>" class="btn btn-danger">Delete</a>
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