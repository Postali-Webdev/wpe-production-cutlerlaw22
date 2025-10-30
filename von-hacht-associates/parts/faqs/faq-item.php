<article class="faq">
    <?php if (has_post_thumbnail()) :
        the_post_thumbnail('large', array(
            'class' => 'faq__image'
        ));
    endif;?>
    <div class="faq__content">
	    <a href="<?php the_permalink(); ?>" class="faq__link"><h2 class="faq__title"><?php the_title(); ?></h2></a>
        <?php
        //Delete post->ID If in post loop
        $content = get_extended( get_post_field( 'post_content') );
        if ( ! empty( $content ) ): ?>
            <p><?php echo $content['extended'] ? $content['main'] : wp_trim_words( get_the_content( null, false), 55 ); ?></p>
        <?php endif; ?>
        <a class="faq__read-more" href="<?php the_permalink(); ?>"><?php _e('Read More') ?></a>
    </div>
</article>