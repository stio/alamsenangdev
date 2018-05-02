		</div><!-- #page -->
	</div><!-- #page -->
	<div class="clearfix"></div>
	<footer>
		<div class="footer-link container-fluid box-border bg-default mt--1">
			<div class="row">
				<div class="col-md-12 text-center">
					<p>&nbsp;<a href=""></a></p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<p class="text-green">&copy; Copyright 2018 CV Alam Senang</p>
				</div>
				<div class="col-md-4">
					<div class="payment-icons" style="display: block;
    text-align: center;">
						<p>
						<img src="http://freemite.com/skin/frontend/default/freemite/images/payment/bca.png">
						<img src="http://freemite.com/skin/frontend/default/freemite/images/payment/bni.png">
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<ul class="links" style="
    margin: 10px 0px;
    list-style: none;text-align: right;
">

<li><span class="widget widget-cms-link-inline"><a href="/privacy-customer-care" title="Privasi dan Layanan pelanggan"><span>Privacy</span></a></span>
</li>


</ul>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
			<address class="text-center" style="line-height: 22px;">Jl. Padat Karya 9 , Desa Belega - 80581 <br> Gianyar - Bali - Indonesia - Tlp. +62 (0) 811 388 643</address>
			</div>
			</div>
		</div>
	</footer>
	<div class="scrollTop">
		<a href="javascript;"> Back to Top </a>
	</div>
	<?php wp_footer(); ?>
		<script type="text/javascript">
		    jQuery(function () {
		       jQuery(".news-demo-down-auto").bootstrapNews({
		            newsPerPage: 3,
		            autoplay: true,
		            pauseOnHover: true,
		            navigation: false,
		            direction: 'down',
		            newsTickerInterval: 1500,
		            onToDo: function(){
						
		            }
		        });
		
				jcf.replaceAll();
				
				jQuery('a.modal-popup').click(function(e){
					e.preventDefault();
					var target = jQuery(this).attr("href");
					 jQuery.ajax({
						url: "http://novayadi.com/dev/alamsenang/wp-admin/admin-ajax.php",
						type: "post",
						data: {'action': 'single_post','id': target} ,
						success: function (response) {
							var html = jQuery(response).find(".content-post").html();
							jQuery("#sinovModal .modal-body").html(html);
							jQuery("#sinovModal").modal("show");           

						},
						error: function(jqXHR, textStatus, errorThrown) {
						   console.log(textStatus, errorThrown);
						}


					});
					
				});
				
				jQuery('.right-element a').click(function(e){
					// jQuery(".post-content-element").
					var aTags = jQuery(".post-content-element").find('h3');
					var searchText = jQuery(this).text();
					var found;
					for (var i = 0; i < aTags.length; i++) {
						var tes = aTags[i].textContent;
						tes = tes.toLowerCase();
						searchText = searchText.toLowerCase();
						searchText = searchText.trim();
						if ( tes.trim() == searchText) {
							found = jQuery(aTags[i]);
							jQuery('html, body').animate({
								scrollTop: (jQuery(found).offset().top - 30)
							}, 2000);
							break;
						}
					}
					
					
					
				});
				
				jQuery(".scrollTop").click(function(e){
					e.preventDefault();
					jQuery('html, body').animate({
						scrollTop: 0
					}, 2000);
				});
				
				
				/* jQuery(".so-widget-sow-image").find("img[class^='so-widget-image']").each(function(){
					var title = jQuery(this).attr("title");
					if(title != ""){
						jQuery("<div class=\"tit-image\">"+title+"</div>").insertAfter(jQuery(this).parent("div"));
						
					}
				}); */
		
		    });
		
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
			if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
				jQuery(".scrollTop").addClass("fixed");
			} else {
				jQuery(".scrollTop").removeClass("fixed");
			}
		}
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
   </body>
</html>
