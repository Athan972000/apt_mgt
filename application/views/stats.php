
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
		
$(function () {
	
	var apivar = "<?php echo $Nvoca['apikey'] ?>";
	var dateArray = new Array();
	var lengthArray= new Array();
	var dataArrayFinal = new Array();
	var testArray = new Array;
	testArray = [480, 480, 480, 11, 480, 480];
	var jsonObj;
	//get usage data
	$.ajax({
			url: base_url+"get_usage_text_chart_data",
			type:'POST',
			dataType:'json',
			data:
			{
				apikey: apivar,
			},
			success: function(msg)
			{
				
				alert(msg[0].date);
				for(i =0;i<msg.length;i++){
					dateArray[i] = msg[i].date;
					lengthArray.push(parseInt(msg[i].length,10));
				}
				
				// for(j=0;j<dateArray.length;j++){
					// var temp = new Array(dateArray[j],lengthArray[j]);
					// dataArrayFinal[j] = temp;
				// }
				console.log(JSON.stringify(msg));
				jsonObj = msg;
				for(i=0;i<msg.length;i++){
					dataArrayFinal.push([msg[i].date,parseInt(msg[i].length)]);
				}
				console.log(jsonObj);
				console.log(dateArray);
				console.log(lengthArray);
				console.log(testArray);
				
			}
			
	});
	
	$.each(length, function (i,jsonObj){
		jsonObj.y = jsonObj.length ;
	})
	
    $('#container').highcharts({
        title: {
            text: 'Monthly Average Temperature',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: WorldClimate.com',
            x: -20
        },
        xAxis: {
            categories: dateArray
        },
        yAxis: {
            title: {
                text: 'length'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
       
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: lengthArray
        } ]
    });
});
		</script>
	</head>
	<body>
<script src="<?php echo base_url().'resources/js/highcharts.js'?>"></script>
<script src="<?php echo base_url().'resources/js/modules/exporting.js'?>"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
