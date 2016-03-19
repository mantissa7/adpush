
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
			// var stockForm = document.getElementById('bsmodal-theForm');
			// var stockReturn = null;
			// stockForm.addEventListener("submit", function(e){
			// 	e.preventDefault();
			// 	stockReturn = new StockSubmit(new FormData(e.target));
			// 	return false;
			// });

			return false;
	});




//chart settings

Chart.defaults.global.responsive = true;

var data = {
    labels: ["00:00", "03:00", "06:00", "09:00", "12:00", "15:00", "18:00", "21:00"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [0, 8, 12, 30, 31, 32, 10, 0]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [2, 40, 30, 19, 66, 27, 70, 10]
        }
    ]
};
		var ctx = document.getElementById("insightsChart").getContext("2d");
		var myLineChart = new Chart(ctx).Line(data, {});
