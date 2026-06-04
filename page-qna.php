<?php /* Template Name: Q&A Page */ ?>
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

<div class="sec-spacer">
    <div class="container">

        <div class="row">

            <?php if ( have_rows( 'faq_column' ) ) : ?>
            <div class="col-md-7">
                <div class="course-syllabus">
                    <?php while ( have_rows( 'faq_column' ) ) : the_row(); ?>
                    <h3 class="desc-title"><?php the_sub_field( 'faq_heading' ); ?></h3>

                    <?php if ( have_rows( 'faq_item' ) ) : ?>
                    <div id="accordion" class="rs-accordion-style1">
                        <?php $faq_index = 0; while ( have_rows( 'faq_item' ) ) : the_row();
                            $faq_id = 'faq-' . $faq_index++;
                        ?>
                        <div class="card">
                            <div class="card-header" id="<?php echo esc_attr( $faq_id ); ?>">
                                <h3 class="acdn-title collapsed" data-toggle="collapse" data-target="#<?php echo esc_attr( $faq_id ); ?>-view" aria-expanded="false" aria-controls="<?php echo esc_attr( $faq_id ); ?>-view">
                                    <span><?php the_sub_field( 'heading' ); ?></span>
                                </h3>
                            </div>
                            <div id="<?php echo esc_attr( $faq_id ); ?>-view" class="collapse" aria-labelledby="<?php echo esc_attr( $faq_id ); ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <?php the_sub_field( 'content' ); ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ( have_rows( 'form_column' ) ) : ?>
            <div class="col-md-5">
                <div class="leave-comments-area">
                    <?php while ( have_rows( 'form_column' ) ) : the_row(); ?>
                    <h3 class="desc-title"><?php the_sub_field( 'heading' ); ?></h3>
                    <?php echo do_shortcode( get_sub_field( 'form_shortcode' ) ); ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>