<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php
		the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

		<div class="entry-meta">
			Saved on <?php echo esc_html( get_the_date() ); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php
		// Display tags for bookmarks, linking to other bookmarks with the same tag
		if ( 'bookmark' === get_post_type() ) {
			$tags = get_the_tags();
			if ( $tags ) {
				echo '<div class="bookmark-tags">';
				echo esc_html( 'Tags: ' );
				$tag_links = array();
				foreach ( $tags as $tag ) {
					$tag_url = add_query_arg( 'post_type', 'bookmark', get_term_link( $tag ) );
					$tag_links[] = sprintf(
						'<a href="%s" rel="tag">%s</a>',
						esc_url( $tag_url ),
						esc_html( $tag->name )
					);
				}
				echo wp_kses_post( implode( ', ', $tag_links ) );
				echo '</div>';
			}
		}
		?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
