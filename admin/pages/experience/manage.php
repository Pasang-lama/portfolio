<?php
$db = new Database();
if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('experience', 'id', $deleteId);
    $_SESSION['success'] = "1 Item has been deleted Successfully";
    header('Location:' . url('admin/experience/manage'));
    exit();
}
?>
<main id="main" class="main">
<div class="pagetitle">
        <h1>Experience</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Experience</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">Work Experience</h5>
                </div>
                <?php messages() ?>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Company</th>
                                <th>Post</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $experiences = $db->All('experience');
                            $i = 1;
                            foreach ($experiences as $experience) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $experience->company ?></td>
                                    <td><?= $experience->post ?></td>
                                    <td><?= $experience->start_date ?></td>
                                    <td><?= $experience->end_date ?></td>
                                    <td><?= $experience -> status == 1 ? 'Left' : "Working" ?></td>
                                    <td>
                                        <a href="<?= url("admin/experience/update") ?>?eid=<?= $experience->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/experience/manage") ?>?did=<?= $experience->id ?>" class="btn btn-danger">Delete</a>
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