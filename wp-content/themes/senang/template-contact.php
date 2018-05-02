<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Contact
 *
 * @package alamsenang
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">			
			<div class="row">
				<div class="col-md-12">
					<?php echo custom_breadcrumbs(); ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header></div>
				<div class="col-md-12">
				<div style="line-height: 22px;">
				<?php while ( have_posts() ) : the_post();
					?>
					<div style="line-height:200%;font-size:15px;">
						<?php the_content(); ?>
					</div>
					
					<?php endwhile;?>
				</div>
				</div>
				<div class="col-md-6">
					<br>
					<?php echo do_shortcode('[contact-form-7 id="157" title="Contact form 1"]');?>
				</div>
				<div class="col-md-6">
					<br>
					<div id="map">My map will go here</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
	<script type="text/javascript">
	function initMap() {
        var myLatLng = {lat: -8.569009, lng: 115.309418};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Bambu Bali'
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGUxS8hIRe7XXGXaWe0sUISoxPXyCEYnI&callback=initMap"></script>
	
<?php
get_footer();?>

