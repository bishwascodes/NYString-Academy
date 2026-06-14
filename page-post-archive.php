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
        // 1. Get the custom post type slug assigned to this page via ACF
        $post_type = ! empty( get_field( 'post_type' ) ) ? sanitize_key( get_field( 'post_type' ) ) : 'post';

        $current_filter = isset( $_GET['filter'] ) ? sanitize_text_field( $_GET['filter'] ) : 'all';
        $base_url       = get_permalink();
        $paged          = isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1;

        // 2. Find the first public taxonomy registered to this post type for filtering
        $filter_taxonomy = null;
        $all_taxonomies  = get_object_taxonomies( $post_type, 'objects' );
        foreach ( $all_taxonomies as $tax ) {
            if ( $tax->public && ! in_array( $tax->name, array( 'post_format' ), true ) ) {
                $filter_taxonomy = $tax->name;
                break;
            }
        }

        // 3. Build query
        $query_args = array(
            'post_type'      => $post_type,
            'posts_per_page' => 15,
            'post_status'    => 'publish',
            'paged'          => $paged,
        );

        if ( $current_filter !== 'all' && $filter_taxonomy ) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => $filter_taxonomy,
                    'field'    => 'slug',
                    'terms'    => $current_filter,
                ),
            );
        }

        $posts_query = new WP_Query( $query_args );

        // 4. Get filter tabs directly from the taxonomy
        $filter_tabs = $filter_taxonomy ? get_terms( array(
            'taxonomy'   => $filter_taxonomy,
            'hide_empty' => true,
        ) ) : array();
        ?>

        <?php if ( $filter_tabs && ! is_wp_error( $filter_tabs ) ) : ?>
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="<?php echo esc_url( $base_url ); ?>" class="post-filter-btn btn btn-sm <?php echo $current_filter === 'all' ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="all">All</a>
                    </li>
                    <?php foreach ( $filter_tabs as $term ) : ?>
                        <li class="list-inline-item">
                            <a href="<?php echo esc_url( add_query_arg( 'filter', $term->slug, $base_url ) ); ?>" class="post-filter-btn btn btn-sm <?php echo $current_filter === $term->slug ? 'btn-primary active' : 'btn-outline-primary'; ?>" data-filter="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <div class="row g-4" id="post-grid">
            <?php if ( $posts_query->have_posts() ) : while ( $posts_query->have_posts() ) : $posts_query->the_post();
                $badge_terms   = array();
                $filter_slugs  = array();
                foreach ( $all_taxonomies as $tax ) {
                    if ( ! $tax->public ) continue;
                    $terms = get_the_terms( get_the_ID(), $tax->name );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {
                            $badge_terms[] = $term->name;
                            if ( $filter_taxonomy && $tax->name === $filter_taxonomy ) {
                                $filter_slugs[] = $term->slug;
                            }
                        }
                    }
                }
            ?>
                <div class="col-lg-4 col-md-6 mb-4 grid-item" data-filter="<?php echo esc_attr( implode( ' ', $filter_slugs ) ); ?>">
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
            <?php endwhile; wp_reset_postdata(); else : ?>
                <div class="col-12"><p class="text-center text-muted">No posts found.</p></div>
            <?php endif; ?>
        </div>

        <?php
        $paginated_base = $current_filter !== 'all'
            ? add_query_arg( 'filter', $current_filter, $base_url )
            : $base_url;

        $pagination = paginate_links( array(
            'base'      => add_query_arg( 'paged', '%#%', $paginated_base ),
            'format'    => '',
            'current'   => $paged,
            'total'     => $posts_query->max_num_pages,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type'      => 'array',
        ) );
        ?>

        <div id="post-pagination">
        <?php if ( $pagination ) : ?>
            <nav class="mt-4" aria-label="Posts pagination">
                <ul class="pagination justify-content-center flex-wrap">
                    <?php foreach ( $pagination as $link ) : ?>
                        <li class="page-item<?php echo strpos( $link, 'current' ) !== false ? ' active' : ''; ?>">
                            <?php echo str_replace(
                                array( '<a ',    '<span ' ),
                                array( '<a class="page-link" ', '<span class="page-link" ' ),
                                $link
                            ); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
        </div>

    </div>
</div>

<script>
(function () {
    var grid       = document.getElementById('post-grid');
    var pagination = document.getElementById('post-pagination');

    function setLoading(on) {
        grid.style.opacity      = on ? '0.4' : '1';
        grid.style.pointerEvents = on ? 'none' : '';
    }

    function updateFilterButtons(activeFilter) {
        document.querySelectorAll('.post-filter-btn').forEach(function (b) {
            var isActive = b.getAttribute('data-filter') === activeFilter;
            b.classList.toggle('active', isActive);
            b.classList.toggle('btn-primary', isActive);
            b.classList.toggle('btn-outline-primary', !isActive);
        });
    }

    function fetchPage(url) {
        setLoading(true);
        fetch(url)
            .then(function (r) { return r.text(); })
            .then(function (html) {
                var doc       = new DOMParser().parseFromString(html, 'text/html');
                var newGrid   = doc.getElementById('post-grid');
                var newPaging = doc.getElementById('post-pagination');
                if (newGrid)   grid.innerHTML       = newGrid.innerHTML;
                if (newPaging) pagination.innerHTML = newPaging.innerHTML;
                var filter = new URL(url, location.href).searchParams.get('filter') || 'all';
                updateFilterButtons(filter);
                history.pushState(null, '', url);
                window.scrollTo({ top: grid.offsetTop - 20, behavior: 'smooth' });
            })
            .catch(function () { setLoading(false); })
            .finally(function () { setLoading(false); });
    }

    // Event delegation — covers dynamically replaced pagination links too
    document.addEventListener('click', function (e) {
        var filterBtn = e.target.closest('.post-filter-btn');
        var pageLink  = e.target.closest('#post-pagination .page-link');

        if (filterBtn) {
            e.preventDefault();
            var url = new URL(filterBtn.href, location.href);
            url.searchParams.delete('paged'); // reset to page 1 on filter change
            fetchPage(url.toString());
        } else if (pageLink && pageLink.href) {
            e.preventDefault();
            fetchPage(pageLink.href);
        }
    });

    window.addEventListener('popstate', function () {
        fetchPage(location.href);
    });
}());
</script>

<?php get_footer(); ?>
