<?php get_header(); ?>

<div class="rs-breadcrumbs bg7 breadcrumbs-overlay">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="rs-courses-3" class="rs-gallery rs-event-details rs-courses-3 sec-spacer">
    <div class="container">

        <?php
        // 1. Query all published library posts
        $library_query = new WP_Query( array(
            'post_type'      => 'library',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ) );

        // 2. First pass — collect unique filter tabs from library-cat taxonomy
        $filter_tabs = array(); // slug => label
        foreach ( $library_query->posts as $library_post ) {
            $cats = get_the_terms( $library_post->ID, 'library-cat' );
            if ( $cats && ! is_wp_error( $cats ) ) {
                foreach ( $cats as $cat ) {
                    if ( ! isset( $filter_tabs[ $cat->slug ] ) ) {
                        $filter_tabs[ $cat->slug ] = $cat->name;
                    }
                }
            }
        }

        $current_filter = isset( $_GET['filter'] ) ? sanitize_text_field( $_GET['filter'] ) : 'all';
        $base_url       = get_post_type_archive_link( 'library' );
        ?>

        <div class="row mb-4">
            <div class="col-md-12">
                <ul id="library-filter" class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="<?php echo esc_url( $base_url ); ?>" class="library-filter-btn btn btn-sm <?php echo $current_filter === 'all' ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="all">All</a>
                    </li>
                    <?php foreach ( $filter_tabs as $slug => $label ) : ?>
                        <li class="list-inline-item">
                            <a href="<?php echo esc_url( add_query_arg( 'filter', $slug, $base_url ) ); ?>" class="library-filter-btn btn btn-sm <?php echo $current_filter === $slug ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="row g-4" id="library-grid">
            <?php if ( $library_query->have_posts() ) : while ( $library_query->have_posts() ) : $library_query->the_post();
                $library_cats = get_the_terms( get_the_ID(), 'library-cat' );
                $filter_keys  = array();
                if ( $library_cats && ! is_wp_error( $library_cats ) ) {
                    foreach ( $library_cats as $cat ) {
                        $filter_keys[] = $cat->slug;
                    }
                }
                $filter_attr = implode( ' ', $filter_keys );
            ?>
                <div class="col-lg-4 col-md-6 mb-4 grid-item" data-filter="<?php echo esc_attr( $filter_attr ); ?>">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="position-relative overflow-hidden" onclick="location.href='<?php the_permalink(); ?>'" style="cursor:pointer">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title(), 'class' => 'card-img-top w-100', 'style' => 'height:220px;object-fit:cover;' ) ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top w-100" style="height:220px;object-fit:cover;">
                            <?php endif; ?>
                            <div class="position-absolute top-0 start-0 m-2 d-flex flex-wrap gap-1">
                                <?php if ( $library_cats && ! is_wp_error( $library_cats ) ) : foreach ( $library_cats as $cat ) : ?>
                                    <span class="badge bg-primary"><?php echo esc_html( $cat->name ); ?></span>
                                <?php endforeach; endif; ?>
                            </div>
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
            <?php endwhile; wp_reset_postdata(); else : ?>
                <div class="col-12"><p class="text-center text-muted">No library items found.</p></div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
(function () {
    var btns  = document.querySelectorAll('.library-filter-btn');
    var items = document.querySelectorAll('#library-grid .grid-item');

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
