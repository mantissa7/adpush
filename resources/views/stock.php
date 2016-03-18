<!doctype html>

<html>
<head>
	<title>adPush</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/header.css">
	<link rel="stylesheet" type="text/css" href="/css/content.css">
	<link rel="stylesheet" type="text/css" href="/css/bsmodal.css">
</head>
<body>
	<nav><h1>Facebook Stock Control</h1></nav>
	
	<div id="main">

		<div class="alert-primary"><span>alert</span><p>Our metrics show it would be best to post your next update at 3pm</p></div>


	  	<div class="box">
	  		<div class="heading"><h2>Choose vehicle</h2></div>
		  	<div class="box-inner">
			  	<p>Select your vehicle to post</p>
				<form id="theForm" method="POST" action="#">
					<? //TODO: foreach through vehicle data; ?>
					<label>
						<span>Brand<span>
						<select name="brand">
							<option selected hidden disabled>please select...</option>
							<option>Audi</option>
							<option>BMW</option>
							<option>Bugatti</option>
							<option>Mercedes</option>
						</select>
					</label>
					<label>
						<span>Model<span>
						<select name="brand">
							<option selected hidden disabled>please select...</option>
							<option>1 Series</option>
						</select>
					</label>
					<button>Go!</button>
				</form>
			</div><!-- .box-inner -->
		</div><!-- .box -->

	  	<div class="box">
	  		<div class="heading"><h2>Post stats</h2></div>
		  	<div class="box-inner">
			  	<p>Looking Good!</p>

			  	<canvas id="insightsChart" width="800" height="400"></canvas>
				
			</div><!-- .box-inner -->
		</div><!-- .box -->

	</div> <!-- #main -->

	<div id="theDiv" class="modal-data">
		<div class="bsmodal-title">Confirm Vehicle</div>
		<div class="bsmodal-body">
			<img src="/assets/img.jpg">
			<form id="stockSubmit" method="POST" action="#">
				<input type="text" name="brand" value="{{brand}}">
				<input type="text" name="model" value="{{model}}">
				<input type="text" name="price" value="{{price}}">
				<button>Submit</button>
			</form>
		</div>
	</div>
</body>
<footer>

	<script type="text/javascript" src="/js/bsTemplate.class.js"></script>
	<script type="text/javascript" src="/js/StockSubmit.class.js"></script>
	<script type="text/javascript" src="/js/bsModal.js"></script>
	<script type="text/javascript" src="/js/chart.min.js"></script>
	<script type="text/javascript" src="/js/custom.js"></script>

	
</footer>
</html>