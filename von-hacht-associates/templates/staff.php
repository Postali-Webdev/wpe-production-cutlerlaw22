<?php
/*
Template Name: Staff Page
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
                <div class="grid-x grid-margin-x align-center list-decor">

                    <div class="cell">
                        <?php get_template_part('parts/core/breadcrumbs', null); ?>
                    </div>
                    <?php
                    $posts = get_field('staff_list');
                    if ($posts): ?>
                        <?php foreach ($posts as $p): // variable must NOT be called $post (IMPORTANT) ?>
                            <div class="cell medium-6 small-12 semper_portitor_sed__single semper_portitor_sed__single--team-template">
                                <?php if (get_field('mobile_image', $p->ID)): ?>
                                    <a href="<?php echo get_permalink($p->ID); ?>"
                                       style="background-image: url(<?php echo get_the_post_thumbnail_url($p->ID) ?>);"
                                       class="semper_portitor_sed__post bg-cover hide-for-small-only">
                                        <span class="semper_portitor_sed__post-title"><?php echo get_the_title($p->ID); ?></span>
                                    </a>
                                    <a href="<?php echo get_permalink($p->ID); ?>"
                                       style="background-image: url(<?php echo get_field('mobile_image', $p->ID)['url'] ?>);"
                                       class="semper_portitor_sed__post bg-cover show-for-small-only">
                                        <span class="semper_portitor_sed__post-title"><?php echo get_the_title($p->ID); ?></span>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo get_permalink($p->ID); ?>"
                                       style="background-image: url(<?php echo get_the_post_thumbnail_url($p->ID) ?>);"
                                       class="semper_portitor_sed__post bg-cover">
                                        <span class="semper_portitor_sed__post-title"><?php echo get_the_title($p->ID); ?></span>
                                    </a>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php }

genesis();
?>

