<?php
/*
Plugin Name: Shortcode TinyMCE Plugin
Description: A WordPress plugin that will add a button to the tinyMCE editor to add shortcodes
Plugin URI: http://www.paulund.co.uk
Author: Paulund
Author URI: http://www.paulund.co.uk
Version: 1.0
License: GPL2
*/
if (!defined('ABSPATH')){
    exit("Do not access this file directly.");
}
define('BUTTONS_PATH', dirname(__FILE__) . '/');
define('BUTTONS_URL', plugins_url('', __FILE__));
define('BUTTONS_DIRNAME', dirname(plugin_basename(__FILE__)));

add_action( 'init', 'mythemeslug_buttons', 0 );

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'mythemeslug_buttons' ) ) {
	function mythemeslug_buttons() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
	        return;
	    }
 
	    if ( get_user_option( 'rich_editing' ) !== 'true' ) {
	        return;
	    }
		dw_add_head_js();
	    add_filter( 'mce_external_plugins', 'mythemeslug_add_buttons' );
	    add_filter( 'mce_buttons', 'mythemeslug_register_buttons' );
	}
}
 
if ( ! function_exists( 'mythemeslug_add_buttons' ) ) {
	function mythemeslug_add_buttons( $plugin_array ) {
	    $plugin_array['columns'] = BUTTONS_URL.'/js/tinymce_buttons.js';
	    return $plugin_array;
	}
}
 
if ( ! function_exists( 'mythemeslug_register_buttons' ) ) {
	function mythemeslug_register_buttons( $buttons ) {
	    array_push( $buttons, 'columns' );
	    return $buttons;
	}
}
 
if ( ! function_exists( 'dw_add_head_js' ) ) {
	function dw_add_head_js(){
		$combo = array(
			array(
				"text" => "Choose Page--",
				"value" => ""
			)
			
		);
		if ( is_admin() && !isset($_POST["action"])) {
			$posts = new WP_Query('post_type=any&posts_per_page=-1');
			$posts = $posts->posts;						  
				$i = 1;
				foreach($posts as $post) { 
				
					switch ($post->post_type) {
						case 'page':
							$permalink = get_page_link($post->ID);
							break;
						case 'post':
							$permalink = get_permalink($post->ID);
							break;
						case 'attachment':
							$permalink = get_attachment_link($post->ID);
							break;
						default:
							$permalink = get_post_permalink($post->ID);
							break;
					}
					
					$combo[$i]["text"] = $post->post_title;
					$combo[$i]["value"] = $permalink;
					$i++;
				}
				
	?>
	<script>
		var slideshow = <?php print json_encode($combo); ?>;
	</script>
	<?php
			
			
			//wp_enqueue_script( 'script-buttons', BUTTONS_URL.'/js/script.js',array('jquery'));
		}
	}
}

add_action('wp_footer', 'hook_footer_function');
function hook_footer_function() {
    $html = '<div id="sinovModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">&nbsp;</h4>
				  </div>
				  <div class="modal-body">
					<p>Some text in the modal.</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
			</div>';
	echo $html;
}


	wp_register_script( 'sinovJs',   plugins_url( '/js/script.js', __FILE__ ), array( 'jquery'));
	wp_enqueue_script( 'sinovJs' );


		
?>