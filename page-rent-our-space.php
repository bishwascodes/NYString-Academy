<?php /* Template Name: Rent Our Space Template */ ?>
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

<div class="rs-gallery rs-event-details sec-spacer">
    <div class="container">

        <?php
        $rental_terms = get_terms( array(
            'taxonomy'   => 'rental-type',
            'hide_empty' => true,
        ) );
        ?>

        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12">
                <ul id="rental-filter">
                    <li><a href="#" class="rental-filter-btn active" data-filter="all">All</a></li>
                    <?php if ( ! is_wp_error( $rental_terms ) ) : foreach ( $rental_terms as $term ) : ?>
                        <li><a href="#" class="rental-filter-btn" data-filter="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
        </div>

        <?php
        $rental_query = new WP_Query( array(
            'post_type'      => 'rental',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ) );
        ?>

        <div class="row" id="rental-grid">
            <?php if ( $rental_query->have_posts() ) : while ( $rental_query->have_posts() ) : $rental_query->the_post();
                $terms      = get_the_terms( get_the_ID(), 'rental-type' );
                $term_slugs = ( ! is_wp_error( $terms ) && $terms ) ? implode( ' ', wp_list_pluck( $terms, 'slug' ) ) : '';
                $first_term = ( ! is_wp_error( $terms ) && $terms ) ? reset( $terms ) : null;
            ?>
                <div class="col-lg-4 col-md-6 grid-item" data-filter="<?php echo esc_attr( $term_slugs ); ?>">
                    <div class="course-item">
                        <div class="course-img" onclick="location.href='<?php the_permalink(); ?>'" style="cursor:pointer">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <?php if ( $first_term ) : ?>
                                <div class="course-toolbar">
                                    <h4 class="course-category">
                                        <a href="<?php echo esc_url( get_term_link( $first_term ) ); ?>"><?php echo esc_html( $first_term->name ); ?></a>
                                    </h4>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h4 class="course-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p><?php echo wp_trim_words( get_the_excerpt(), 20, '&hellip;' ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); else : ?>
                <div class="col-md-12"><p>No rental spaces found.</p></div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
(function () {
    var btns  = document.querySelectorAll('.rental-filter-btn');
    var items = document.querySelectorAll('#rental-grid .grid-item');

    btns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            btns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');

            var filter = btn.getAttribute('data-filter');
            items.forEach(function (item) {
                if (filter === 'all' || item.getAttribute('data-filter').split(' ').indexOf(filter) !== -1) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
}());
</script>

<?php get_footer(); ?>
