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

        <?php
        $faq_column  = get_field( ‘faq_column’ );
        $form_column = get_field( ‘form_column’ );
        ?>
        <div class="row">

            <?php if ( $faq_column ) : ?>
            <div class="col-md-7">
                <div class="course-syllabus">
                    <?php if ( ! empty( $faq_column[‘faq_heading’] ) ) : ?>
                    <h3 class="desc-title"><?php echo esc_html( $faq_column[‘faq_heading’] ); ?></h3>
                    <?php endif; ?>

                    <?php if ( ! empty( $faq_column[‘faq_item’] ) ) : ?>
                    <div id="accordion" class="rs-accordion-style1">
                        <?php foreach ( $faq_column[‘faq_item’] as $index => $item ) :
                            $faq_id = ‘faq-’ . $index;
                        ?>
                        <div class="card">
                            <div class="card-header" id="<?php echo esc_attr( $faq_id ); ?>">
                                <h3 class="acdn-title collapsed" data-toggle="collapse" data-target="#<?php echo esc_attr( $faq_id ); ?>-view" aria-expanded="false" aria-controls="<?php echo esc_attr( $faq_id ); ?>-view">
                                    <span><?php echo esc_html( $item[‘heading’] ); ?></span>
                                </h3>
                            </div>
                            <div id="<?php echo esc_attr( $faq_id ); ?>-view" class="collapse" aria-labelledby="<?php echo esc_attr( $faq_id ); ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <?php echo wp_kses_post( $item[‘content’] ); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ( $form_column ) : ?>
            <div class="col-md-5">
                <div class="leave-comments-area">
                    <?php if ( ! empty( $form_column[‘heading’] ) ) : ?>
                    <h3 class="desc-title"><?php echo esc_html( $form_column[‘heading’] ); ?></h3>
                    <?php endif; ?>

                    <?php if ( ! empty( $form_column[‘form_shortcode’] ) ) : ?>
                    <?php echo do_shortcode( $form_column[‘form_shortcode’] ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>