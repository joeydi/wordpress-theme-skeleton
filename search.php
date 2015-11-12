<?php

get_header();

?>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php if ( is_single() ) : ?>
                    <?php the_content(); ?>
                    <?php else : ?>
                    <h3><?php the_date(); ?></h3>
                    <h1><a href="<?php the_permalink(); ?>"><?php Fervor::the_title(); ?></a></h1>
                    <?php the_excerpt(); ?>
                    <?php endif; ?>
                <?php endwhile; else : ?>
                    <h1>Sorry, there are no posts.</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
