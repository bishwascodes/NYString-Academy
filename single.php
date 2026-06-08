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

<div class="sec-spacer rs-event-details">
    <div class="container">

<div class="row">

    <div class="col-md-12">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="event-details-content">

            <h3 class="event-title"><?php the_title(); ?></h3>
            <div class="event-meta">
                <div class="event-date">
                    <i class="fa fa-calendar"></i>
                    <span><?php echo get_the_date(); ?></span>
                </div>
                <div class="event-time">
                    <i class="fa fa-user"></i>
                    <span><span class="sv_member"><?php the_author(); ?></span></span>
                </div>
            </div>

            <div class="event-img">
                    <?php the_post_thumbnail(); ?>
            </div>

            <div class="event-desc">
                       <?php the_content(); ?>


            </div>

        </div>
        <?php endwhile; endif; ?>
    </div>

</div>


<?php the_posts_pagination(); ?>



<script>
function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
jQuery(function($) {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    $("#bo_v_atc").viewimageresize();
});
</script>
</div>
</div>

<?php get_footer(); ?>