<?php

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">

	<?php

	if ( have_comments() ) :
		?>
		<h2 class="fs-4 comments-title">
			<?php
			$restrict_content_posts_comment_count = get_comments_number();
			if ( '1' === $restrict_content_posts_comment_count ) {
				printf(
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'restrict-content-posts' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 

					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $restrict_content_posts_comment_count, 'comments title', 'restrict-content-posts' ) ),
					number_format_i18n( $restrict_content_posts_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'restrict-content-posts' ); ?></p>
			<?php
		endif;

	endif;

	comment_form();
	?>

</div>
