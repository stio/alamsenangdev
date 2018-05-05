<?php

/**

 * The template for displaying all single posts.

 *

 * @package storefront

 */



get_header(); ?>

<style>
.popup {
    display: none;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(125,125,125,0.5);
    z-index: 1;
}
.panel-widget-style:hover {
    cursor: zoom-in;
}
.popup .wrap {
    background:#e1e1e1; 
    margin: 0 auto;
    width:50%; 
    position:relative; 
    z-index:41;
    top: 10%;
    padding:10px; 
    -webkit-box-shadow:0 0 10px rgba(0,0,0,0.4);
    -moz-box-shadow:0 0 10px rgba(0,0,0,0.4); 
    box-shadow:0 0 10px rgba(0,0,0,0.4);
    border-radius: 5px;
}
.popup .wrap img {
    height: 100%;
    vertical-align: top;
    width: 100%;
}
</style>
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

