<?php
/*
Template Name: New reader register form
*/
get_header();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        echo '<p class="p-3 text-warning-emphasis bg-warning-subtle border border-primary-subtle rounded-3 text-center">All fields are required.</p>';
    } else {
        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            echo '<p class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 text-center">Registration successfully. Now you can login with your credencials.</p>';
        } else {
            echo '<p class="p-3 text-danger-emphasis bg-danger-subtle border border-primary-subtle rounded-3 text-center">Error: ' . $user_id->get_error_message() . '</p>';
        }
    }
}
?>
<div class="container text-center">
    <div class="col">
        <h2 class="my-5"><?php the_title(); ?></h2>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <form method="post" action="">
                <div class="form-group mt-3 mb-2 text-start">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"placeholder="Username" required>
                </div>
                <div class="form-group mt-3 mb-2 text-start">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group mt-3 mb-2 text-start">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
