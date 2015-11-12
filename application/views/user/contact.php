<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style>
#left_contact_div
{
	margin: 15px 0px;
}
.left_contact
{
	border-right: 10px white solid;
}
.right_contact
{
	text-align: center;
	list-style-type: none;
	font-size: 16px;
	padding: 20px;
	word-wrap:break-word;
}
.thisrow
{
	background-color: rgb(230, 230, 230);
	margin-top: 50px;
	border: 10px white solid;
	// border-left: 45px while solid;
}
.social_media_buttons button
{
	border-radius:50%;
	font-size:30px;
	padding: 10px;
	width: 50px;
	margin: 5px;
}
</style>
<div align="center">
	<h2>We'd Love to hear from YOU</h2>
	<br/>
	<p>
		We are here to answer any questions you may have about VocaDB API. Send us a message and we'll respond as soon as we can.
	</p>
	<br/><br/>
	<div class="row thisrow">
		<div class="col-xs-9 left_contact">
			<div id="left_contact_div">
			<h4>
				Drop us a message
			</h4><form>
			<fieldset>
				<div class="form-group">
					<input name="subj" type="text" required placeholder="Subject" class="form-control">
				</div>
			</fieldset>
			<fieldset style="margin-top: -25px;">
				<div class="form-group">
					<textarea name="contnt" placeholder="Message" style="resize:vertical; max-height:300px; min-height:200px;" class="form-control" required></textarea>
				</div>
            </fieldset>
				<div>
					<button type="submit" style="width: 60%" class="btn btn-block btn-default">Send</button>
				</div>
			</form>
			</div>
		</div>
		<div class="col-xs-3 right_contact" align="center">
			OR Email us at<br/>
			<span class="fa fa-envelope"></span> vocadb.api@gmail.com
			<br/><br/><br/>
			<span style="font-size:12px;">VocaDB API on Social Media:</span><br/>
			<div class="social_media_buttons">
			<button type="button" class="btn btn-primary" style="background-color: rgb(69, 97, 157);"><span class="fa fa-facebook"></span></button>
			<button type="button" class="btn btn-primary" style="background-color: #5EA9DD;"><span class="fa fa-twitter"></span></button>
			<button type="button" class="btn btn-primary" style="background-color: #CC2127;"><span class="fa fa-pinterest"></span></button>
			<!--<button type="button" class="btn btn-primary" style="border-radius:50%;font-size:30px;background-color: #00aff0;"><span class="fa fa-skype"></span></button>
			skype:********?call
			<br/>vocadbsoftwaredevelopment-->
			</div>
			<br/>
		</div>
	</div>
</div>

<div class="modal fade" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thank you for contacting us.</h4>
      </div>
      <div class="modal-body">
        <p id="vocamodalmsg" >You are very important to us, all information received will always remain confidential. We will contact you as soon as we review your message.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$('form').on("submit",function(e){
	e.preventDefault();
	if( $("form textarea[name='contnt']").val().length > 30 )
	{
		$.ajax({
			url: base_url+"send_message_2",
			type:'POST',
			data:{
				subject: $("form input[name='subj']").val(),
				content: $("form textarea[name='contnt']").val()
			},
			success: function(result)
			{
				console.log(result);
				$('#vocadbmodal').modal('show');
			}			
		});
	}
});
</script>