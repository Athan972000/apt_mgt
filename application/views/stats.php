
<!DOCTYPE HTML>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Highcharts Example</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
canvas{
        width: 100% !important;
        max-width: 800px;
        height: auto !important;
    }
</style>
</head>
<body>

	
	<script src="<?php echo base_url().'resources/js/Chart.js'?>"></script>
	<div class="row-fluid">
        <div class="graph span6">
            <h3 class="title"> The Chart</h3>
            <canvas id="myChart" width="500" height="400"></canvas>
        </div>
        
	</div>


</body>
	
	<script type="text/javascript">
var text_result = JSON.parse('<?php echo json_encode($Nvoca['text_result']); ?>');

// console.log(text_result);
// console.log(text_result[0].date+" "+text_result[0].length);
var dateArray = new Array();
var lengthArray= new Array();

for( i=0; i<text_result.length; i++ )
{
	if(i==0){
		dateArray.push(text_result[i].date);
		lengthArray.push(text_result[i].length);
	}
	else{
		for(j=i;j<text_result.length;j++){
			if(dateArray[i-1]==text_result[j].date){
				lengthArray[i-1]+=text_result[j].length;
				break;
			}
			else{
				dateArray.push(text_result[j].date);
				lengthArray.push(text_result[j].length);
				
				break;
			}			
		}
	}
	
	// dateArray.push(text_result[i].date);
	// lengthArray.push(text_result[i].length);
}
console.log(dateArray);
console.log(lengthArray);
var data = {
    labels: dateArray,
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: lengthArray
        },
        
    ]
};
// Get context with jQuery - using jQuery's .get() method.
var ctx = $("#myChart").get(0).getContext("2d");
// This will get the first returned node in the jQuery collection.
var myNewChart = new Chart(ctx);

new Chart(ctx).Line(data);

		</script>
</html>
