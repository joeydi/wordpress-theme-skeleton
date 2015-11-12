<?php

the_post();

get_header();

?>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
