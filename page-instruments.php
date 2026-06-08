<?php /* Template Name: Instruments Page Template */ ?>
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

<div class="sec-spacer rs-event-details">
    <div class="container">

        <?php
        $instrument_query = new WP_Query( array(
            'post_type'      => 'instrument',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ) );
        ?>

        <div class="row g-4">
            <?php if ( $instrument_query->have_posts() ) : while ( $instrument_query->have_posts() ) : $instrument_query->the_post(); ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title(), 'class' => 'card-img-top w-100' ) ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top w-100">
                            <?php endif; ?>
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
                            </h4>
                            <p class="card-text text-muted small"><?php echo wp_trim_words( get_the_excerpt(), 20, '&hellip;' ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary mt-auto">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); else : ?>
                <div class="col-12"><p class="text-center text-muted">No instruments found.</p></div>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
