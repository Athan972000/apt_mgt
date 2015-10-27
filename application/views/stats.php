
<!DOCTYPE HTML>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Highcharts Example</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
var text_result = JSON.parse('<?php echo json_encode($Nvoca['text_result']); ?>');

// console.log(text_result);
// console.log(text_result[0].date+" "+text_result[0].length);
var dateArray = new Array();
var lengthArray= new Array();

for( i=0; i<text_result.length; i++ )
{
	dateArray.push(text_result[i].date);
	lengthArray.push(text_result[i].length);
}

$(function () {
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
            name: 'Text',
            data: lengthArray
        }]
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
