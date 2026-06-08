<?php
if ( ! get_field( 'is_active' ) ) {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 );
    exit;
}
?>
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

<div class="rs-team-single pt-100">
    <div class="container">
        <div class="row team">
            <div class="col-lg-4 col-md-12">
                <div class="team-photo mobile-mb-40">

                    <?php
                    $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if ($img) : ?>
                    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    <?php endif; ?>

                    <h3 class="team-name"><?php the_title(); ?></h3>

                </div>
            </div>
            <div class="col-lg-8 col-md-12">

                <?php $instrument = get_field(‘instrument’); ?>
                <?php if ($instrument) : ?>
                <h4 class="desc-title">Instrument</h4>
                <p style="display:block; border:1px solid #f1f1f1; padding:10px;">
                    <?php foreach ($instrument as $post) : setup_postdata($post); ?>
                        <?php echo esc_html($post->post_title); ?>
                    <?php endforeach; wp_reset_postdata(); ?>
                </p>
                <?php endif; ?>

                <?php if (have_rows(‘education’)) : ?>
                <h4 class="desc-title">Education</h4>
                <p style="display:block; border:1px solid #f1f1f1; padding:10px;">
                    <?php while (have_rows(‘education’)) : the_row(); ?>
                        <?php the_sub_field(‘degree’); ?><br>
                    <?php endwhile; ?>
                </p>
                <?php endif; ?>

                <?php $brief_introduction = get_field(‘brief_introduction’); ?>
                <?php if ($brief_introduction) : ?>
                <h4 class="desc-title">About teacher</h4>
                <p style="display:block; border:1px solid #f1f1f1; padding:10px;">
                    <?php echo wp_kses_post($brief_introduction); ?>
                </p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>


<!-- faculty sec -->

<?php
$args = array(
    'post_type' => 'faculty',
    'posts_per_page' => -1,
    'post__not_in' => array(get_queried_object_id())
);

$faculty_query = new WP_Query($args);

if($faculty_query->have_posts()) :
?>


<div id="rs-team" class="rs-team sec-spacer">
    <div class="blue-overlay"></div>
    <div class="container">
        <div class="sec-title mb-50 text-center">
           <h2><span class="orange-color">More</span> Faculties</h2>
           <p class="">
                Best Education For Your Kids
			</p>
        </div>
        <div id="rs-team-slider-inside-faculty-page">
            <?php
while($faculty_query->have_posts()) :
    $faculty_query->the_post();

    $is_active = get_field('is_active');

    if($is_active){

        $instrument = get_field('instrument');
        $title = get_the_title();
        $permalink = get_permalink();
        $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');
?>

            <div class="team-item">

                <div class="team-img">

                    <?php if($img){ ?>
                    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>">
                    <?php } ?>

                    <div class="normal-text">

                        <h3 class="team-name"><?php echo esc_html($title); ?></h3>

                        <?php
                        
                        if($instrument){
                            ?>
                        <p>
                            <?php
                            foreach($instrument as $post_item){
       
                            echo '<span>' . esc_html($post_item->post_title) . '</span>';

                            }
                           ?>
                        </p>
                        <?php 
                        }
                        
                        ?>

                    </div>
                </div>

                <?php if($permalink){ ?>
                <a href="<?php echo esc_url($permalink); ?>">
                    <?php } ?>

                    <div class="team-content">
                        <div class="overly-border"></div>
                        <div class="display-table">
                            <div class="display-table-cell">

                                <h3><?php echo esc_html($title); ?></h3>

                                <?php
                        
                        if($instrument){
                            ?>
                                <p>
                                    <?php
                            foreach($instrument as $post_item){
       
                            echo '<span>' . esc_html($post_item->post_title) . '</span>';

                            }
                           ?>
                                </p>
                                <?php 
                        }
                        
                        ?>

                            </div>
                        </div>
                    </div>

                    <?php if($permalink){ ?>
                </a>
                <?php } ?>

            </div>

            <?php
    }

endwhile;

wp_reset_postdata();
?>
        </div>
    </div>
</div>

<?php endif; ?>


<?php get_footer(); ?>