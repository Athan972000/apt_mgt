<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user_rows = null;
$user_info = null;
foreach($Nvoca['user_list'] as $v)
{
	$user_rows .= "
	<tr this-apikey=".$v['apikey'].">
		<td>".$v['last_name']."</td>
		<td>".$v['email']."</td>
		<td>".date("F j, Y",strtotime($v['start_date']))."</td>
	</tr>";

	$user_info .= "<div style='display:none' id='".$v['apikey']."'>
		<input type='hidden' class='photo_link' value='".$v['photo_link']."'/>
		<input type='hidden' class='company' value='".$v['company']."'/>
		<input type='hidden' class='platform' value='".$v['platform']."'/>
		<input type='hidden' class='how' value='".$v['how']."'/>
		<input type='hidden' class='last_name' value='".$v['last_name']."'/>
		<input type='hidden' class='email' value='".$v['email']."'/>
	</div>";
	// echo $v['photo_link'];
}

?><!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<style>
.view_user, .table_user, .usage_from_view, .bills_from_view
{
	text-align: center;
	border-radius: 5%;
	border: 1px solid black;
	padding: 20px;
}

.content
{
	text-align: center;
}
.view_user
{
	background-color: #FFF1A6;
	border-radius: 20%;
}
.inside_content
{
	padding: 20px 0px;
	font-size: 16px;
}
.inside_content .label
{
	font-size: 13px;
	color: gray;
}
.table_user
{
	background-color: #FFF1EE;
}
.usage_from_view
{
	background-color: #BDDEFF;
}
#users_list tbody tr.odd
{
	background-color: #FFF1EE;
}
#users_list tbody tr:hover
{
	background-color: #FBCFC6;
	color:white;
}
#users_list tbody tr.selected 
{
    background-color: #ED817D;
	color:white;
}
canvas{
        width: 100% !important;

		max-width: 100%;
		height: 400px;
		max-height: 400px;
        height: auto !important;
		background-color: white;
		border-radius: 2%;
    }
.bills_from_view
{
	background-color: #C6E69A;
}
</style>

<div class="content">
	<h3>User Management</h3>
	<br>
	<div class="row container-fluid">
		<div class="col-xs-3 view_user" style="word-wrap:break-word;">
			<div class="inside_content">
				<img src="<?php echo base_url()."resources/app/img/user/noimage.jpg";?>" width="80" height="80" class="img-thumbnail img-circle" />
				<br/><br/>
				<span class="label">Name:</span> <span class="clear_ic" id="ic_name"></span><br/>
				<span class="label">Email:</span> <span class="clear_ic"  id="ic_email"></span><br/>
				<span class="label">Company:</span> <span class="clear_ic"  id="ic_company"></span><br/>
				<span class="label">Platform:</span> <span class="clear_ic"  id="ic_platform"></span><br/>
				<span class="label">How:</span> <span class="clear_ic"  id="ic_how"></span><br/>
				<button class="api_key_hider btn btn-default btn-xs"><span class="label">API key</span></button><br/>
				<div class="clear_ic" id="ic_apikey" style="display:none;"></div>
			</div>
		</div>
		<div class="col-xs-9" style="padding-left: 15px; padding-right: 0px;">
			<div class="col-xs-12 table_user">
				<div class="inside_content">
					<table id="users_list" class="stripe hover">
						<thead>
							<tr style="background-color: #ED6965;color: white;">
								<th>
									Name
								</th>

								<th>
									Email
								</th>
								<th>
									Start Date
								</th>
							</tr>
						</thead>
						<tbody>
							<?php echo $user_rows; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br/>
	</div>
	<div class="row" style="margin-top: 15px;">
		<div class="col-xs-6">
			<div class="usage_from_view">
				<canvas id="myChart"></canvas>
			</div>
		</div>
		<div class="col-xs-6 bills_from_view">
			
		</div>
	</div>
</div>
<?php echo $user_info; ?>
<script>
$(".img-thumbnail").on("click",function(){
	var width = $(this).width();
	if ( width > 60 )
	{
		$(this).width(60);
	}
	else
	{
		$(this).width(80);
	}
});

$(".api_key_hider").on("click",function(e){
	if( $('#ic_apikey').css('display') == 'none' )
		$('#ic_apikey').css('display','inline');
	else
		$('#ic_apikey').css('display','none');
});

var ctx = $("#myChart").get(0).getContext("2d");
var vocadbchart;
var amountorcount = 'count';
var mydata;
$(document).ready(function(){
    var table =  $('#users_list').DataTable({
        "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         false,
		"info":     false
    });
 
    $('#users_list tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			$('.clear_ic').html('');
			$('.inside_content img').attr('src','<?php echo base_url()."resources/app/img/user/noimage.jpg";?>');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
			
			var apikey = $(this).attr('this-apikey');
			// $("#"+apikey+" .photo_link").html();
			
			$('.inside_content img').attr('src',$("#"+apikey+" .photo_link").val());
			
			$('#ic_name').html( $("#"+apikey+" .last_name").val() );
			$('#ic_email').html( $("#"+apikey+" .email").val() );
			$('#ic_company').html( $("#"+apikey+" .company").val() );
			$('#ic_platform').html( $("#"+apikey+" .platform").val() );
			$('#ic_how').html( $("#"+apikey+" .how").val() );
			$('#ic_apikey').html( apikey );
			
			$.ajax({
				url: base_url+"admin/users_monthstats",
				type:'POST',
				data:{
					num: 1,
					apikey: apikey
				},
				success: function(res)
				{
					var result = JSON.parse( res );
					// console.log(result.total);
					mydata = construct_data( result.total );

					if(typeof(vocadbchart) != 'undefined')
						vocadbchart.destroy();
					vocadbchart = new Chart(ctx).Line(mydata);
				}
			});

			
        }
    } );
	
	
	function construct_data(thisdata)
	{
		var dateArray = Object.keys(thisdata);
		// console.log(dateArray);
		var lengthArray = [];
		for( i=0; i<dateArray.length; i++ )
		{
			lengthArray.push( thisdata[dateArray[i]][amountorcount] );
		}
		// console.log( lengthArray );
		if( dateArray.length > 10 )
		{
			var skip_count = Math.round(dateArray.length/10);
			var ctr = 0;
			// console.log(skip_count);
			for( i=1;i<dateArray.length;i++ )
			{
				if(ctr == skip_count)
				{
					ctr = 0;
				}
				else
				{
					if(i+1 != dateArray.length)
					{
						ctr++;
						dateArray[i] = "";
					}
					
				}
			}
		}
		var data = {
			labels: dateArray,
			datasets: [
				{
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
		// console.log(data);
		return data;
	}

});
</script>