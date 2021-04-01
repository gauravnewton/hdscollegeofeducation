    <!-- footer -->
	<div class="footer">
		<div class="container">
			<h2>Subscribe to <span>Newsletter</span></h2>
			<form action="#" method="post">
				<input type="email" name="Email" placeholder="Enter Your Email..." required="">
				<input type="submit" value="Send">
			</form>
			<div class="agile_footer_copy">
				<div class="w3agile_footer_grids">
					<div class="col-md-4 w3agile_footer_grid">
						<h3>About Us</h3>
						<p class="text-justify">The main vision of the college is to recognize and improve the internal and external capabilities of the entrants so that they 
							can ideally fulfill their responsibility towards their home, society and country and their society and country. 
							To develop in the right direction
						</p>
					</div>
					<div class="col-md-4 w3agile_footer_grid">
						<h3>Contact Info</h3>
						<ul>
							<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>H. D. S. College of Education, Ramanuj Bag,<span>Khodaganj - (Nalanda) - 801303.</span></li>
							<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:hdscollegeofeducation@gmail.com">hdscollegeofeducation@gmail.com</a></li>
							<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> (+91) 9934714490 / (+91) 9931489849</li>
						</ul>
					</div>
					<div class="col-md-4 w3agile_footer_grid w3agile_footer_grid1">
						<h3>Navigation</h3>
						<ul>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="<?php echo $this->config->base_url()?>">Homes</a></li>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="courses">Courses</a></li>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="weeklyReport">Weekly Attendance Report</a></li>
							<li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><a href="<?php echo $this->config->base_url() ?>/admin">Admin Login</a></li>
							
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="w3_agileits_copy_right_social">
				<div class="col-md-6 agileits_w3layouts_copy_right">
					<p>&copy; 2021 H. D. S. College of Education. All rights reserved</p>
				</div>
				<div class="col-md-6 w3_agile_copy_right">
					<ul class="agileinfo_social_icons">
						<li><a href="#" class="w3_agileits_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="wthree_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agileinfo_google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agileits_pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
    <!-- //footer -->
    <!-- carousal -->
	<script src="<?php echo $this->config->base_url() ?>admin/assets/plugins/datatables/jquery.dataTables.js"></script>
  	<script src="<?php echo $this->config->base_url() ?>admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  
	<script src="<?php echo $this->config->base_url() ?>assets/js/slick.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(document).on('ready', function() {
		  $(".center").slick({
			dots: true,
			infinite: true,
			centerMode: true,
			slidesToShow: 2,
			slidesToScroll: 2,
			responsive: [
				{
				  breakpoint: 768,
				  settings: {
					arrows: true,
					centerMode: false,
					slidesToShow: 2
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					arrows: true,
					centerMode: false,
					centerPadding: '40px',
					slidesToShow: 1
				  }
				}
			 ]
		  });
		});
	</script>
    <!-- //carousal -->
    <!-- flexisel -->
    <script type="text/javascript">
		$(window).load(function() {
			$("#flexiselDemo1").flexisel({
				visibleItems: 4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:640,
						visibleItems:2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 2
					}
				}
			});
			
		});
	</script>
	<script type="text/javascript" src="<?php echo $this->config->base_url() ?>assets/js/jquery.flexisel.js"></script>
    <!-- //flexisel -->
    <!-- gallery-pop-up -->
	<script src="<?php echo $this->config->base_url() ?>assets/js/lsb.min.js"></script>
	<script>
	    $(window).load(function() {
		  $.fn.lightspeedBox();
		});
	</script>
    <!-- //gallery-pop-up -->
    <!-- flexSlider -->
	<script defer src="<?php echo $this->config->base_url() ?>assets/js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	</script>
    <!-- //flexSlider -->
    <!-- banner-type-text -->
	<script src="<?php echo $this->config->base_url() ?>assets/js/typed.js" type="text/javascript"></script>
    <script>
		$(function(){

			$("#typed").typed({
				// strings: ["Typed.js is a <strong>jQuery</strong> plugin.", "It <em>types</em> out sentences.", "And then deletes them.", "Try it out!"],
				stringsElement: $('#typed-strings'),
				typeSpeed: 30,
				backDelay: 500,
				loop: false,
				contentType: 'html', // or text
				// defaults to false for infinite loop
				loopCount: false,
				callback: function(){ foo(); },
				resetCallback: function() { newTyped(); }
			});

			$(".reset").click(function(){
				$("#typed").typed('reset');
			});

		});

		function newTyped(){ /* A new typed object */ }

		function foo(){ console.log("Callback"); }
    </script>
    <!-- //banner-type-text -->
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="<?php echo $this->config->base_url() ?>assets/js/move-top.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->base_url() ?>assets/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){		
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smooth-scrolling -->
    <!-- for bootstrap working -->
	<script src="<?php echo $this->config->base_url() ?>assets/js/bootstrap.js"></script>
    <!-- //for bootstrap working -->
    <!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
    <!-- //here ends scrolling icon -->
</body>
</html>