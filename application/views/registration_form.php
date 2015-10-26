<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	// echo $Nvoca['fb_email']." ".$Nvoca['fb_name'];
	// echo "<pre>";
	// print_r($Nvoca);
	// exit();
	?>
	<body>
		<div style="height: 100%; padding: 50px 0; background-color: #2c3037" class="row row-table">
			<div style="padding:0px;" class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
			<div class="panel panel-default panel-flat">
					<div id="main">
						<div id="login">
						<p class="text-center mb-lg">
							<br>
								<a href="#">
									<img src="<?php echo base_url()."resources/images/logo_blue_white.png"; ?>" alt="Image" class="block-center img-rounded">
								</a>
							</p>
							<p class="text-center mb-lg">
								<strong>FILL IN INFORMATION</strong>
							</p>
							<div class="panel-body">
								<?php 
									//echo form_open('user_authentication/user_login_process'); 
									echo "<div class='error_msg'>";
									if (isset($error_message)) {
										echo $error_message;
									}
									//echo validation_errors();
									echo "</div>";
								?>
							</div>
							
							
							<form id="vocadb_regform" action="" method="post" data-toggle="validator" data-parsley-validate novalidate>
							<div class="panel-body">
								
								<div class="form-group has-feedback">
									<input type="text" type="company" name="company" id="company" placeholder="Company" class="form-control" 
									required 
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
							
								<div class="form-group has-feedback">
									<input <?php if(isset($Nvoca['fb_email'])){echo $Nvoca['fb_email'];}?>  type="text" type="email" name="email" id="name" placeholder="Email address" class="form-control" 
									required data-parsley-type="email" 
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>

								<div class="form-group has-feedback">
									<input <?php if(isset($Nvoca['fb_name'])){echo $Nvoca['fb_name'];}?> type="text" type="lname" name="lname" id="lname" placeholder="Name" class="form-control" 
									required 
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								
								
								
								<div class="form-group has-feedback">
									<input type="text" type="platform" name="platform" id="platform" placeholder="Platform? e.g. iOS,Android" class="form-control" 
									required 
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								
								<div class="form-group has-feedback">
									<textarea style="resize: none;" class="form-control" required type="search" name="how" placeholder="How to use? e.g. App and/or Web"></textarea>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								
								<div class="form-group has-feedback">
									<input type="text" type="nationality" name="nationality" id="nationality" placeholder="Nationality? Chinese, Japanese, Korean." class="form-control" 
									required 
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>

								<div class="form-group has-feedback">
									<input type="password" name="password" id="password" placeholder="Password" class="form-control"
									required data-parsley-type="alphanum"
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="password" name="repassword" id="repassword" placeholder="Confirm Password" class="form-control"
									required data-parsley-equalto='#password'
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
							
								<div class="clearfix">
									<div class="checkbox c-checkbox pull-left mt0">
										<label>
										   <input required id="terms" type="checkbox" value="">
										   <span class="fa fa-check"></span>I agree with the <a href="#">terms</label>							
									</div>
								</div>
								
								<div class="form-group has-feedback">
									<button type="submit" class="btn btn-block btn-primary" name="submit"> Register</button>
								</div>
							</div>
							</form>
							
						</div>
					</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url()."resources/vendor/jquery.min.js"; ?>"></script>
		<script type="text/javascript">
		function openUrl()
		{
			window.location = base_url;
		}
		
		var base_url = "<?php echo base_url();?>";	
		$('#vocadb_regform').on("submit",function (e) {
			var f = $(this);
			f.parsley().validate();

			if (f.parsley().isValid()) 
			{
				e.preventDefault();
				$.ajax({
					url: base_url+"new_user_registration",
					type:'POST',
					data:
					{
						company: $("input[name=company]").val(),
						email: $("input[name=email]").val(),
						password: $("input[name=password]").val(),
						name: $("input[name=lname]").val(),
						platform: $("input[name=platform]").val(),
						how: $("textarea[name=how]").val(),
						nationality: $("input[name=nationality]").val(),
						//temp
						confirm: 0,
						link: "vocabdb"
						//end temp
					},
					success: function(check)
					{
						if( !check )
						{					
							$('#vocamodalmsg').html("Email already registered");
						}
						else
						{
							$('#vocamodalmsg').html("Confirmation email sent!");
							setTimeout(openUrl, 3000);
						}
						$('#vocadbmodal').modal('show');
					}               
				});
			}
				
		});
		
		</script>
		<script src="<?php echo base_url().'resources/'; ?>vendor/parsley/parsley.min.js"></script>
<!-- Modal for footer -->
<div class="modal fade" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Your VocaDB Registration</h4>
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