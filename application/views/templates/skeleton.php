<html style="padding:0px;">
	<head>
    <?php echo $head; ?>
	<style type="text/css">
		.no-gutter > [class*='col-'] {
		padding-right:0;
		padding-left:0;
	}

	</style>
	<?php echo $scripts; ?>
	</head>
    <body style="background-color:white; ">
		<?php echo $header ?>
		<div class="container-fluid row no-gutter">
			<?php if($mynav): ?>
			<div style="width:250px;min-width:250px;" class="col-xs-4"><?php echo $nav; ?></div>
			<div style="padding-left: 15px; padding-top:80px;" class="col-xs-8"><?php echo $content; ?></div>
			<?php else: ?>
			<div class="col-xs-12"><?php echo $content; ?></div>
			<?php endif; ?>
        </div>
		<?php echo $footer; ?>
    </body>
	
</html>