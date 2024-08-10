<?php
?>
<h1>SINGLE</h1>
<?php echo "postype: ".get_post_type() ?>
<div class="col-3 mt-3 mb-2">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <header class="entry-header">
                <h5 class="card-title"><?php the_title(); ?></h5>
            </header>
            <div class="entry-content">
                <p class="card-text">
                    <?php the_excerpt(); ?>
                </p>
                <a href="<?php echo esc_url( get_permalink() ) ?>" class="card-link">Read more</a>
            </div>
        </div>
    </div>
</div>