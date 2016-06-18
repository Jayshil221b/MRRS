<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Eclinic</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- CSS are placed here -->
        	{{ HTML::style('css/bootstrap.min.css') }}
        	{{ HTML::style('css/icomoon-social.css') }}
        	{{ HTML::style('css/leaflet.css') }}
        	{{ HTML::style('css/leaflet.ie.css') }}
        	{{ HTML::style('css/main.css') }}
        	{{ HTML::style('css/jquery.dataTables.css') }}
			{{ HTML::style('div.dataTables_wrapper {
							margin-bottom: 3em;
							}  ')}}
            {{ HTML::style('src/ui.notify.css') }}
	        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <!-- Javascripts -->
			{{ HTML::script('js/modernizr-2.6.2-respond-1.1.0.min.js') }}
			{{ HTML::script('js/min.js') }}
			{{ HTML::script('js/bootstrap.min.js') }}
			{{ HTML::script('js/leaflet.js') }}
			{{ HTML::script('js/jquery.sequence-min.js') }}
			{{ HTML::script('js/jquery.bxslider.js') }}
			{{ HTML::script('js/main-menu.js') }}
			{{ HTML::script('js/template.js') }}
			{{ HTML::script('js/jquery-1.11.1.min.js') }}
			{{ HTML::script('js/jquery.dataTables.min.js') }}
			{{ HTML::script('src/jquery.js') }}
			{{ HTML::script('src/jquery-ui.js') }}
			{{ HTML::script('src/jquery.notify.js') }}
			<script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
			<script>
				$(document).ready(function()
				{
					$("#war").click(function()
					{
						window.location.href='/checkwarranty';
					});
				});
            </script>
            <script>
				$(document).ready(function()
				{
					$("#ins").click(function()
					{
						window.location.href='/checkinsurance';
					});
				});
			</script>

    </head>
    <body>
    @yield('stickynotes')

        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
	        <div class="container">

	        	<div class="menuextras">
					<div class="extras">
						<ul>
						    <li>    Wellcome :<b> <a style="color: #2b669a;" title="Edit Profile"
									href="{{{ URL::to('users/edit',array('id' => Auth::user()->id)) }}}">
						     							{{ Auth::user()->username }} ! </a> </b> </li>
						    <li>   <b> <a style="color: #2b669a;" href="{{{ URL::to('/logout') }}}">Logout</a> </b> </li>
						
			        	</ul>
					</div>
		        </div>
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="">
							{{ HTML::image('','Eclinic') }} </a></li>
						<li>
							<a href="/users">Home</a>
						</li>
						
					</ul>
				</nav>
			</div>
		</div>

        <!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container" align="center">
				<div class="row">
					<div class="col-md-12">
				@yield('blackbar')
					</div>
				</div>
			</div>
		</div>
        @yield ('content')



        @yield ('footer')
	        <div class="footer">
            	    	<div class="container">
            		    	<div class="row">
            		    		<div class="col-footer col-md-3 col-xs-6">
            		    			<h3>Our Latest Work</h3>
            		    			<div class="portfolio-item">
            							<div class="portfolio-image">
            								<a href="page-portfolio-item.html"><img src="img/portfolio6.jpg" alt="Project Name"></a>
            							</div>
            						</div>
            		    		</div>
            		    		<div class="col-footer col-md-3 col-xs-6">
            		    			<h3>Navigate</h3>
            		    			<ul class="no-list-style footer-navigate-section">
            		    				<li><a href="page-blog-posts.html">Blog</a></li>
            		    				<li><a href="page-portfolio-3-columns-2.html">Portfolio</a></li>
            		    				<li><a href="page-products-3-columns.html">eShop</a></li>
            		    				<li><a href="page-services-3-columns.html">Services</a></li>
            		    				<li><a href="page-pricing.html">Pricing</a></li>
            		    				<li><a href="page-faq.html">FAQ</a></li>
            		    			</ul>
            		    		</div>

            		    		<div class="col-footer col-md-4 col-xs-6">
            		    			<h3>Contacts</h3>
            		    			<p class="contact-us-details">
            	        				<b>Address:</b> 123 Fake Street, LN1 2ST, Ahmedabad, India<br/>
            	        				<b>Phone:</b> +44 123 654321<br/>
            	        				<b>Fax:</b> +44 123 654321<br/>
            	        				<b>Email:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
            	        			</p>
            		    		</div>
            		    		<div class="col-footer col-md-2 col-xs-6">
            		    			<h3>Stay Connected</h3>
            		    			<ul class="footer-stay-connected no-list-style">
            		    				<li><a href="www.facebook.com" class="facebook"></a></li>
            		    				<li><a href="www.twitter.com" class="twitter"></a></li>
            		    				<li><a href="plus.google.com" class="googleplus"></a></li>
            		    			</ul>
            		    		</div>
            		    	</div>
            		    	<div class="row">
            		    		<div class="col-md-12">
            		    			<div class="footer-copyright">&copy; 2015 Assets. All rights reserved.</div>
            		    		</div>
            		    	</div>
            		    </div>
            	    </div>
    </body>
</html>