<?php /* Template Name: Faculty Page */ ?>
<?php get_header(); ?>
<style type="text/css">
main-content .h2 {
    font-size: 30px;
    line-height: normal;
    margin-bottom: 20px;
    padding-bottom: 16px;
    text-transform: uppercase;
    position: relative;
}

main-content h2:after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 5px;
    width: 100px;
    background-color: #ff3115;
}
</style>

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


<div class="rs-history sec-spacer main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 mobile-mb-50">
                <?php if ( has_post_thumbnail() ) : ?>
                <img alt="Faculty - Image"
                    src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>"
                    style="height:450px; width:600px">
                <?php endif; ?>

            </div>
            <div class="col-lg-6 col-md-12">
                <?php the_content(); ?>
            </div>
        </div>


    </div>
</div>



<!-- faculty sec -->

<?php
$args = array(
    'post_type' => 'faculty',
    'posts_per_page' => -1
);

$faculty_query = new WP_Query($args);

if($faculty_query->have_posts()) :
?>


<div id="rs-team" class="rs-team sec-spacer">
    <div class="blue-overlay"></div>
    <div class="container">
        <div class="sec-title mb-50 text-center">
           <h2><span class="orange-color">Our</span> Faculties</h2>
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