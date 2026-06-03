<?php /* Template Name: Default with Cover Template */ ?>
<?php get_header(); ?>

<div class="rs-breadcrumbs bg7 breadcrumbs-overlay">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="rs-check-out sec-spacer">
    <div class="container">
        <div class="row">

        <?php
        the_content();
        ?>

        </div>
    </div>
</div>



<?php get_footer(); ?>