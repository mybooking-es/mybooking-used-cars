<?php
/**
*		User car ARCHIVE
*  	-------------
*
* 	@version 0.0.3
*   @package WordPress
*   @subpackage Mybooking Used car Plugin
*   @since 1.0.0
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="page_content mybooking-used-cars">
	<div class="mb-container" id="content" tabindex="-1">
		<div class="mb-row">
			<div class="mb-col-md-12">

				<!-- Widgets top -->

				<?php if ( is_active_sidebar( 'sidebar-top' ) ) { ?>
					<div class="mybooking-used-cars_widget-area">
						 <?php dynamic_sidebar('sidebar-top'); ?>
					</div>
				<?php } ?>

				<!-- used cars loop ------------------------------------------------------->
				<div class="mybooking-used-cars_grid">

					<?php if ( have_posts() ) : ?>
					  <?php while ( have_posts() ) : the_post(); ?>

					    <?php include('loop-part.php'); ?>

					  <?php endwhile; ?>

					<!-- No content -->
					<?php else : ?>
					  <h3><?php echo esc_html_x( 'No content found. Please publish at least one camper to show something at here', 'blog_message', 'mybooking' ); ?></h3>
					<?php endif; ?>

				</div>

				<!-- Widgets bottom -->

				<?php if ( is_active_sidebar( 'sidebar-bottom' ) ) { ?>
					<div class="mybooking-used-cars_widget-area">
						 <?php dynamic_sidebar('sidebar-bottom'); ?>
					</div>
				<?php } ?>

				<!-- Pagination -->
				<div class="mb-col-md-12">
					<?php get_template_part( 'mybooking-parts/blog/mybooking-pagination' ); ?>
				</div>

			</div>
		</div>
	</div>
</div>

<?php get_footer();
