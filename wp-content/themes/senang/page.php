<?php

/**

 * The template for displaying all single posts.

 *

 * @package storefront

 */



get_header(); ?>

<!-- The Modal -->
<div class="popup"></div>
<script type="text/javascript">
$(window).load(function(){

function showPopup(imgSrc) {
    var theImg = '<div class="wrap"><img src="'+imgSrc+'"></div>';
    $(".popup").empty().append(theImg).fadeIn();
}

$("#img1 img").on('click',function (){
    var theSrc = $(this).attr('src');
    showPopup(theSrc);
});
$("#img2 img").on('click',function (){
    var theSrc = $(this).attr('src');
    showPopup(theSrc);
});
$("#img3 img").on('click',function (){
    var theSrc = $(this).attr('src');
    showPopup(theSrc);
});
$("#img4 img").on('click',function (){
    var theSrc = $(this).attr('src');
    showPopup(theSrc);
});



$(".popup").on('click', ".wrap", function(){
    $(".popup").fadeOut();
})

});
</script>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">



		<?php while ( have_posts() ) : the_post();



			do_action( 'storefront_single_post_before' );



			get_template_part( 'content', 'single' );



			do_action( 'storefront_single_post_after' );



		endwhile; // End of the loop. ?>



		</main><!-- #main -->

	</div><!-- #primary -->



<?php

do_action( 'storefront_sidebar' );

get_footer();

