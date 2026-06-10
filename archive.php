<?php get_header(); ?>

<div class="rs-breadcrumbs bg7 breadcrumbs-overlay">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title"><?php the_archive_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="rs-courses-3" class="rs-gallery rs-event-details rs-courses-3 sec-spacer">
    <div class="container">

        <div class="row g-4">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

                // Collect all public taxonomy terms for badge display
                $post_taxonomies = get_object_taxonomies( get_post_type(), 'objects' );
                $badge_terms     = array();
                foreach ( $post_taxonomies as $tax ) {
                    if ( ! $tax->public ) {
                        continue;
                    }
                    $terms = get_the_terms( get_the_ID(), $tax->name );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {
                            $badge_terms[] = $term->name;
                        }
                    }
                }
            ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="position-relative overflow-hidden" onclick="location.href='<?php the_permalink(); ?>'" style="cursor:pointer">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title(), 'class' => 'card-img-top w-100', 'style' => 'height:220px;object-fit:cover;' ) ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top w-100" style="height:220px;object-fit:cover;">
                            <?php endif; ?>
                            <?php if ( $badge_terms ) : ?>
                                <div class="position-absolute top-0 start-0 m-2 d-flex flex-wrap gap-1">
                                    <?php foreach ( $badge_terms as $badge ) : ?>
                                        <span class="badge bg-primary"><?php echo esc_html( $badge ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text text-muted small"><?php echo wp_trim_words( get_the_excerpt(), 20, '&hellip;' ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary mt-auto">Learn More</a>
                        </div>
                    </div>
                </div>

            <?php endwhile; else : ?>
                <div class="col-12"><p class="text-center text-muted">No items found.</p></div>
            <?php endif; ?>
        </div>

        <?php
        the_posts_pagination( array(
            'mid_size'           => 2,
            'prev_text'          => '&laquo; Previous',
            'next_text'          => 'Next &raquo;',
            'screen_reader_text' => ' ',
        ) );
        ?>

    </div>
</div>

<?php get_footer(); ?>
