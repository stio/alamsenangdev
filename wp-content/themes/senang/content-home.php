<?php
get_header(); ?>
	<div id="primary" class="content-area mt--1">
		<main id="main" class="site-main" role="main">
			<div class="col-main">
				<div class="row">
					<div class="col-md-6">
						<div class="box-border">
							<div class="panel-row">
								<div class="panel-left">
									<div class="panel-row">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_06.png">
									</div>
									<div class="panel-row">
										<p style="line-height: 25px;font-size: 16px;font-weight: bold;">Professional Concentrate<br>and Organic anti termite<br>for House, Wood, Bamboo </p>
									</div>
								</div>
								<div class="panel-right">
									<div class="panel-row">
										<div class="table-display height--18em">
											<div class="table-cell">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_03.png">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-row">
								<div class="panel-left">
									<a class="btn btn-primary" href="/dev/alamsenang/freemite/">Read More</a>
									<a class="btn btn-secondary" href="/dev/alamsenang/shop/">Shop</a>
								</div>
								<div class="panel-left">
									<div class="table-display height--35">
										<div class="table-cell">
											<div class="font-small"><a style="font-size: 14px;font-weight: bold;color:#4a4db9" href="http://novayadi.com/dev/alamsenang/shop/">Free Shipping Java - Bali - Lombok</a></div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-row"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box-border">
							<div class="panel-row">
								<div class="panel-left">
									<div class="panel-row">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_08.png">
									</div>
									<div class="panel-row">
										<p style="line-height: 25px;font-size: 16px;font-weight: bold;">Sertfied Organic Cosmetic Grade Neem Oil : </p>
										<ul style="list-style: none;color: #000;font-size: 17px;line-height: 22px;font-weight: bold;">
											<li>- Beauty</li>
											<li>- Cosmetic</li>
											<li>- Agriculture</li>
										</ul>
									</div>
								</div>
								<div class="panel-right">
									<div class="panel-row">
										<div class="table-display height--18em">
											<div class="table-cell">
												<img src="/dev/alamsenang/wp-content/uploads/2018/03/Acceuil.jpg">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-row">
								<div class="panel-left">
									<a class="btn btn-primary" href="http://novayadi.com/dev/alamsenang/neemo/">Read More</a>
									<a class="btn btn-secondary" href="/dev/alamsenang/shop/">Shop</a>
								</div>
								<div class="panel-left">
									<div class="table-display height--35">
										<div class="table-cell">
											<div class="font-small" style="font-size: 14px;font-weight: bold;"><a style="font-size: 14px;font-weight: bold;color:#4a4db9" href="http://novayadi.com/dev/alamsenang/shop/">Free Shipping Java - Bali - Lombok</a></div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-row"></div>
						</div>
					</div>
				</div>
				<div class="row mt--1">
					<div class="col-md-5" style="">
						<div class="box-border bg-second">
							<div class="row-box green-box padding--double text-center" style="padding:45px 20px 35px">
								<h3 class="font-bigger"><a href="/dev/alamsenang/professional" style="color:#fff;">
									<span style="text-transform:uppercase;">Guarantied</span> Nontoxic Products<br>
									<span style="text-transform:uppercase;">Successfully</span> Tested Efficient<br>
									<span style="text-transform:uppercase;">Easy</span> To Handle, Use and Ship<br>
									<span style="text-transform:uppercase;">Fair</span> Distribution Network<br>
									<span style="text-transform:uppercase;">Reliable</span> Customer Service<br>
									<span style="text-transform:uppercase;">High</span> Business Potential<br>
									Proudly <span style="text-transform:uppercase;">Made In Bali</span> 
									<span style="">with passion</span> </a>
								</h3>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="box-border">
							<div class="post">
								<div class="panel panel-default">
									<div class="row">
										<div class="col-md-12">
											<div class="panel-heading padding-single">News</div>
										</div>
									</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12">
													 <ul class="news-demo-down-auto padding-single">
														<?php 
														$args = array(
															'post_type' => "post",
														);
														$query = new WP_Query($args);
														if($query->have_posts()) : 
															while($query->have_posts()) : $query->the_post();
															$limit=150;
															$konten = $query->post->post_excerpt;
															$string = strip_tags($konten);
															if (strlen($string) > $limit) {
																$stringCut = substr($string, 0, $limit);
																$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
															}
															
															?>
															<li class="news-item">
																<h5><a href="<?php print get_permalink($query->post-ID);?>"><?php echo $query->post->post_title;?></a></h5>
																<p><?php echo $string; ?></p>
															</li>
															<?php 
															endwhile;
														endif;
														?>
														
													 </ul>
												</div>
											</div>
										</div>
										<div class="panel-footer">
										</div>

									</div>

							</div>
						</div>
					</div>
				</div>
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
