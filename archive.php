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

        <?php
        // Resolve current post type from the archive URL
        $post_type = get_query_var( 'post_type' );
        if ( is_array( $post_type ) ) {
            $post_type = reset( $post_type );
        }
        if ( empty( $post_type ) ) {
            $post_type = 'post';
        }

        $current_filter = isset( $_GET['filter'] ) ? sanitize_text_field( $_GET['filter'] ) : 'all';
        $base_url       = get_post_type_archive_link( $post_type ) ?: home_url( '/' );
        $paged          = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : ( isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1 );

        // Find the first public taxonomy registered to this post type for filtering
        $filter_taxonomy = null;
        $all_taxonomies  = get_object_taxonomies( $post_type, 'objects' );
        foreach ( $all_taxonomies as $tax ) {
            if ( $tax->public && ! in_array( $tax->name, array( 'post_format' ), true ) ) {
                $filter_taxonomy = $tax->name;
                break;
            }
        }

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

        $archive_query = new WP_Query( $query_args );

        // Get filter tabs directly from the taxonomy
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
                        <a href="<?php echo esc_url( $base_url ); ?>" class="btn btn-sm <?php echo $current_filter === 'all' ? 'btn-primary active' : 'btn-outline-primary'; ?>">All</a>
                    </li>
                    <?php foreach ( $filter_tabs as $term ) : ?>
                        <li class="list-inline-item">
                            <a href="<?php echo esc_url( add_query_arg( 'filter', $term->slug, $base_url ) ); ?>" class="btn btn-sm <?php echo $current_filter === $term->slug ? 'btn-primary active' : 'btn-outline-primary'; ?>"><?php echo esc_html( $term->name ); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php if ( $archive_query->have_posts() ) : while ( $archive_query->have_posts() ) : $archive_query->the_post();
                $badge_terms = array();
                foreach ( $all_taxonomies as $tax ) {
                    if ( ! $tax->public ) continue;
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
            <?php endwhile; wp_reset_postdata(); else : ?>
                <div class="col-12"><p class="text-center text-muted">No items found.</p></div>
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
            'total'     => $archive_query->max_num_pages,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type'      => 'array',
        ) );
        ?>

        <?php if ( $pagination ) : ?>
            <nav class="mt-4" aria-label="Archive pagination">
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

<?php get_footer(); ?>
