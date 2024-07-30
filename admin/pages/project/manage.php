<?php
$db = new Database();
if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('project', 'id', $deleteId);
    $_SESSION['success'] = "Project Deleted Successfully";
    header('Location:' . url('admin/project/manage'));
    exit();
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Manage Project</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=url("admin")?>">Home</a></li>
                <li class="breadcrumb-item active">Projects</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->


    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Project List</h5>
                </div>
                <?php messages() ?>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Thumbnail</th>
                                <th>Tittle</th>
                                <th>Project Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $projects = $db->All('project');
                            $i = 1;
                            foreach ($projects as $project) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img src="<?= url($project->thumbnail) ?>" height="100"></td>
                                    <td><?= $project->title ?></td>
                                    <td><?= $project -> status?></td>
                                    <td><?= $project -> frontend == '1'? "Published" : "Unpublished" ?></td>
                                    <td>
                                        <a href="<?= url("admin/project/update") ?>?eid=<?= $project->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/project/manage") ?>?did=<?= $project->id ?>" class="btn btn-danger">Delete</a>
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