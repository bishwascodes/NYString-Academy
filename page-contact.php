<?php /* Template Name: Contact Page */ ?>
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


<div class="contact-page-section sec-spacer">
    <div class="container">

        <?php
        $locations_query = new WP_Query( array(
            'post_type'      => 'location',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ) );

        if ( $locations_query->have_posts() ) :
            while ( $locations_query->have_posts() ) : $locations_query->the_post();
                $phone_number  = get_field( 'phone_number' );
                $email         = get_field( 'email' );
                $address       = get_field( 'address' );
                $map_embed_code = get_field( 'map_embed_code' );
                $icon          = get_field( 'icon' );
        ?>
        <section class="location-item">
            <div class="abt-title">
                <?php if ( $icon ) : ?>
                    <span class="location-icon"><?php echo  $icon; ?></span>
                <?php endif; ?>
                <h2><?php the_title(); ?></h2>
            </div>

            <?php if ( $map_embed_code ) : ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo wp_kses( $map_embed_code, array(
                        'iframe' => array(
                            'src'             => array(),
                            'width'           => array(),
                            'height'          => array(),
                            'frameborder'     => array(),
                            'allowfullscreen' => array(),
                            'style'           => array(),
                            'loading'         => array(),
                            'referrerpolicy'  => array(),
                        ),
                    ) ); ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="row contact-address-section">
                <?php if ( $address ) : ?>
                <div class="col-md-4 pl-0">
                    <div class="contact-info contact-address">
                        <h4>Address</h4>
                        <p><?php echo wp_kses_post( $address ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $phone_number ) : ?>
                <div class="col-md-4">
                    <div class="contact-info contact-phone">
                        <h4>Contact Number</h4>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone_number ) ); ?>">
                            Call: <strong><?php echo esc_html( $phone_number ); ?></strong>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $email ) : ?>
                <div class="col-md-4 pr-0">
                    <div class="contact-info contact-email">
                        <h4>Email Address</h4>
                        <p>
                            <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>">
                                <strong><?php echo esc_html( antispambot( $email ) ); ?></strong>
                            </a>
                        </p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>


    </div>
</div>



<?php get_footer(); ?>