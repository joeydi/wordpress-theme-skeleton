<?php get_header(); ?>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="sidebar">
                    <h3>Categories</h3>
                    <?php wp_list_categories( 'title_li=' ); ?>

                    <h3>Archive</h3>
                    <?php wp_get_archives( 'type=yearly' ); ?>
                </div>
            </div>
            <div class="col-sm-9">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php if ( is_single() ) : ?>
                    <?php the_content(); ?>
                    <?php else : ?>
                    <h3><?php the_date(); ?></h3>
                    <h1><a href="<?php the_permalink(); ?>"><?php OSLC::the_title(); ?></a></h1>
                    <?php the_excerpt(); ?>
                    <?php endif; ?>

                <?php endwhile; ?>
                    <?php wp_pagenavi(); ?>
                <?php else : ?>
                    <h1>Sorry, there are no posts.</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
