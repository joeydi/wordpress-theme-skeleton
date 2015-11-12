<?php

the_post();

get_header();

?>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="filters">
                    <form action="<?php echo site_url( '/' ); ?>" method="get">
                        <label for="filter_search">
                            <h3>Try searching our site below</h3>
                        </label>
                        <div>
                            <input type="text" name="s" id="filter_search" value="<?php echo get_search_query(); ?>">
                            <button type="submit" class="submit"><span>Search</span> <i class="fa fa-chevron-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
