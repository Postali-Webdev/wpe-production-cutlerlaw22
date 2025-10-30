<?php
/*
Template Name: Custom Landing Page
*/
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');
remove_theme_support('genesis-menus');
add_action('genesis_loop', 'landing_custom_loop');
add_action('genesis_after_header', 'genesischild_top_wrap_widgets');
remove_action('genesis_before_loop', 'genesis-after-entry-widget-area');
remove_action('genesis_loop', 'genesis_do_loop');
?>
<?php
function genesischild_top_wrap_widgets()
{
    $hero_url = get_the_post_thumbnail_url(get_the_ID(), 'full_hd');
    $background_mobile = get_field('background_mobile', get_the_ID());
    ?>
    <section class="banner banner-top <?php echo (empty($hero_url)) ? 'empty' : null ?>">
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
                <?php if ($item = get_field('banner_title')): ?>
                    <div class="text-center banner__content-title">
                        <h1 class="banner__title"><?php echo $item ?></h1>
                    </div>
                <?php endif; ?>
                <?php if ($item2 = get_field('banner_sub_title')): ?>
                    <h3 class="banner__sub-title"><?php echo $item2 ?></h3>
                <?php endif; ?>
                <?php if ($link = get_field('banner_button')): ?>
                    <div class="button__container">
                        <a class="button" href="<?php echo $link['url']; ?>" target="<?php if ($link['target']) {
                            echo $link['target'];
                        } else {
                            echo '_parent';
                        } ?>"><?php echo $link['title']; ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php } ?>

<?php
function landing_custom_loop()
{ ?>
    <div class="landing-wrapper">
        <?php if ($hero_bottom_content = get_field('hero_bottom_content')): ?>
            <div class="grid-container">
                <div class="grid-x grid-margin-x align-center">
                    <div class="center-content section-container large-8">
                        <?php echo $hero_bottom_content; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $image_right = get_field('image_right');
        $image_left = get_field('image_left');
        ?>
        <div class="section-right-image section-container">
            <?php if ($content_left = get_field('content_left')): ?>
                <div class="left-content block-inner">
                    <?php echo $content_left; ?>
                </div>
            <?php endif; ?>

            <?php if ($image_right) : ?>
                <div class="right-image block-inner">
                    <?php echo wp_get_attachment_image($image_right['id'], 'large_high', false, array('class' => '')) ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($center_content_1 = get_field('center_content_1')): ?>
            <div class="center-content section-container">
                <?php echo $center_content_1; ?>
            </div>
        <?php endif; ?>
        <?php if ($center_content_2 = get_field('center_content_2')): ?>
            <div class="center-content section-container">
                <?php echo $center_content_2; ?>
            </div>
        <?php endif; ?>

        <div class="section-left-image section-container">
            <?php if ($image_left) : ?>
                <div class="left-image block-inner">
                    <?php echo wp_get_attachment_image($image_left['id'], 'large_high', false, array('class' => '')) ?>
                    <?php if ($title_and_description = get_field('title_and_description')): ?>
                        <div class="attorney-title">
                            <?php echo $title_and_description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="right-content block-inner">
                <?php $content_right = get_field('content_right'); ?>
                <?php echo $content_right; ?>
                <?php if ($link = get_field('content_right_link')): ?>
                    <a class="button " href="<?php echo esc_url($link['url']); ?>"
                       target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo esc_html($link['title']); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php } ?>


<?php
add_action('genesis_before_footer', 'custom_after_entry_content');
function custom_after_entry_content()
{ ?>
    <?php if (get_field('content_before_footer')): ?>
    <section class="banner quisque_vehicula_mauris no-image">
        <div class="banner__rotate  ">
            <div class="banner__content">
                <div class="banner__grid">
                    <div class="center-content">
                        <?php echo get_field('content_before_footer') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php } ?>


<?php
genesis();
?>
