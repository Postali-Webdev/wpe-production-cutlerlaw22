<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>



<?php $hero_url = get_the_post_thumbnail_url(get_the_ID(), 'full_hd');
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

<?php if (have_rows('logos')): ?>
    <section class="logos-part">
        <div class="grid-container">
            <div class="grid-x grid-margin-x align-center-middle">

                <?php while (have_rows('logos')): the_row();
                    if ($image = get_sub_field('image')):?>

                        <?php if ($link = get_sub_field('link')): ?>
                            <a href="<?php echo $link; ?>" target="_blank" class="cell large-2 medium-3 small-6  grid-x align-center">
                        <?php endif; ?>

                        <img src="<?php echo $image['url']; ?>" alt="  <?php echo $image['alt']; ?>"
                             class="logos-part__image">

                        <?php if ($link): ?>
                            </a>
                        <?php endif; ?>

                    <?php endif;
                endwhile; ?>

                <?php if (have_rows('logo_snippets')):
                    while (have_rows('logo_snippets')): the_row();
                        echo get_sub_field('snippet', false, false);
                    endwhile;
                endif; ?>
                <style type="text/css">@font-face {
                        font-family: 'Circular-Bold';
                        src: url("https://assets.avvo.com/avvo-ui/0.20.5/fonts/avvo_ui/circular/circular_bold.woff") format("woff")
                    }

                    .avvo-badge .st0 {
                        fill: #153860 !important
                    }

                    .avvo-badge .st1 {
                        fill: #010101 !important
                    }

                    .avvo-badge .st2 {
                        fill: #15467A !important
                    }

                    .avvo-badge .st3 {
                        fill: #FFFFFF !important
                    }

                    .avvo-badge .st4 {
                        fill: none !important
                    }

                    .avvo-badge .st5 {
                        fill: #F89838 !important
                    }

                    .avvo-badge .st6 {
                        fill: #ED514C !important
                    }

                    .avvo-badge .st7 {
                        font-family: 'Circular-Bold', Avenir Next, Avenir, Century Gothic, sans-serif !important;
                        font-weight: bold !important
                    }

                    .avvo-badge .st8 {
                        font-size: 20px !important
                    }

                    .avvo-badge .st9 {
                        letter-spacing: -1px !important
                    }

                    .avvo-badge .st10 {
                        font-family: 'Circular-Bold', Avenir Next, Avenir, Century Gothic, sans-serif !important;
                        font-size: 14px
                    }

                    .avvo-badge .st11 {
                        font-size: 65px !important
                    }

                    .avvo-badge .st12 {
                        text-anchor: middle !important
                    }

                    .avvo-badge .st13 {
                        fill: #969696 !important
                    }

                    .avvo-badge .st14 {
                        display: none !important
                    }</style>
            </div>
        </div>
    </section>
<?php endif; ?>


<section class="vivamus_massa">
    <div class="grid-container">
        <div class="grid-x grid-margin-x align-center">
            <?php if ($item = get_field('vivamus_massa_title')): ?>
                <div class="cell text-center vivamus_massa__title">
                    <h2><?php echo $item ?></h2>
                </div>
            <?php endif; ?>
            <?php if (have_rows('vivamus_massa')): ?>
                <?php while (have_rows('vivamus_massa')): the_row();
                    $image = get_sub_field('image');
                    $title = get_sub_field('title');
                    $content = get_sub_field('short_info');
                    $image_link = get_sub_field('image_link');
                    $link_url = $image_link['url'];
                    $link_title = $image_link['title'];
                    $link_target = $image_link['target'] ? $image_link['target'] : '_self'; ?>
                    <div class="cell large-4 text-center vivamus_massa__single">
                        <?php $post_object = get_sub_field('page_link');
                        $post_id = $post_object->ID;
                        echo '<a href="' . $image_link['url'] . '"><img src="' . $image['url'] . '" alt="' . $image['alt'] . '" ></a>'; ?>

                        <?php if ($title) {
                            echo '<h3><a href="' . $image_link['url'] . '">' . $title . '</a></h3>';
                        }
                        if ($content) {
                            echo ' <div class="more-3 more-style"> <p>' . $content . '</p> </div>';
                        }
                        ?>
                    </div>
                <?php endwhile; ?>
            <?php endif;
            if ($link = get_field('vivamus_massa_all_link')): ?>
                <div class="cell text-center vivamus_massa__button">
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

<?php if ($quisque_vehicula_mauris = get_field('quisque_vehicula_mauris')): ?>
    <section class="banner quisque_vehicula_mauris list-decor no-image">
        <div class="banner__rotate bg-cover ">
            <div class="banner__content">
                <div class="banner__grid">
                    <div class="more more-style">
                        <?php echo $quisque_vehicula_mauris ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('lacinia_mattis') || get_field('lacinia_mattis_image')): ?>
    <section class="lacinia_mattis">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">

                <?php if ($lacinia_mattis = get_field('lacinia_mattis')): ?>
                    <div class="cell large-6">
                        <div class="lacinia_mattis__content">
                            <?php echo $lacinia_mattis ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($lacinia_mattis_image = get_field('lacinia_mattis_image')): ?>
                    <div class="cell large-6 text-right">
                        <div class="lacinia_mattis__images-container">
                            <div class="parallax" data-jarallax-element="60" data-scroll>
                                <div class="lacinia_mattis__images bg-cover "
                                     style="background-image: url(<?php echo $lacinia_mattis_image['url'] ?>);">

                                    <div class="lacinia_mattis__images_border-white-container">
                                        <div class="parallax" data-jarallax-element="-60" data-scroll>
                                            <div class="lacinia_mattis__images_border-white"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

<?php endif; ?>

<?php if (get_field('contact_content')): ?>
    <section class="banner contact-banner list-decor no-image">
        <div class="banner__rotate bg-cover">
            <div class="banner__content">
                <div class="grid-container fluid">
                    <?php the_field('contact_content'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="testimonial">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell">
                <?php if ($testimonials_name = get_field('testimonials_name')): ?>
                    <h4 class=" testimonial__name"><?php echo $testimonials_name ?></h4>
                <?php endif; ?>
                <div class="testimonial__container">

                    <?php if ($testimonials_title = get_field('testimonials_title')): ?>
                        <h2><?php echo $testimonials_title ?></h2>
                    <?php endif; ?>

                    <?php the_field('testimonials_content') ?>

                    <?php if ($link = get_field('testimonials_all_link')): ?>
                        <div class=" text-center">
                            <a class="button" href="<?php echo $link['url']; ?>" target="<?php if ($link['target']) {
                                echo $link['target'];
                            } else {
                                echo '_parent';
                            } ?>"><?php echo $link['title']; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($mvl_image = get_field('mvl_image')): ?>
    <section class="banner mvl list-decor no-image">
        <div class="banner__rotate bg-cover ">
            <div class="banner__content">
                <div class="grid-container fluid">
                    <div class="grid-x grid-margin-x">
                        <div class="cell large-6 medium-6 mvl__image">
                            <div class="mvl__image--inner">


                                <div class="parallax-text parallax" data-jarallax-element="40" data-scroll="in">
                                    <div class="parallax-text-top">
                                        <sup><?php the_field('parallax_text_sup') ?></sup>
                                        <?php the_field('parallax_text') ?>
                                        <span><?php the_field('parallax_text_sub') ?></span>
                                    </div>
                                    <!--                                    --><?php //if ($million_image = get_field('10_million_image')): ?>
                                    <!--                                        <img src="-->
                                    <?php //echo $million_image['url'] ?><!--"-->
                                    <!--                                             alt="-->
                                    <?php //echo $million_image['alt'] ?><!--" class="parallax-text-image">-->
                                    <!--                                    --><?php //endif; ?>

                                    <!--                                <h2><span>-->
                                    <?php //the_field('mvl_symbol') ?><!--</span>--><?php //the_field('mvl_title_number') ?>
                                    <!--                                </h2>-->
                                    <!--                                <h5 class="content">-->
                                    <?php //the_field('mvl_number_sub_title') ?><!--</h5>-->
                                </div>
                                <?php if ($mvl_image = get_field('mvl_image')): ?>
                                    <div class="mvl__image-container-border">
                                        <div class="mvl__image-container">

                                            <?php if ($million_image2 = get_field('10_million_image_white')): ?>
                                                <div class="parallax-text--inner">
                                                    <div class="parallax-text parallax" data-jarallax-element="40"
                                                         data-scroll="in">
                                                        <div class="parallax-text-bottom">
                                                            <sup><?php the_field('parallax_text_sup') ?></sup>
                                                            <?php the_field('parallax_text') ?>
                                                            <span><?php the_field('parallax_text_sub') ?></span>
                                                        </div>
                                                        <!--                                                                                                                <img src="-->
                                                        <!--                                                        -->
                                                        <?php //echo $million_image2['url'] ?><!--"-->
                                                        <!--                                                                                                                     alt="-->
                                                        <!--                                                        -->
                                                        <?php //echo $million_image2['alt'] ?><!--"-->
                                                        <!--                                                                                                                     class="parallax-text-image--inner">-->
                                                    </div>
                                                </div>

                                            <?php endif; ?>

                                            <img src="<?php echo $mvl_image['url'] ?>"
                                                 alt="<?php echo $mvl_image['alt'] ?>">
                                        </div>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="cell large-6  medium-6">

                            <div class="mvl_content">
                                <?php the_field('mvl_content') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($phasellus_sapien_orci = get_field('phasellus_sapien_orci')): ?>
    <section class="phasellus_sapien_orci">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="cell large-8 large-offset-2">
                    <div class="more-2 more-style">
                        <?php echo $phasellus_sapien_orci ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php
$posts = get_field('semper_portitor_sed');
if ($posts): ?>
    <?php if (count($posts) > 1): ?>
        <section class="semper_portitor_sed">
            <div class="grid-container fluid">
                <div class="grid-x grid-margin-x align-center">
                    <div class="cell semper_portitor_sed__title text-center">
                        <?php if ($semper_portitor_sed_title = get_field('semper_portitor_sed_title')): ?>
                            <h2><?php echo $semper_portitor_sed_title ?></h2>
                        <?php endif; ?>
                    </div>

                    <?php foreach ($posts as $p): // variable must NOT be called $post (IMPORTANT) ?>
                        <div class="cell large-3 medium-6 small-6 semper_portitor_sed__single">
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

                    <?php if ($link2 = get_field('all_team_link')): ?>
                        <div class="cell text-center semper_portitor_sed__button">
                            <a class="button" href="<?php echo $link2['url']; ?>" target="<?php if ($link2['target']) {
                                echo $link2['target'];
                            } else {
                                echo '_parent';
                            } ?>"><?php echo $link2['title']; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php else: ?>

        <section class="lacinia_mattis">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <?php foreach ($posts as $p): // variable must NOT be called $post (IMPORTANT) ?>
                        <?php if ($image = /*get_the_post_thumbnail_url($p -> ID)*/
                            get_field('mobile_image', $p->ID)): ?>
                            <div class="cell large-5 text-right">
                                <div class="lacinia_mattis__images-container lacinia_mattis__images-container--team">
                                    <div>
                                        <div class="lacinia_mattis__images lacinia_mattis__images--team bg-cover "
                                             style="background-image: url(<?php /*echo $image*/
                                             echo esc_url($image['url']); ?>);">

                                            <div class="lacinia_mattis__images_border-white-container">
                                                <div>
                                                    <div class="lacinia_mattis__images_border-white lacinia_mattis__images_border-white--team"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="cell large-7">
                            <div class="lacinia_mattis__content lacinia_mattis__content--team">
                                <?php if ($title = get_the_title($p->ID)): ?>
                                    <h2><?php echo $title; ?></h2>
                                <?php endif; ?>
                                <?php if ($text = get_field('excerpt', $p->ID)): ?>
                                    <?php echo $text; ?>
                                <?php endif; ?>
                                <?php if ($link = get_field('all_team_link')): ?>
                                    <a class="button" href="<?php echo esc_url($link['url']); ?>"
                                       target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo esc_html($link['title']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php endif; ?>
<?php endif; ?>

<?php if (get_field('contact_content')): ?>
    <section class="banner contact-banner list-decor no-image">
        <div class="banner__rotate bg-cover">
            <div class="banner__content">
                <div class="grid-container fluid">
                    <?php the_field('contact_content'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="tabs-part">
    <div class="tabs ">
        <?php if ($laoreet_dolore_title = get_field('laoreet_dolore_title')): ?>
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell">
                        <h2><?php echo $laoreet_dolore_title ?></h2>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (have_rows('faq')): ?>
            <?php while (have_rows('faq')): the_row(); ?>
                <div class="single_tab">
                    <div class="single_tab__container">
                        <div class="single_tab__title">
                            <?php if ($title = get_sub_field('title')): ?>
                                <h3><?php echo $title ?></h3>
                                <p class="hide-in-open">
                                    <?php echo wp_trim_words(get_sub_field('content'), 12, '...'); ?>
                                </p>

                            <?php endif; ?>
                            <span class="icon_tab"></span>
                        </div>
                        <div class="single_tab__content">
                            <p><?php the_sub_field('content') ?></p>
                            <?php if ($link = get_sub_field('link')): ?>
                                <a class="button" href="<?php echo esc_url($link['url']); ?>"
                                   target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><?php echo esc_html($link['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!--end of .columns -->
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>


<?php if (get_field('magna_volutpat') || get_field('magna_volutpat_image')): ?>
    <section class="bg-cover bottom-banner"
             style="background-image: url(<?php echo get_field('magna_volutpat_image')['url'] ?>);">
        <div class="grid-container">
            <div class="grid-x grid-margin-x align-center-middle">
                <div class="cell large-8 white">
                    <?php echo get_field('magna_volutpat') ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>



<?php get_footer(); ?>


