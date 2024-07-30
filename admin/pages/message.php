<?php
$db = new Database();
$editId = isset($_GET['eid']) ? $_GET['eid'] : '';
if ($editId) {
    $sql = "SELECT * FROM client WHERE id = $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['name'] = $result->name;
    $oldValue['websiteurl'] = $result->websiteurl;
    $oldValue['logo'] = $result->logo;
}


if (isset($_POST['update_client'])) {
    unset($_POST['update_client']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $name = $_POST['name'];
    $sql = "SELECT count(*) as total FROM client WHERE name = '$name' AND id != $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Client already exists";
    }
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $data['websiteurl'] = $_POST['websiteurl'];
        $db->Update('client', $data, 'id', $editId);
        $_SESSION['success'] = "Client Details Updated Successfully";
        header('Location:' . url('admin/message'));
        exit();
    }
}

if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('contact', 'id', $deleteId);
    $_SESSION['success'] = "Message Deleted Successfully";
    header('Location:' . url('admin/message'));
    exit();
}

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Message</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Message</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->


    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">Message</h5>
                    <?= messages()?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $messages = $db->All('contact');
                            $i = 1;
                            foreach ($messages as $message) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $message->name ?></td>
                                    <td><?= $message->phone ?></td>
                                    <td><?= $message->email ?></td>
                                    <td><?= $message->message ?></td>
                                    <td>
                                        <a href="<?= url("admin/message") ?>?eid=<?= $message->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/message") ?>?did=<?= $message->id ?>" class="btn btn-danger">Delete</a>
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