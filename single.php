<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-single', get_post_type() );

			if ( comments_open() || get_comments_number() ) :
                ?>
            <div class="mx-5 px5">
                <?php
				    comments_template();
                ?>
            </div>
                <?php
			endif;

		endwhile;
		?>

	</main>

<?php
get_sidebar();
get_footer();
