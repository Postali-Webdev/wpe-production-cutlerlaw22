<?php
/*
Template Name: Testimonial Page
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
{
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	// arguments, adjust as needed
	$args = array(
	'post_type' => 'testimonial',
	'posts_per_page' => get_option('posts_per_page'),
	'paged'          => $paged,
	);

	global $wp_query;
	$wp_query = new WP_Query($args);

	if ($wp_query -> have_posts()) : ?>
	<div id="main_container">
		<div class="default-page-container">

			<div class="grid-container">
				<div class="grid-x grid-margin-x testimonials">
                    <div class="cell">
                        <?php get_template_part('parts/core/breadcrumbs', null); ?>
                    </div>
					<?php
					while ( $wp_query -> have_posts() ) :  $wp_query -> the_post(); ?>
						<div class="testimonial">
							<div class="testimonial__inner">
								<?php if($author = get_field('author')): ?>
									<div class="testimonial__wrapper">
										<span class="testimonial__author"><?php echo $author; ?></span>
									</div>
								<?php endif; ?>
								<h2 class="testimonial__title"><?php the_title(); ?></h2>
								<?php the_content(); ?>
							</div>
						</div>
					<?php endwhile;
					$big = 999999999; // need an unlikely integer
					$paginateArgs = array(
						'base'  => str_replace( $big, '%#%', esc_url (get_pagenum_link( $big )) ),
						'format' => '/page/%#%',
						'current'   => $paged,
						'prev_next' => false,

						'total' => $wp_query->max_num_pages
					);?>
					<div class="testimonials__pagination">
						<?php echo paginate_links( $paginateArgs );?>
					</div>
					<?php

					remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
					do_action('genesis_after_endwhile'); ?>

				</div>

			</div>
		</div>
	</div>
	<?php  endif;
	wp_reset_query();
 }

genesis();
?>
