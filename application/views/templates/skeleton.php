<html style="padding:0px;">
	<head>
    <?php echo $head; ?>
	<style type="text/css">
	.no-gutter > [class*='col-'] 
	{
		padding:0px;
	}
	#scalingcontent
	{
		padding: 20px;
		margin: 0px;
	}

	#scalingright, #scalingnav
	{
		background-color: #2c3037;
		min-height: 100%;
	}
	</style>
	<?php echo $scripts; ?>
	</head>
    <body style="background-color: white;">
		<?php echo $header ?>
		<div class="container-fluid">
			<div class="row no-gutter">
			<?php if($mynav): ?>
				<div id="scalingnav" class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo $nav; ?></div>
				<div id="scalingcontent" class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><?php echo $content; ?></div>
				<div id="scalingright" class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><?php echo "<hr/>"; ?></div>
			<?php else: ?>
				<div class="col-xs-12"><?php echo $content; ?></div>
			<?php endif; ?>
			</div>
        </div>
		<?php echo $footer; ?>
    </body>
	<script>
	$(document).ready(function() {
		// if( $("#scalingcontent").height() > $("#scalingnav").height() )
		// {
			// $("#scalingnav").height( $("#scalingcontent").height() );
			// $("#scalingright").height( $("#scalingcontent").height() );
		// }
	} );
	$("nav a").on("click",function(e){
		$('body').addClass("csspinner traditional");
	});
	$(".addspinner_whenclick").on("click",function(e){
		$('body').addClass("csspinner traditional");
	}); 
	</script>
</html>