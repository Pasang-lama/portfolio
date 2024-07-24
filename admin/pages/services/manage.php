<?php
$db = new Database();

if (isset($_GET['eid'])) {
    $editid = $_GET['eid'];
    $_SESSION['edit_id'] =  $editid;
    header('Location:' . url('admin/services/update'));
    exit();
}


if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('service', 'id', $deleteId);
    $_SESSION['success'] = "Service Deleted Successfully";
    header('Location:' . url('admin/services/manage'));
    exit();
}
unset($_SESSION['edit_id']);
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Manage Services</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->


    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Services List</h5>
                </div>
                <?php messages() ?>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $services = $db->All('service');
                            $i = 1;
                            foreach ($services as $service) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $service->title ?></td>
                                    <td>
                                        <a href="<?= url("admin/services/manage") ?>?eid=<?= $service->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/services/manage") ?>?did=<?= $service->id ?>" class="btn btn-danger">Delete</a>
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