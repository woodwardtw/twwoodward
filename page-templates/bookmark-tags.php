<?php
/**
 * Template Name: Bookmark Tags
 *
 * Template for displaying all bookmark tags with clickable links and counts.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}

// Get sort parameter
$sort = isset( $_GET['sort'] ) ? sanitize_text_field( wp_unslash( $_GET['sort'] ) ) : 'name';
?>

<div class="wrapper" id="bookmark-tags-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'page' );
					}
					?>

					<div class="bookmark-tags-container">
						<h2><?php esc_html_e( 'Browse Bookmarks by Tag', 'understrap' ); ?></h2>

						<!-- Sort Links -->
						<div class="bookmark-tags-sort">
							<p>
								<?php esc_html_e( 'Sort by: ', 'understrap' ); ?>
								<a href="<?php echo esc_url( add_query_arg( 'sort', 'name' ) ); ?>" class="<?php echo 'name' === $sort ? 'active' : ''; ?>">
									<?php esc_html_e( 'Alphabetically', 'understrap' ); ?>
								</a>
								|
								<a href="<?php echo esc_url( add_query_arg( 'sort', 'count' ) ); ?>" class="<?php echo 'count' === $sort ? 'active' : ''; ?>">
									<?php esc_html_e( 'By Count', 'understrap' ); ?>
								</a>
							</p>
						</div>

						<?php
						// Get all tags for bookmark post type
						$args = array(
							'taxonomy'   => 'post_tag',
							'hide_empty' => true,
							'object_ids' => get_posts(
								array(
									'post_type'      => 'bookmark',
									'posts_per_page' => -1,
									'fields'         => 'ids',
								)
							),
						);

						$tags = get_terms( $args );

						if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
							// Sort tags
							if ( 'count' === $sort ) {
								usort(
									$tags,
									function( $a, $b ) {
										return $b->count - $a->count;
									}
								);
							} else {
								usort(
									$tags,
									function( $a, $b ) {
										return strcmp( $a->name, $b->name );
									}
								);
							}

							echo '<ul class="bookmark-tags-list">';
							foreach ( $tags as $tag ) {
								$tag_url = add_query_arg( 'post_type', 'bookmark', get_term_link( $tag ) );
								echo '<li>';
								echo sprintf(
									'<a href="%s" class="bookmark-tag-link">%s</a> <span class="bookmark-tag-count">(%d)</span>',
									esc_url( $tag_url ),
									esc_html( $tag->name ),
									intval( $tag->count )
								);
								echo '</li>';
							}
							echo '</ul>';
						} else {
							echo '<p>' . esc_html__( 'No tags found for bookmarks.', 'understrap' ) . '</p>';
						}
						?>
					</div>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #bookmark-tags-wrapper -->

<?php
get_footer();
