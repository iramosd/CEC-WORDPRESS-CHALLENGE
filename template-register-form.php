<?php
/*
Template Name: New reader register form
*/
get_header();
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
                    <input type="text" class="form-control" id="username"placeholder="Username" required>
                </div>
                <div class="form-group mt-3 mb-2 text-start">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <div class="form-group mt-3 mb-2 text-start">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
