<?php
$db = new Database();
$contactinfo = $db->customQuery("SELECT phone, residence, map, email, linkedin, facebook, instagram, behance, twitter From users");
$user = $contactinfo[0];
$errors = [
    'name' => '',
    'phone' => '',
    'email' => '',
    'message' => '',
];

$oldValue = [
    'name' => '',
    'phone' => '',
    'email' => '',
    'message' => '',
];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'email') {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if (!array_filter($errors)) {
        $data = $_POST;
        $db->Insert('contact', $data);
        $_SESSION['success'] = "Contact message send Successfully";
        redirect_back();
    }
}


?>


<div class="container pt-5">
    <div class="page-header">
        <h1 class="page-tittle">Contact.</h1>
        <div class="side-icon"><i class="fa-solid fa-envelope"></i></div>
    </div>
    <div class="row gy-4">
        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="section-block">
                <div class="sub-heading">
                    <h2 class="section-tittle">Write to us</h2>
                </div>
                <?= messages()?>
                <form class="contact-form"  autocomplete="off" method="POST">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label for="contact_name" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" name="name" id="contact_name" placeholder="Full Name" value="<?= $oldValue['name']?>">
                            <small class="text-danger"><?= $errors['name'] ?></small>
                            
                        </div>
                        <div class="col-lg-6">
                            <label for="contact_phone" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control" name="phone" id="contact_phone" placeholder="Phone Number" value="<?= $oldValue['phone']?>">
                            <small class="text-danger"><?= $errors['phone'] ?></small>
                        </div>
                        <div class="col-lg-12">
                            <label for="contact_email" class="form-label">Email Address:</label>
                            <input type="email" class="form-control" name="email" id="contact_email" placeholder="Email Address" value="<?= $oldValue['email']?>">
                            <small class="text-danger"><?= $errors['email'] ?></small>

                        </div>
                        <div class="col-lg-12">
                            <label for="contact_message" class="form-label">Message:</label>
                            <textarea class="form-control" id="contact_message" name="message" rows="3" placeholder="Write message..."><?= $oldValue['message']?></textarea>
                            <small class="text-danger"><?= $errors['message'] ?></small>
                        </div>
                    </div>
                    <div class="custom-buttons mt-4">
                        <button  type="submit"><i class="fa-solid pe-2 fa-paper-plane"></i> Send Message </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="section-block">
                <div class="sub-heading">
                    <h2 class="section-tittle">Contact Details</h2>
                </div>
                <div class="social-container">
                    <div class="socials">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        </div>
                        <div class="details">
                            <p>Address</p>
                            <a><?= $user->residence ?></a>
                        </div>
                    </div>
                    <div class="socials">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div class="details">
                            <p>Email Address</p>
                            <a href="mailto:<?= $user->email ?>"><?= $user->email ?></a>
                        </div>
                    </div>
                    <div class="socials">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        </div>
                        <div class="details">
                            <p>Phone</p>
                            <a href="tel:<?= $user->phone ?>"><?= $user->phone ?></a>
                        </div>
                    </div>
                </div>
                <div class=" social--media-container">
                    <div class="section-head">follow me on social media:</div>
                    <div class="socials">
                        <?php
                        if (!empty($user->facebook)) {
                        ?>
                            <a class="facebook  icon-wrapper " href="<?= $user->facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <?php
                        }
                        if (!empty($user->twitter)) {
                        ?>
                            <a class="twitter icon-wrapper " href="<?= $user->twitter ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                        <?php
                        }
                        if (!empty($user->linkedin)) {
                        ?>
                            <a class="linkedin icon-wrapper  " href="<?= $user->linkedin ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <?php
                        }
                        if (!empty($user->instagram)) {
                        ?>
                            <a class="instagram icon-wrapper  " href="<?= $user->instagram ?>" target="_blank"><i class="fab fa-instagram"></i></i></a>
                        <?php
                        }
                        if (!empty($user->behance)) {
                        ?>
                            <a class="icon-wrapper  " href="<?= $user->behance ?>" target="_blank"><i class="fa-brands fa-behance"></i></i></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="google-map">
    <?= $user->map ?>
</div>