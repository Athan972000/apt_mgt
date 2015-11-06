<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
var base_url = "<?php echo base_url();?>";
</script>
<style>
.login_header
{
	background-color: #4486F6;
	border-radius: 3px;
	padding-bottom: 20px;
}
</style>
		<div style="height: 100%; padding: 50px 0; background-color: #2c3037" class="row row-table">
			<div class="col-lg-4 col-md-7 col-sm-8 col-xs-12" align="center">
				<div class="panel panel-default panel-flat" style="max-width:600px; min-width:300px;">
           
					<div id="main">
						<div id="login">
							<p class="login_header text-center mb-lg">
							<br>
								<a href="#">
									<img src="<?php echo base_url()."resources/images/logo_blue_white.png"; ?>" alt="Image" class="block-center img-rounded">
								</a>
							</p>
							<p class="text-center mb-lg">
								<strong>Please Enter your Email Address.</strong>
							</p>
							<div class="panel-body" style="margin-top: 30px;">	
							<form method="POST">
								<div class="form-group has-feedback">
									<input required type="text" name="email" id="name" placeholder="* Email Address" class="form-control"/>
								</div>
								<div class="clearfix" height="15px;">&nbsp;</div>
								<button type="submit" class="btn btn-block btn-primary" name="submit">Recover Password</button>
								<br />
								
								<div class="clearfix">
									<div class="pull-left">
									Not yet registered? 
									<a style="position:relative;right:0px;" href="<?php echo base_url().'login/register' ?>">
										<button type="button" class="btn btn-default">Get VocaDB API Now!</button>
									</a></div>

								</div>
							</form>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		function donothing()
		{
			return;
		}
		
		$('form').submit(function (e) {
			e.preventDefault();
			var name = $('#name').val();
			var emailregex = /.+@.+/;
			if( !name || !name.match(emailregex) )
			{
				$('#name').parent('div').addClass("has-error");
				$('#name').popover('show');
			}
			else
			{
				$('#name').parent('div').removeClass("has-error");
				
				$.ajax({
					url: base_url+"login/forgotpass",
					type:'POST',
					data:
					{
						email: $("input[name=email]").val()
					},
					success: function(msg)
					{
						var result = JSON.parse(msg);
						$('#vocamodalmsg').html(result.msg);
						$('#vocadbmodal').modal('show');
						if(result.state)
						{
							setTimeout(openUrl(result.link), 4000);
						}
						else
						{
							$('#name').parent('div').addClass("has-error");
							$('#password').parent('div').addClass("has-error");
						}
					}
				});
			}
		});
		</script>
<!-- Modal for footer -->
<div class="modal fade" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <p id="vocamodalmsg" ></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
