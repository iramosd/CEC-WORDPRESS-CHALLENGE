<?php
get_header();
?>
<!-- Hero header -->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <h1 class="masthead-heading text-uppercase mb-0">Stay up to date</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Design - Technology - Business</Bu></p>
    </div>
</header>

<main id="primary" class="site-main">

    <?php
    if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
        <?php
        endif;
        ?>
        <h2 class="page-section-heading text-center text-uppercase text-secondary my-5" id="news">Last News</h2>

        <div class="row">

            <?php

            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;
            ?>
        </div>
        <?php
        the_posts_navigation();

    else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>

</main>
<?php
get_sidebar();
get_footer();
