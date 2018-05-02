<?php 
require_once('libs/wp_bootstrap_navwalker.php');
add_action( 'after_setup_theme', 'wpt_setup' );
if ( ! function_exists( 'wpt_setup' ) ):
	function wpt_setup() {	
		register_nav_menu( 'primary', __( 'Primary navigation', 'wp_sinov' ) );
	} 
	
	function wpt_register_js() {
		wp_register_script('bootstrap.min', get_stylesheet_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js');
		wp_register_script( 'slim', get_stylesheet_directory_uri() . '/assets/jquery/jquery-3.2.1.slim.min.js' , ARRAY('jcf'));
		wp_register_script( 'poper',  get_stylesheet_directory_uri() . '/assets/jquery/popper.min.js' );
		wp_register_script( 'newsbox',  'https://www.jquery-az.com/boots/js/newsbox/jquery.bootstrap.newsbox.min.js',array('jquery'));
		wp_register_script('jcf', get_stylesheet_directory_uri() . '/assets/jcf/js/jcf.js',array('jquery'));
		wp_enqueue_script('jcf');
		wp_enqueue_script('bootstrap.min');
		wp_enqueue_script( 'poper' );
		wp_enqueue_script( 'newsbox' );
		
	}

	function wpt_register_css() {
		wp_register_style( 'bootstrap.min', get_stylesheet_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
		wp_register_style( 'fontawesome.min', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'bootstrap.min' );
		//wp_enqueue_style( 'fontawesome.min' );
		wp_register_style( 'jcf', get_stylesheet_directory_uri() . '/assets/jcf/css/theme-minimal/jcf.css',array('style'));
		wp_register_style( 'customcss', get_stylesheet_directory_uri() . 'style.css',array('style'));
		wp_enqueue_style( 'jcf' );
		$parent_style = 'storefront-style';
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/assets/web/css/app.css',
			array( $parent_style ),
			wp_get_theme()->get('Version')
		);	
	}

	add_action( 'wp_enqueue_scripts', 'wpt_register_css' );
	if(!is_admin())
		add_action( 'init', 'wpt_register_js' );

	wp_enqueue_style( 'customcss' );
	
	add_theme_support( 'post-thumbnails' );
	define('WOOCOMMERCE_USE_CSS', false);
endif;

add_theme_support( 'woocommerce' );

function theme_prefix_setup() {
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-width' => true,
	) );
	
	add_image_size('slidewide',false,420,true);
	add_image_size('small',320,390,false);
	

}

add_action( 'init', 'create_post_type', 0 );

function create_post_type()
{

  $labels_project = array(
    'name' => _x( 'Popups', 'Popup' ),
    'singular_name' => _x( 'Popup', 'Popup' ),
    'search_items' =>  __( 'Search Popup' ),
    'all_items' => __( 'All Popup' ),
    'parent_item_colon' =>"",
    'edit_item' => __( 'Edit Popup' ),
    'update_item' => __( 'Update Popup' ),
    'add_new_item' => __( 'Add New Popup' ),
    'new_item_name' => __( 'New Popup' ),
    'menu_name' => __( 'Popups' ),
  );


 $args_project = array(
        'labels' => $labels_project,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => null,
        'supports' => array( 'title', 'editor' ),
        'rewrite' => array('slug' => 'popup', 'with_front' => true),
		'query_var' => true,
		'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
		'capability_type' => 'post',
		'menu_icon' => get_template_directory_uri().'/inc/images/menu-room.png',
    );

  register_post_type( 'popups' , $args_project );
}

add_action( 'after_setup_theme', 'theme_prefix_setup' );

if(function_exists('register_sidebar')){
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'widget-sidebar',
		'description' => 'Appears as the sidebar on the custom homepage',
		'before_widget' => '<div class="sidebar">',
		'after_widget' => '</div>',
	));
	
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'page-sidebar',
		'description' => 'Appears as the sidebar on the page',
		'before_widget' => '<div id="sidebar" class="sidebar">',
		'after_widget' => '</div>',
	));
}

// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumb';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="breadcrumb-item i item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
  
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="breadcrumb-item item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="breadcrumb-item item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
 
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="breadcrumb-item item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="breadcrumb-item item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="breadcrumb-item item-cat">'.$parents.'</li>';
                    
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="breadcrumb-item  item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="breadcrumb-item item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
               
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="breadcrumb-item item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="breadcrumb-item item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="breadcrumb-item item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="breadcrumb-item item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            //echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="breadcrumb-item item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            //echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="breadcrumb-item item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="breadcrumb-item item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            //echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="breadcrumb-item item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="breadcrumb-item item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="breadcrumb-item item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}

function storefront_page() {
	front_loop_before();
}

function front_loop_before(){
	custom_breadcrumbs();
}

function front_loop_after(){
	print "";
}

function homepage_content(){
	get_template_part( 'content', 'home' );
}


function loop_header(){
	?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php 
}

// remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);
// add_action('woocommerce_single_product_summary','woocommerce_output_product_data_tabs',60);


add_action('storefront_page','storefront_page');
add_action('woocommerce_before_main_content','front_loop_before');
add_action('home','homepage_content');
add_action('senang_loop_post','loop_post');
add_action('senang_single_post','senang_single_post');

function senang_single_post(){
	custom_breadcrumbs();
	?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<media class="pull-left">
		<?php 
		if (has_post_thumbnail()) { ?>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail("large",array("class"=>"media-object")); ?></a>
		<?php 
		}
		?>
	</media>
	<div class="content-post">
	<?php the_content(); ?>
	</div>
	<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aslibali' ),
		'after'  => '</div>',
	) );
	?>
	<div class="clearfix"></div>
	<?php 

}

function loop_post(){
	global $post;
	?>
	<div class="well">
		<div class="media">
			<?php if (has_post_thumbnail()) { ?>
			<a class="pull-left" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail("thumbnail",array("class"=>"media-object")); ?></a>
			<?php }
			else{
				?>
				<a class="pull-left" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="media-object" src="/dev/alamsenang/wp-content/themes/senang/images/logo.png"></a>
				<?php
			}
			?>
			
			<div class="media-body">
				<h3 class="media-heading"><a class="link" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				  <p class="text-left"><span style="font-style:italic;text-transform:capiltalize;"><?php the_author(); ?></span></p>
				  <p><?php
					$limit=150;
					$konten = the_excerpt();
					$string = strip_tags($konten);
					if (strlen($string) > $limit) {
					  $stringCut = substr($string, 0, $limit);
					  $string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
					}
				
				echo $string; ?>
				</p>
			</div>
		</div>
	</div>
	<?php 
}

$a = array(
	'widgets' => array(
				
	),
	'grids' => array(
		array(
			"cells" => 1,
			"style" => array(
				"style" => '',
				"image" => '',
				"color" => '',
				"height" => '',
				"video" => '',
			),
		)

	),
	'grid_cells' => array(
		array(
			"weight" => 1,
			"grid" => 0
		)
	)
);

/* $a = json_decode('{"widgets":[{"frames":[{"content":"<h1 style=\"text-align: center;\">About Simple</h1>","background":{"image":0,"image_fallback":"http://layouts.siteorigin.com/wp-content/uploads/2015/11/write-593333_1920.jpg#1920x1135","opacity":100,"color":"#333333","url":"","so_field_container_state":"open","new_window":false,"videos":[],"size":false,"image_type":"cover"},"buttons":[]}],"controls":{"speed":800,"timeout":8000,"nav_color_hex":"#FFFFFF","nav_style":"thin","nav_size":25,"so_field_container_state":"open","swipe":false},"design":{"padding":"200px","extra_top_padding":"0px","padding_sides":"20px","width":"1280px","heading_font":"","heading_size":"38px","heading_shadow":50,"text_size":"16px","so_field_container_state":"open","height":false,"heading_color":false,"fittext":false,"fittext_compressor":0,"text_color":false,"text_font":"","text_shadow":0,"link_color":false,"link_color_hover":false},"_sow_form_id":"5635bab5be565","panels_info":{"class":"SiteOrigin_Widget_Hero_Widget","raw":false,"grid":0,"cell":0,"id":0,"widget_id":"3f20cfa0-7348-4c50-97f7-a47e323df5da","style":{"background_display":"tile"}}},{"headline":{"text":"Who we are","tag":"h1","font":"Helvetica Neue","color":"#333333","align":"center","so_field_container_state":"open","destination_url":"","new_window":false,"hover_color":false,"font_size":false,"line_height":false,"margin":false},"sub_headline":{"text":"A team that loves to create","tag":"h3","font":"Helvetica Neue","color":"#333333","align":"center","so_field_container_state":"open","destination_url":"","new_window":false,"hover_color":false,"font_size":false,"line_height":false,"margin":false},"divider":{"style":"none","weight":"thin","color":"#EEEEEE","so_field_container_state":"open","thickness":0,"align":"center","width":false,"margin":false},"_sow_form_id":"5635bb38840af","order":[],"fittext":false,"fittext_compressor":0,"panels_info":{"class":"SiteOrigin_Widget_Headline_Widget","raw":false,"grid":1,"cell":0,"id":1,"widget_id":"93ea9f51-3a3c-47a6-8206-2e3c69fe5323","style":{"background_display":"tile"}}},{"title":"","text":"<p><span style=\"color: #333333;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet laoreet felis id tristique. Duis efficitur, augue a condimentum placerat, tortor nibh maximus neque, eu eleifend tortor urna in odio. Maecenas ultrices dolor a nulla cursus, ut consequat purus volutpat. Donec pellentesque ligula enim, sed luctus ex posuere eu. Pellentesque odio lorem, posuere vel magna vitae, suscipit commodo nisl. </span></p><p><span style=\"color: #333333;\">Proin elementum neque et tempor viverra. Suspendisse in ante tristique, facilisis tellus at, commodo augue. Mauris quis sapien accumsan, dapibus ex nec, ultricies nunc. Duis eu enim sit amet sapien scelerisque placerat. Fusce rutrum iaculis hendrerit. In aliquet, nibh at egestas pharetra, nulla nisi molestie nisl, nec interdum ex purus maximus felis.</span></p><p><span style=\"color: #333333;\">Let’s work together! Drop us an email to get started!</span></p>","autop":true,"_sow_form_id":"5635bc1bd40dc","panels_info":{"class":"SiteOrigin_Widget_Editor_Widget","raw":false,"grid":1,"cell":0,"id":2,"widget_id":"2fe9547a-2825-471a-9fcb-387170865326","style":{"background_display":"tile"}}},{"headline":{"text":"What we do","tag":"h1","font":"Helvetica Neue","color":"#333333","align":"center","so_field_container_state":"open","destination_url":"","new_window":false,"hover_color":false,"font_size":false,"line_height":false,"margin":false},"sub_headline":{"text":"Keep it simple ","tag":"h3","font":"Helvetica Neue","color":"#333333","align":"center","so_field_container_state":"open","destination_url":"","new_window":false,"hover_color":false,"font_size":false,"line_height":false,"margin":false},"divider":{"style":"none","weight":"thin","color":"#EEEEEE","so_field_container_state":"open","thickness":0,"align":"center","width":false,"margin":false},"_sow_form_id":"5635bd396940a","order":[],"fittext":false,"fittext_compressor":0,"panels_info":{"class":"SiteOrigin_Widget_Headline_Widget","raw":false,"grid":1,"cell":1,"id":3,"widget_id":"d41ab28c-702e-4743-a33c-73b403eecc6e","style":{"background_display":"tile"}}},{"title":"","text":"<p><span style=\"color: #333333;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet laoreet felis id tristique. Duis efficitur, augue a condimentum placerat, tortor nibh maximus neque, eu eleifend tortor urna in odio. Maecenas ultrices dolor a nulla cursus, ut consequat purus volutpat. Donec pellentesque ligula enim, sed luctus ex posuere eu. Pellentesque odio lorem, posuere vel magna vitae, suscipit commodo nisl. </span></p><p><span style=\"color: #333333;\">Proin elementum neque et tempor viverra. Suspendisse in ante tristique, facilisis tellus at, commodo augue. Mauris quis sapien accumsan, dapibus ex nec, ultricies nunc. Duis eu enim sit amet sapien scelerisque placerat. Fusce rutrum iaculis hendrerit. In aliquet, nibh at egestas pharetra, nulla nisi molestie nisl, nec interdum ex purus maximus felis.</span></p><p><span style=\"color: #333333;\">Wanna see proof? Check out our work! </span></p>","autop":true,"_sow_form_id":"5635bd3d24e69","panels_info":{"class":"SiteOrigin_Widget_Editor_Widget","raw":false,"grid":1,"cell":1,"id":4,"widget_id":"0e0cd987-4555-408d-8fb2-29e3d64834f6","style":{"background_display":"tile"}}}],"grids":[{"cells":1,"style":{"background_display":"tile","bottom_margin":"0px","row_stretch":"full-stretched"}},{"cells":2,"style":{"padding":"5%","background":"#e0e0e0","background_display":"tile","row_stretch":"full"}}],"grid_cells":[{"grid":0,"index":0,"weight":1,"style":[]},{"grid":1,"index":0,"weight":0.5,"style":[]},{"grid":1,"index":1,"weight":0.5,"style":[]}],"name":"Freenite 200+"}');

print "<pre>";
print_r($a);
print "</pre>";
exit();
 */
function senang_prebuilt_layouts($layouts){
    $layouts['home-page'] = array(
        'name' => __('Default Home', 'vantage'),    // Required
        'description' => __('Default Home Description', 'vantage'),    // Optional
       // 'screenshot' => plugin_dir_url( __FILE__ ) . 'images/layout-screenshot.png',    // Optional
        'widgets' => array(
			
		),
        'grids' => array(
			array(
				"cells" => 1,
				"style" => array(
					"style" => '',
					"image" => '',
					"color" => '',
					"height" => '',
					"video" => '',
				),
			)
		
		),
        'grid_cells' => array(
			array(
				"weight" => "0.6",
				"grid" => 0,
				'style' => array(
					'vertical_alignment' => 'center'
				),
			),
			array(
				"weight" => "0.4",
				"grid" => 0,
				'style' => array(
					'vertical_alignment' => 'center'
				),
			)
		)
    );
    return $layouts; 
}
add_filter('siteorigin_panels_prebuilt_layouts','senang_prebuilt_layouts');

function default_content(){

	get_template_part( 'content', 'none' );

}

//add_action('default_content','default_content');


function single_post(){

	?>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header>

	<media class="pull-left">

		<?php 

		if (has_post_thumbnail()) { ?>

			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail("large",array("class"=>"media-object")); ?></a>

		<?php 

		}

		?>

	</media>

	<div class="content-post">

	<?php the_content(); ?>

	</div>



	<?php

	wp_link_pages( array(

		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aslibali' ),

		'after'  => '</div>',

	) );

	?>

	<div class="clearfix"></div>

	<?php 



}



add_action( 'wp_ajax_single_post', 'prefix_ajax_single_post' );
add_action( 'wp_ajax_nopriv_single_post', 'prefix_ajax_single_post' );

function prefix_ajax_single_post() {
   $link = $_POST["id"];
   $post = file_get_contents($link);
   print $post;
   wp_die();
}