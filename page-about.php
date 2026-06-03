<?php /* Template Name: About Us Page */ ?>
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

<div class="rs-history sec-spacer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 mobile-mb-50 rs-vertical-top">
                <?php if ( has_post_thumbnail() ) : ?>
                <img alt="About Us - Image" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>" style="height:450px; width:600px">
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="abt-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="about-desc">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>