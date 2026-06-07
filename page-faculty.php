<?php /* Template Name: Faculty Page */ ?>
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
            <div class="col-lg-6 col-md-12 mobile-mb-50">
                <?php if ( has_post_thumbnail() ) : ?>
                <img alt="Faculty - Image"
                    src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>"
                    style="height:450px; width:600px">
                <?php endif; ?>

            </div>
            <div class="col-lg-6 col-md-12">
                <?php the_content(); ?>
            </div>
        </div>


    </div>
</div>



<div id="rs-team" class="rs-team sec-spacer">

    <div class="container">
        <div class="sec-title mb-50 text-center">
            <h2><span class="orange-color">Our</span> Faculties</h2>
            <p class="">
                Best Education For Your Kids
            </p>
        </div>

        <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true"
            data-autoplay-timeout="5000" data-smart-speed="1200" data-dots="true" data-nav="true" data-nav-speed="false"
            data-mobile-device="1" data-mobile-device-nav="true" data-mobile-device-dots="true" data-ipad-device="2"
            data-ipad-device-nav="true" data-ipad-device-dots="true" data-md-device="3" data-md-device-nav="true"
            data-md-device-dots="true">

            <?php
    $faculty_query = new WP_Query( array(
        'post_type'      => 'faculty',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'is_active',
                'value'   => '1',
                'compare' => '=',
            ),
        ),
    ) );

    if ( $faculty_query->have_posts() ) :
        while ( $faculty_query->have_posts() ) : $faculty_query->the_post();
            $instruments     = get_field( 'instrument' );
            $instrument_names = array();
            if ( $instruments ) {
                foreach ( $instruments as $instrument_post ) {
                    $instrument_names[] = get_the_title( $instrument_post );
                }
            }
            $instrument_label   = ! empty( $instrument_names ) ? implode( ', ', $instrument_names ) : '';
            $brief_introduction = get_field( 'brief_introduction' );
            $thumbnail_url      = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            $faculty_url        = get_permalink();
    ?>
            <div class="team-item">
                <div class="team-img">
                    <?php if ( $thumbnail_url ) : ?>
                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>" />
                    <?php endif; ?>
                    <div class="normal-text">
                        <h3 class="team-name"><?php the_title(); ?></h3>
                        <?php if ( $instrument_label ) : ?>
                        <span class="subtitle"><?php echo esc_html( $instrument_label ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="<?php echo esc_url( $faculty_url ); ?>">
                    <div class="team-content">
                        <div class="overly-border">
                        </div>
                        <div class="display-table">
                            <div class="display-table-cell">
                                <h3 class="team-name"><a
                                        href="<?php echo esc_url( $faculty_url ); ?>"><?php the_title(); ?></a></h3>
                                <?php if ( $instrument_label ) : ?>
                                <span class="team-title"><?php echo esc_html( $instrument_label ); ?></span>
                                <?php endif; ?>
                                <?php if ( $brief_introduction ) : ?>
                                <p class="team-desc">
                                    <?php echo wp_kses_post( $brief_introduction ); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>

        </div>
    </div>
</div>



<?php get_footer(); ?>