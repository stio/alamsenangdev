<!doctype html>
<html <?php language_attributes(); ?> ng-app>
<head>
<title>Alam Senang <?php echo wp_title();?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div class="mobile-menu d-block d-sm-none" id="mobileMenu">
						
		<?php
		
		wp_nav_menu( array(
		'theme_location'    => 'primary',
		'depth'             => 18,
		'container'         => 'div',
		'container_class'   => 'slidemenu',
		'container_id'      => 'bs-example-navbar-collapse-2',
		'menu_class'        => 'nav navbar-nav-slide',
		'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
		'walker'            => new WP_Bootstrap_Navwalker(),
	) );
		
		?>
	</div>
	<header class="fixed">
		<div class="top-header container">
			<div class="row">
				<div class="col-md-9">
					
				</div>
				<div class="col-md-3">
					<!--<div class="cart-mini" style="margin-left: 1em;">
						<div class="site-header-cart">
							<a class="cart-contents cart white-color" href="/cart"><span class="font-most-big"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></a>
						</div>
					</div>-->
				</div>
			</div>
		</div>
		<div class="top-links container">
			<div class="row">
				<div class="col-md-2">
					<div class="logo">
						<a title="<?php echo( get_bloginfo( 'title' ) ); ?>" href="<?php echo get_home_url();?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png">
						</a>
					</div>
					
				</div>
				<div class="col-md-2">
				<?php //do_action('wpml_add_language_selector'); ?>
				</div>
				<div class="col-md-4">
					<div class="table-display height--10em">
						<div class="table-cell">
							<p class="font-bigger text-center">
								<span class="secondary-color">ORGANIC   PRODUCTS</span><br>
								<span class="secondary-color">SAFE <span class="third-color">EFFICIENT</span> EASY</span><br>
								<span class="primary-color">For Professional and Personal Use.</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 hidden-xs-down d-none d-sm-block text-right">
					<div class="table-display height--10em pull-right">
						<div class="table-cell">
							<p class="font-medium">
								<span>Free Adivice: <br>
								+62 (0) 811 388 643
								</span><br>
							</p>
							
						</div>
						<div class="table-cell">
							<img style="height:100px;" height="100px" src="http://freemite.com/skin/frontend/default/freemite/images/Olivia.png">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- menu-->
		<div class="top-menu container">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-expand-md bg-default">
					  <button style="width:100%;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
						<span class="white" style="color:white;">MAIN MENU</span>
					  </button>
					
						
					  
					<?php  /*  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
						<ul class="navbar-nav mr-auto">
						  <li class="nav-item active">
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link disabled" href="#">Disabled</a>
						  </li>
						  <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
							<div class="dropdown-menu" aria-labelledby="dropdown01">
							  <a class="dropdown-item" href="#">Action</a>
							  <a class="dropdown-item" href="#">Another action</a>
							  <a class="dropdown-item" href="#">Something else here</a>
							</div>
						  </li>
						</ul>
						<form class="form-inline my-2 my-lg-0">
						  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
						  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</form>
					  </div> */ ?>
					
					
					<div class="collapse navbar-collapse" id="navbarsExampleDefault">
						
						<?php
						
						wp_nav_menu( array(
						'theme_location'    => 'primary',
						'depth'             => 18,
						'container'         => 'div',
						'container_class'   => 'menu-primary pull-right',
						'container_id'      => 'bs-example-navbar-collapse-1',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						'walker'            => new WP_Bootstrap_Navwalker(),
					) );
						
						?>
					 </div>
					</nav>
				</div>
			</div>
		</div>
		<!-- menu-->
	</header>
	<div class="container">