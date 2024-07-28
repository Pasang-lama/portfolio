<?php
$db = new Database();
if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('review', 'id', $deleteId);
    $_SESSION['success'] = "Qualification Deleted Successfully";
    header('Location:' . url('admin/education/manage'));
    exit();
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Qualification</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Qualification</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Acaemic Journey</h5>
                </div>
                <?php messages() ?>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qualifications = $db->All('qualification');
                            $i = 1;
                            foreach ($qualifications as $qualification) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $qualification->title ?></td>
                                    <td><?= $qualification->start_date ?></td>
                                    <td><?= $qualification->end_date ?></td>
                                    <td><?= $qualification -> status == 1 ? 'completed' : "Running" ?></td>
                                    <td>
                                        <a href="<?= url("admin/education/manage") ?>?eid=<?= $qualification->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/education/manage") ?>?did=<?= $qualification->id ?>" class="btn btn-danger">Delete</a>
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