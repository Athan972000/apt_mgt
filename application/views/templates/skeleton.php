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
    <body class="two-column docs normal-width" style="background-color:white;">
		<?php echo $header ?>
		<div class="row no-gutter">
			<?php if($mynav): ?>
			<div class="col-xs-2 "><?php echo $nav; ?></div>
			<div class="col-xs-10"><?php echo $content; ?></div>
			<?php else: ?>
			<div class="col-xs-12 "><?php echo $content; ?></div>
			<?php endif; ?>
        </div>
		<?php echo $footer; ?>
    </body>
	
</html>