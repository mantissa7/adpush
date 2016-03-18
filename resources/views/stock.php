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

	<script type="text/javascript">
		var modal = new bsModal([], {dev:true});

		document.getElementById("theForm").addEventListener("submit", function(e){
			e.preventDefault();

			var form = new FormData(e.target);

			modal.open('theForm', {
				type:"div",
				id:"theDiv",
				data: {
					brand: "BMW",
					model: "1 Series",
					price: 17
				}
			});

			//submit stock to eBay page
			var stockForm = document.getElementById('bsmodal-theForm');
			var stockReturn = null;
			stockForm.addEventListener("submit", function(e){
				e.preventDefault();
				stockReturn = new StockSubmit(new FormData(e.target));
				return false;
			});

			return false;
	});


//chart settings

Chart.defaults.global.responsive = true;

var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};
		var ctx = document.getElementById("insightsChart").getContext("2d");
		var myLineChart = new Chart(ctx).Line(data, {});


	</script>
	
</footer>
</html>