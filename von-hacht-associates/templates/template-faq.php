<?php
/*
Template Name: FAQs Page
*/

//* Force full width content layout
// add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_entry_content'); // Add custom loop
add_action('genesis_after_header', 'genesischild_top_wrap_widgets');

function genesischild_top_wrap_widgets()
{
	$hero_url = get_the_post_thumbnail_url(get_the_ID(), 'full_hd');
	$background_mobile = get_field('background_mobile', get_the_ID());
	?>
	<section class="banner banner-single-post <?php echo (empty($hero_url)) ? 'empty' : null ?>">

		<div class="banner__rotate bg-cover white" data-mobile="<?php echo $background_mobile ?>"
		     style="background-image: url(<?php echo $hero_url ?>);">

			<?php if (!empty($background_mobile)): ?>
				<style>
					@media screen and (max-width: 960px) {
						.banner__rotate {
							background-image: url(<?php echo $background_mobile ?>) !important;
						}
				</style>
			<?php endif; ?>

			<div class="banner__content">

				<h1 class="banner__title"><?php the_title() ?></h1>

				<?php if ($item2 = get_field('position')): ?>
					<h3><?php echo $item2 ?></h3>
				<?php endif; ?>
				<?php if ($link = get_field('contact_link')): ?>
					<div class="button__container">
						<a class="button button--tranperent" href="<?php echo $link['url']; ?>"
						   target="<?php if ($link['target']) {
							   echo $link['target'];
						   } else {
							   echo '_parent';
						   } ?>"><?php echo $link['title']; ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>


<?php }

function custom_entry_content()
{ ?>
	<div id="main_container">
		<div class="default-page-container">

			<div class="grid-container">
				<div class="grid-x grid-margin-x list-decor">
                    <div class="cell">
                        <?php get_template_part('parts/core/breadcrumbs', null); ?>
                    </div>
                    <?php get_template_part( 'parts/core/category-dropdown' ); ?>
                    
					<div class="cell">

						<!-- testimonial post loop -->
						<?php

						// arguments, adjust as needed
						$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
						$args = array(
							'post_type' => 'faq',
							'post_status'    => 'publish',
							'posts_per_page' => get_option('posts_per_page'),
							'paged'          => $paged,
						);

						$id = get_the_ID();


						global $wp_query;
						$wp_query = new WP_Query( $args );

						if ($wp_query -> have_posts()) :  ?>
							<div class="faqs-list faqs-list-js">
								<?php 	while ( $wp_query -> have_posts() ) :  $wp_query -> the_post();
									get_template_part( 'parts/faqs/faq-item');
								endwhile; ?>
								<?php
								$paginateArgs = array(
									'base'      => '%#%',
									'format'    => '%#%',
									'current'   => $paged,
									'prev_next' => false,
									'total'     => $wp_query->max_num_pages
								); ?>
								<div class="cn-pagination">
									<?php echo str_replace(array('http:', '//'), array('', '') ,paginate_links( $paginateArgs )); ?>
								</div>
							</div>
							<?php

							remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
							do_action('genesis_after_endwhile'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }

genesis();
?>
