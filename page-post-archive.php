<?php /* Template Name: Post archive Template */ ?>
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

<div id="rs-courses-3" class="rs-gallery rs-event-details rs-courses-3 sec-spacer">
    <div class="container">

        <?php
        // 1. Get the post_type text field assigned to this page via ACF
        $page_post_type = get_field( 'post_type' );

        // 2. Query posts whose post_type ACF text field matches this page's value
        $query_args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        if ( ! empty( $page_post_type ) ) {
            $query_args['meta_query'] = array(
                array(
                    'key'     => 'post_type',
                    'value'   => $page_post_type,
                    'compare' => '=',
                ),
            );
        }

        $posts_query = new WP_Query( $query_args );

        // 3. First pass — collect unique filter tabs from post categories
        $filter_tabs = array(); // filter_key => label
        foreach ( $posts_query->posts as $post_item ) {
            $cats = get_the_category( $post_item->ID );
            if ( $cats ) {
                foreach ( $cats as $cat ) {
                    $key = 'cat-' . $cat->term_id;
                    if ( ! isset( $filter_tabs[ $key ] ) ) {
                        $filter_tabs[ $key ] = $cat->name;
                    }
                }
            }
        }
        ?>

        <div class="row mb-4">
            <div class="col-md-12">
                <?php
                $current_filter = isset( $_GET['filter'] ) ? sanitize_text_field( $_GET['filter'] ) : 'all';
                $base_url       = get_permalink();
                ?>
                <ul id="post-filter" class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="<?php echo esc_url( $base_url ); ?>" class="post-filter-btn btn btn-sm <?php echo $current_filter === 'all' ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="all">All</a>
                    </li>
                    <?php foreach ( $filter_tabs as $key => $label ) : ?>
                        <li class="list-inline-item">
                            <a href="<?php echo esc_url( add_query_arg( 'filter', $key, $base_url ) ); ?>" class="post-filter-btn btn btn-sm <?php echo $current_filter === $key ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="row g-4" id="post-grid">
            <?php if ( $posts_query->have_posts() ) : while ( $posts_query->have_posts() ) : $posts_query->the_post();
                $post_cats = get_the_category();
                $filter_keys = array();
                foreach ( $post_cats as $cat ) {
                    $filter_keys[] = 'cat-' . $cat->term_id;
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
                                <?php foreach ( $post_cats as $cat ) : ?>
                                    <span class="badge bg-primary"><?php echo esc_html( $cat->name ); ?></span>
                                <?php endforeach; ?>
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
                <div class="col-12"><p class="text-center text-muted">No posts found.</p></div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
(function () {
    var btns  = document.querySelectorAll('.post-filter-btn');
    var items = document.querySelectorAll('#post-grid .grid-item');

    function applyFilter(filter) {
        btns.forEach(function (b) {
            var isActive = b.getAttribute('data-filter') === filter;
            b.classList.toggle('active', isActive);
            b.classList.toggle('btn-primary', isActive);
            b.classList.toggle('btn-outline-primary', !isActive);
        });
        items.forEach(function (item) {
            var matches = filter === 'all' || item.getAttribute('data-filter').split(' ').indexOf(filter) !== -1;
            item.style.display = matches ? '' : 'none';
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
