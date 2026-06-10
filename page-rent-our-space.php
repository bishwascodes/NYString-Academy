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

        <?php
        $current_filter = isset( $_GET['filter'] ) ? sanitize_text_field( $_GET['filter'] ) : 'all';
        $base_url       = get_permalink();
        ?>
        <div class="row mb-4">
            <div class="col-md-12">
                <ul id="rental-filter" class="list-inline text-center">
                    <li class="list-inline-item"><a href="<?php echo esc_url( $base_url ); ?>" class="rental-filter-btn btn btn-sm <?php echo $current_filter === 'all' ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="all">All</a></li>
                    <?php if ( ! is_wp_error( $rental_terms ) ) : foreach ( $rental_terms as $term ) : ?>
                        <li class="list-inline-item"><a href="<?php echo esc_url( add_query_arg( 'filter', $term->slug, $base_url ) ); ?>" class="rental-filter-btn btn btn-sm <?php echo $current_filter === $term->slug ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
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

        <div class="row g-4" id="rental-grid">
            <?php if ( $rental_query->have_posts() ) : while ( $rental_query->have_posts() ) : $rental_query->the_post();
                $terms      = get_the_terms( get_the_ID(), 'rental-type' );
                $term_slugs = ( ! is_wp_error( $terms ) && $terms ) ? implode( ' ', wp_list_pluck( $terms, 'slug' ) ) : '';
                $first_term = ( ! is_wp_error( $terms ) && $terms ) ? reset( $terms ) : null;
            ?>
                <div class="col-lg-4 col-md-6 grid-item mb-4" data-filter="<?php echo esc_attr( $term_slugs ); ?>">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="course-img position-relative overflow-hidden" onclick="location.href='<?php the_permalink(); ?>'" style="cursor:pointer">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title(), 'class' => 'card-img-top w-100' ) ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top w-100">
                            <?php endif; ?>
                            <?php if ( $first_term ) : ?>
                                <span class="badge bg-primary position-absolute top-0 start-0 m-2">
                                    <?php echo esc_html( $first_term->name ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text text-muted small"><?php echo wp_trim_words( get_the_excerpt(), 20, '&hellip;' ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); else : ?>
                <div class="col-12"><p class="text-center text-muted">No rental spaces found.</p></div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
(function () {
    var btns  = document.querySelectorAll('.rental-filter-btn');
    var items = document.querySelectorAll('#rental-grid .grid-item');

    function applyFilter(filter) {
        btns.forEach(function (b) {
            var isActive = b.getAttribute('data-filter') === filter;
            b.classList.toggle('active', isActive);
            b.classList.toggle('btn-primary', isActive);
            b.classList.toggle('btn-outline-primary', !isActive);
        });
        items.forEach(function (item) {
            var keys = item.getAttribute('data-filter').split(' ');
            item.style.display = (filter === 'all' || keys.indexOf(filter) !== -1) ? '' : 'none';
        });
    }

    // Apply filter from URL on load
    var params = new URLSearchParams(window.location.search);
    applyFilter(params.get('filter') || 'all');

    btns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var filter = btn.getAttribute('data-filter');
            var url = new URL(window.location.href);
            if (filter === 'all') {
                url.searchParams.delete('filter');
            } else {
                url.searchParams.set('filter', filter);
            }
            history.pushState(null, '', url.toString());
            applyFilter(filter);
        });
    });

    // Handle browser back/forward
    window.addEventListener('popstate', function () {
        var p = new URLSearchParams(window.location.search);
        applyFilter(p.get('filter') || 'all');
    });
}());
</script>

<?php get_footer(); ?>
