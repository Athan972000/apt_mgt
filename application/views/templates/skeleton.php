<html style="padding:0px;">
	<head>
    <?php echo $head; ?>
	<style type="text/css">
		.no-gutter > [class*='col-'] {
		padding-right:0;
		padding-left:0;
	}
	.main_content
	{
		padding: 0 20px;
	}
	</style>
	<?php echo $scripts; ?>
	</head>
    <body style="background-color: white;">
		<?php echo $header ?>
		<div class="container-fluid row no-gutter">
			<?php if($mynav): ?>
			<div id="scalingnav" style="width:250px;min-width:250px; background-color: #2c3037;" class="col-xs-4"><?php echo $nav; ?></div>
			<div id="scalingcontent" class="row col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 15px;">
				<div class="col-xs-12" style="height: 70px; width:100%;"><?php echo "<hr/>"; ?></div>
				<div class="col-xs-12 main_content"><?php echo $content; ?></div>
			<?php else: ?>
			<div class="col-xs-12"><?php echo $content; ?></div>
			<?php endif; ?>
        </div>
		<?php echo $footer; ?>
    </body>
	<script>
	$(document).ready(function() {
		if( $("#scalingcontent").height() > $("#scalingnav").height() ){$("#scalingnav").height( $("#scalingcontent").height() );}
	} );
	</script>
</html>