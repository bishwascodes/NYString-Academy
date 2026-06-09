<?php
/*
Template Name: home Page
*/

get_header();

$args = array(
    'post_type' => 'slide',
    'posts_per_page' => -1
);

$query = new WP_Query($args);

if($query->have_posts()) :
?>



<div id="rs-slider" class="slider-overlay-2">
    <div id="home-slider">

        <?php
while($query->have_posts()) :
    $query->the_post();

    $status = get_field('status');

    if($status){

        $slider_title  = get_field('slider_title');
        $slide_image   = get_field('slide_image');
        $slide_content = get_field('slide_content');
        $button_url    = get_field('button_url');
?>

        <div class="item">

            <?php if($slide_image){ ?>
            <img src="<?php echo esc_url($slide_image['url']); ?>" alt="<?php echo esc_attr($slide_image['alt']); ?>">
            <?php } ?>

            <div class="mid-sec">

                <?php if($slider_title){ ?>
                <?php echo $slider_title; ?>
                <?php } ?>

                <?php if($slide_content){ ?>
                <p><?php echo $slide_content; ?></p>
                <?php } ?>

                <?php if($button_url){ 

                    $target = !empty($button_url['target']) ? $button_url['target'] : '_self';
                ?>

                <a href="<?php echo esc_url($button_url['url']); ?>" target="<?php echo esc_attr($target); ?>"
                    class="sl-get-started-btn">

                    <?php echo esc_html($button_url['title']); ?>

                </a>

                <?php } ?>

            </div>

        </div>

        <?php
    }

endwhile;

wp_reset_postdata();
?>
    </div>
</div>
<?php endif; ?>

<!-- location-sec -->

<div class="rs-services rs-services-style1">
    <div class="container">
        <div class="row">
            <?php $location = get_field( 'location' ); 

        if( $location ) {
            foreach( $location as $post_item ) {
        $title = $post_item->post_title;
        $permalink = get_permalink( $post_item->ID );
        $phone =get_field('phone_number',$post_item->ID );
        $icon=get_field('icon',$post_item->ID );

                ?>
            <div class="col-lg-6 col-md-6" style="cursor:pointer"
                id="<?php if($title =='Fort Lee'){ echo 'fort_div';} else{echo 'morris_div';} ?>">
                <div
                    class="services-item <?php if($title =='Fort Lee'){ echo 'blue-color';} else{echo 'orange-color';} ?> rs-animation-hover">
                    <?php if($icon){?>
                    <div class="services-icon">
                        <?php echo $icon; ?>
                    </div>
                    <?php } ?>
                    <a class="services-desc">
                        <h4 class="services-title"><?php echo esc_html($title);?></h4>
                        <?php if($phone){?>
                        <p>
                            <?php echo esc_html($phone); ?>
                        </p>
                        <?php } ?>
                    </a>
                </div>
            </div>
            <?php
            }
        }
?>
        </div>
    </div>
</div>
<!-- about-us-sec -->
<div id="fortlee_view">

    <div id="rs-about" class="rs-about sec-spacer fort_sec active">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <?php
                    $about_image = get_field( 'about_image' );
                    if( $about_image ) {
                        ?>
                    <div class="about-img">
                        <img src="<?php echo esc_url( $about_image['url'] ); ?>"
                            alt="<?php echo esc_attr( $about_image['alt'] ); ?>">
                    </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="sec-title mb-50">
                        <?php
                        $about_title = get_field( 'about_title' );

                        echo $about_title ;
                        ?>
                        <?php 
                    $about_sub_title = get_field( 'about_sub_title' );
                    if( $about_sub_title ) {
                        ?>
                        <p> <?php echo esc_html( $about_sub_title );?></p>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                        $about_desc = get_field( 'about_desc' );
                        if( $about_desc ) {
                            echo $about_desc; // Already safe HTML from the editor
                        }              ?>
                </div>
            </div>
        </div>
    </div>
    <div id="rs-about" class="rs-about sec-spacer morris_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="sec-title mb-50">
                        <?php
                        $about_title = get_field( 'about_morris_title' );

                        echo $about_title ;
                        ?>
                        <?php 
                    $about_sub_title = get_field( 'about_morris_sub_title' );
                    if( $about_sub_title ) {
                        ?>
                        <p> <?php echo esc_html( $about_sub_title );?></p>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                        $about_desc = get_field( 'about_morris_desc' );
                        if( $about_desc ) {
                            echo $about_desc; // Already safe HTML from the editor
                        }              ?>
                </div>
                <div class="col-lg-6 col-md-12">
                    <?php
                    $about_image = get_field( 'about_morris_image' );
                    if( $about_image ) {
                        ?>
                    <div class="about-img">
                        <img src="<?php echo esc_url( $about_image['url'] ); ?>"
                            alt="<?php echo esc_attr( $about_image['alt'] ); ?>">
                    </div>
                    <?php
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>

</div>
<!-- programs-sec -->
<?php
$home_locations = get_field( 'location' );
if ( $home_locations ) :

    // Build location metadata: ID → slug, div_id, card_color, title
    $loc_meta = array();
    foreach ( $home_locations as $loc_post ) {
        $slug = sanitize_title( $loc_post->post_title );
        $loc_meta[ $loc_post->ID ] = array(
            'title'      => $loc_post->post_title,
            'slug'       => $slug,
            'div_id'     => ( $loc_post->post_title === 'Fort Lee' ) ? 'fort_div' : 'morris_div',
            'card_color' => ( $loc_post->post_title === 'Fort Lee' ) ? 'blue-color' : 'orange-color',
        );
    }

    $first_slug = reset( $loc_meta )['slug'];

    // Single query — fetch all programs belonging to any of the home page locations
    $or_clauses = array( 'relation' => 'OR' );
    foreach ( $home_locations as $loc_post ) {
        $or_clauses[] = array(
            'key'     => 'available_locations',
            'value'   => '"' . $loc_post->ID . '"',
            'compare' => 'LIKE',
        );
    }
    $programs_query = new WP_Query( array(
        'post_type'      => 'program',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => $or_clauses,
    ) );
?>

<?php if ( $programs_query->have_posts() ) : ?>

<style>
.programs-section .cource-item { display: none; }
.programs-section .loc-title    { display: none; }
<?php foreach ( $loc_meta as $meta ) : $s = esc_attr( $meta['slug'] ); ?>
.programs-section.active-<?php echo $s; ?> .cource-item.loc-<?php echo $s; ?> { display: block; }
.programs-section.active-<?php echo $s; ?> .loc-title.loc-<?php echo $s; ?>    { display: block; }
<?php endforeach; ?>
</style>

<div class="rs-courses programs-section active-<?php echo esc_attr( $first_slug ); ?>">
    <div class="container">
        <div class="sec-title mb-50 text-center">
            <?php foreach ( $loc_meta as $meta ) : ?>
            <h2 class="loc-title loc-<?php echo esc_attr( $meta['slug'] ); ?>">
                <?php echo esc_html( $meta['title'] ); ?> Programs
            </h2>
            <?php endforeach; ?>
        </div>
        <div class="row instrument_slider">
            <?php while ( $programs_query->have_posts() ) : $programs_query->the_post();
                $prog_locs     = get_field( 'available_locations' );
                $loc_classes   = array();
                $primary_color = '';

                if ( $prog_locs ) {
                    foreach ( $prog_locs as $prog_loc ) {
                        if ( isset( $loc_meta[ $prog_loc->ID ] ) ) {
                            $loc_classes[] = 'loc-' . $loc_meta[ $prog_loc->ID ]['slug'];
                            if ( empty( $primary_color ) ) {
                                $primary_color = $loc_meta[ $prog_loc->ID ]['card_color'];
                            }
                        }
                    }
                }

                if ( empty( $loc_classes ) ) continue;
            ?>
            <div class="cource-item <?php echo esc_attr( $primary_color . ' ' . implode( ' ', $loc_classes ) ); ?>">
                <div class="cource-img">
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ); ?>"
                        alt="<?php the_title_attribute(); ?>">
                    <a class="image-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#CC0000" width="30px">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.975 14.51a1.05 1.05 0 0 0 0-1.485 2.95 2.95 0 0 1 0-4.172l3.536-3.535a2.95 2.95 0 1 1 4.172 4.172l-1.093 1.092a1.05 1.05 0 0 0 1.485 1.485l1.093-1.092a5.05 5.05 0 0 0-7.142-7.142L9.49 7.368a5.05 5.05 0 0 0 0 7.142c.41.41 1.075.41 1.485 0zm2.05-5.02a1.05 1.05 0 0 0 0 1.485 2.95 2.95 0 0 1 0 4.172l-3.5 3.5a2.95 2.95 0 1 1-4.171-4.172l1.025-1.025a1.05 1.05 0 0 0-1.485-1.485L3.87 12.99a5.05 5.05 0 0 0 7.142 7.142l3.5-3.5a5.05 5.05 0 0 0 0-7.142 1.05 1.05 0 0 0-1.485 0z"
                                    fill="#CC0000"></path>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="course-body">
                    <a href="<?php the_permalink(); ?>" class="course-category"><?php the_title(); ?></a>
                    <h4 class="course-title">
                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_excerpt(), 10 ); ?></a>
                    </h4>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>

<script>
(function () {
    var section  = document.querySelector('.programs-section');
    var locMap   = <?php echo json_encode( array_combine(
        array_column( $loc_meta, 'div_id' ),
        array_column( $loc_meta, 'slug' )
    ) ); ?>;
    var allSlugs = <?php echo json_encode( array_values( array_column( $loc_meta, 'slug' ) ) ); ?>;

    if ( ! section ) return;

    Object.keys( locMap ).forEach( function ( divId ) {
        var tab = document.querySelector( '#' + divId );
        if ( ! tab ) return;

        tab.addEventListener( 'click', function () {
            var active = locMap[ divId ];
            allSlugs.forEach( function ( slug ) {
                section.classList.toggle( 'active-' + slug, slug === active );
            } );
        } );
    } );
}());
</script>

<?php endif; ?>
<?php endif; ?>
<!-- blog-sec -->

<?php
$post_type = 'blog';

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'   => 'post_type',
            'value' => $post_type
        )
    )
);

$blog_query = new WP_Query($args);

if($blog_query->have_posts()) :
?>

<div id="rs-courses" class="rs-courses sec-spacer">
    <div class="container">

        <div class="sec-title mb-50 text-center">
            <?php $blog_title = get_field( 'blog_title' );
                if( $blog_title ) {
                    echo $blog_title; // Already safe HTML from the editor
                }
                $blog_subtitle = get_field( 'blog_subtitle' );
                if( $blog_subtitle ) {?>
            <p class="">
                <?php echo esc_html( $blog_subtitle ); ?>
            </p>
            <?php }
                    ?>
            </p>
        </div>

        <div class="row">

            <?php while($blog_query->have_posts()) : $blog_query->the_post();

            $title     = get_the_title();
            $permalink = get_permalink();
            $img       = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $posttitle = get_field('post_title');
        ?>

            <div class="col-md-4" style="position:relative;">

                <div class="news_inner">
                    <a href="<?php echo esc_url($permalink); ?>">
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>">
                    </a>
                </div>

                <div
                    style="background-color:#efefef; padding:20px; text-align:center; height:88px; position:absolute;bottom:0; right:10px; width:calc(100% - 20px);">

                    <h4 class="course-title" style="padding:0;margin:0">

                        <a href="<?php echo esc_url($permalink); ?>" style="color:#222; font-weight:300;">

                            <?php
                        if($posttitle){
                            echo esc_html($posttitle);
                        } else {
                            echo esc_html($title);
                        }
                        ?>

                        </a>

                    </h4>

                </div>

            </div>

            <?php endwhile; ?>

        </div>
    </div>
</div>

<?php endif; wp_reset_postdata(); ?>
<!-- video-sec -->
<?php $image_url = get_field( 'image_url' ); 
 $youtube_url = get_field( 'youtube_url' );
 if($image_url){ ?>
<div id="rs-video" class="rs-video bg9" style="background-image:url(<?php echo esc_url( $image_url ) ?>)">
    <div class="container">
        <div class="video-content">
            <a class="popup-youtube" href="<?php echo esc_url($youtube_url); ?>" title="Video Icon">
                <i class="fa fa-play"></i>
            </a>
            <span>TAKE A VIDEO</span>
        </div>
    </div>
</div>
<?php } ?>
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
            <?php
            $faculty_title = get_field( 'faculty_title' );
            if( $faculty_title ) {
                echo $faculty_title; // Already safe HTML from the editor
            }
            $faculty_subtitle = get_field( 'faculty_subtitle' );
            if( $faculty_subtitle ) {
                ?>
            <p class="">
                <?php echo esc_html( $faculty_subtitle ); ?>
            </p>
            <?php
                
            }
?>
        </div>
        <div id="rs-team-slider">
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
<!-- instagram-sec -->
<div class="rs-gallery-4 rs-gallery">
    <div class="container">
        <div class="sec-title mb-50 text-center">
            <h2><span class="orange-color">Photo(Instagram)</span></h2>
            <p class="">
                Music Education For Your Kids
            </p>
        </div>

        <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
        <div class="elfsight-app-2abd21b1-6ab5-45d4-a849-63ab56eca408" data-elfsight-app-lazy></div>

    </div>
</div>
<!-- news section -->
<?php
$post_type = 'news';

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'   => 'post_type',
            'value' => $post_type,			
        )
    )
);

$news_query = new WP_Query($args);

if($news_query->have_posts()) :
?>
<div id="rs-courses" class="rs-courses sec-spacer">
    <div class="container">
        <div class="sec-title mb-50 text-center">
            <?php
        $news_title = get_field( 'news_title' );
			$news_subtitle = get_field( 'news_subtitle' );
        if( $news_title ) {
            echo $news_title; // Already safe HTML from the editor
        }
        if( $news_subtitle ) {
            ?>
            <p class="">
                <?php echo esc_html( $news_subtitle ); ?>

            </p>

            <?php
}
?>

        </div>
        <div class="row">
            <?php
        while($news_query->have_posts()) :
            $news_query->the_post();

                $title = get_the_title();
                $permalink = get_permalink();
                $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $posttitle =get_field('post_title');
			    
        ?>
            <div class="col-md-4" style="position:relative;">
                <div class="news_inner">
                    <a href="<?php echo $permalink; ?>"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>"
                            title=""></a>
                </div>
                <div
                    style="background-color:#efefef; padding:20px; ; text-align:center; height:88px; position:absolute;bottom:0; right:10px; width:calc(100% - 20px);">
                    <h4 class="course-title" style="padding:0;margin:0"><a href="<?php echo $permalink; ?>"
                            style="color:#222; font-weight:300;">
                            <?php if($posttitle){echo esc_html($posttitle);}else{echo esc_html(title);} ?>
                        </a></h4>
                </div>
            </div>
            <?php endwhile; ?>


        </div>
    </div>
</div>

<?php endif; wp_reset_postdata();?>

<!-- homework reward section -->
<?php
$post_type = 'homework_rewards';

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'   => 'post_type',
            'value' => $post_type
        )
    )
);

$home_query = new WP_Query($args);

if($home_query->have_posts()) :
?>

<div id="rs-courses" class="rs-courses sec-spacer">
    <div class="container">

        <div class="sec-title mb-50 text-center">
            <?php
            $homework_reward_title = get_field( 'homework_reward_title' );
            if( $homework_reward_title ) {
                echo $homework_reward_title; // Already safe HTML from the editor
            }
            $homework_reward_subtitle = get_field( 'homework_reward_subtitle' );
            if( $homework_reward_subtitle ) {
                ?>
            <p class="">
                <?php echo esc_html( $homework_reward_subtitle ); ?>
            </p>
            <?php
                
            }
            ?>

        </div>

        <div class="row">

            <?php while($home_query->have_posts()) : $home_query->the_post();

            $title     = get_the_title();
            $permalink = get_permalink();
            $img       = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $posttitle = get_field('post_title');
        ?>

            <div class="col-md-4" style="position:relative;">

                <div class="news_inner">
                    <a href="<?php echo esc_url($permalink); ?>">
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>">
                    </a>
                </div>

                <div
                    style="background-color:#efefef; padding:20px; text-align:center; height:88px; position:absolute;bottom:0; right:10px; width:calc(100% - 20px);">

                    <h4 class="course-title" style="padding:0;margin:0">

                        <a href="<?php echo esc_url($permalink); ?>" style="color:#222; font-weight:300;">

                            <?php
                        if($posttitle){
                            echo esc_html($posttitle);
                        } else {
                            echo esc_html($title);
                        }
                        ?>

                        </a>

                    </h4>

                </div>

            </div>

            <?php endwhile; ?>

        </div>
    </div>
</div>


<?php endif; wp_reset_postdata(); ?>
<?php get_footer(); ?>