<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($Nvoca);
// echo $Nvoca['user_info']->email;
// exit();
?><!DOCTYPE html>
<style>
.tab-content
{
	border: 0px;
}
.edit_button, .edit_button:focus
{
	cursor: pointer;
	background: none;
	border: none;
	box-shadow: none;
	font-size: 20px;
	padding: 15px;
	outline:none;
}
.edit_button:hover
{
	background: none;
	color: blue;
	text-decoration: none;
	border: 0px;
}
#gas, #profile
{
	max-width: 100%;
	border: 0px solid black;
}
#gas table, #profile table
{
	width: 100%;
	max-width: 500px;
}
.ctr_label
{
	text-align: right;
	padding: 20px;
}
.input_td
{
	max-width: 30%;
}
.button_td
{
	text-align: left;
	// padding: 20px 20px 20xp 0px;
	width: 102px;
}
.disabled, .disabled:hover
{
	cursor: not-allowed;
	background: none;
	color: initial;
}
.as_nav .active
{
	color: white;
}
.as_nav li.active a, .as_nav li.active a:focus
{
	background-color: #4486F6;
}
.save_button
{
	color: #5cb85c;
}
.save_button:hover
{
	color: #5cb85c;
}
.cancel_button
{
	color: #d9534f;
}
.cancel_button:hover
{
	color: #d9534f;
}
#pic_upload_msg
{
	font-size: 11px;
}
#email_confirm_msg
{
	font-size:12px;
	position:absolute;
}
</style>

<br/><br/><br/>
<div>
    <div id="gas">
		<h4>Settings</h4>
		<hr/>
		<table align="center">
		<tr>
			<td class="ctr_label"><label class="control-label">Password</label></td>
			<td class="input_td"><input type="password" class="form-control" value="asd123" readonly></td>
			<td class="button_td">
				<button class="edit_button" voca-pass="Edit" ><span class="fa fa-edit"></span></button>
				<!--<button class="edit_button" voca-pass="Edit" ><span class="fa fa-edit"></span></button>-->
			</td>
		</tr>
		</table>
		<hr/>
	</div>
</div>
<!-- Modal for footer -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<form id="changepass">
    <div class="modal-content">
    <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
    </div>
    <div class="modal-body">
		<div class="row">
			<label class="col-sm-3 control-label">Current Password</label>
			<div class="col-sm-9">
				<input type="password" name="changepass_oldpass" class="form-control" required>
				<p id="changepass_msg" style="display:none;color:red;font-size:12px;">Incorrect password.</p>
			</div>
		</div>
		<br/>
		<div class="row">
			<label class="col-sm-3 control-label">New Password</label>
			<div class="col-sm-9">
				<input type="password" name="changepass_newpass" id="changepass_newpass" class="form-control" required data-parsley-type="alphanum">
			</div>
		</div>
		<br/>
		<div class="row">
			<label class="col-sm-3 control-label">Confirm New Password</label>
			<div class="col-sm-9">
				<input type="password" name="changepass_confrmpass" class="form-control" required data-parsley-equalto="#changepass_newpass">
			</div>
		</div>
    </div>
    <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Change Password</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
	</form>
  </div>
</div>
<script src="<?php echo base_url().'resources/'; ?>vendor/parsley/parsley.min.js"></script>
<script>


$(".edit_button[voca-pass='Edit']").on("click",function(e){
	$('#vocadbmodal').modal('show');
});
$("#changepass").on("submit",function(e){
	e.preventDefault();
	var f = $(this);
	f.parsley().validate();
	if (f.parsley().isValid()) 
	{
		$.ajax({
				url: base_url+"admin/account_change_password",
				type:'POST',
				data:{
					old_pass: $("input[name='changepass_oldpass']").val(),
					new_pass: $("input[name='changepass_newpass']").val(),
					cfrm_pass: $("input[name='changepass_confrmpass']").val()
					
				},
				success: function(msg)
				{
					if(msg)
					{
						$("#changepass_msg").html('Change Password Successful').css('color','green');
						$("#changepass_msg").css('display','inline');
						$(".modal-footer button[type='submit']").addClass('disabled');
					}
					else
					{
						$("#changepass_msg").html('Incorrect password').css('color','red');
						$("#changepass_msg").css('display','inline');
					}
				}
			});
	}
});
$('#vocadbmodal').on('hidden.bs.modal',function(){
	$("#changepass input[type='password']").val("");
	$("#changepass").parsley().reset();
});
</script>