<?php
/**
 * The template for displaying a Sitemap.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 *
 * Template Name: Sitemap
 */
?>
<?php get_header(); ?>

<?php //get_sidebar(); ?>

	<div id="content" role="main">

		<?php
		/**
		 * stormbringer_content_before hook.
		 *
		 * @hooked stormbringer_breadcrumb - 10
		 */
		do_action( 'stormbringer_content_before' );
		?>

		<?php if ( have_posts() ) : the_post(); ?>

			<?php
			get_template_part( 'content', 'page' );
			?>

		<?php endif; ?>

		<!-- .sitemap-content -->
		<section class="sitemap-content">
			<div class="row">
				<div class="col-md-6">
					<h3><?php _e( 'Pages', 'stormbringer' ) ?></h3>
					<ul>
						<?php wp_list_pages( 'depth=0&sort_column=menu_order&title_li=' ); ?>
					</ul>
				</div>

				<div class="col-md-6">

					<?php
					$args       = array(
						'public'   => true,
						'_builtin' => false
					);
					$output     = 'objects'; // names or objects, note names is the default
					$operator   = 'and'; // 'and' or 'or'
					$post_types = get_post_types( $args, $output, $operator );
					foreach ( $post_types as $post_type ) : ?>
						<h3><?php echo $post_type->labels->name; ?></h3>
						<ul>
							<?php
							$args  = array(
								'numberposts'      => - 1,
								'post_type'        => $post_type->name,
								'orderby'          => 'post_title',
								'order'            => 'ASC',
								'suppress_filters' => 0
							);
							$posts = get_posts( $args );
							$i     = 0;
							if ( $posts ) {
								foreach ( $posts as $post ) :
									setup_postdata( $post );
									?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php
								endforeach;
							}
							?>
						</ul>
					<?php endforeach; ?>

				</div>

			</div>
		</section>
		<!-- /.sitemap-content -->

		<?php
		/**
		 * stormbringer_content_after hook.
		 */
		do_action( 'stormbringer_content_after' );
		?>

	</div>
	<!-- /#content -->

<?php get_footer(); ?>