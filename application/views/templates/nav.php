<?php
$image = base_url()."resources/app/img/user/noimage.jpg";
if ( $this->session->userdata('pic') != NULL ){$image = $this->session->userdata('pic');}
?>
 <!-- START Sidebar (left)-->
         <nav class="sidebar" style="min-height:100%;">
            <ul class="nav">
				<li style="height:70px;background-color:#4486F6">
					<a style="padding: 10px 0px;" href="#">
						<img src="<?php echo base_url()."resources/images/logo_blue_white.png"; ?>" alt="Image"  class="center-block img-rounded">
					</a>
				</li>
				<!-- START user info-->
               <li>
                  <div class="item user-block has-submenu" valign="top">
                     <!-- User picture-->
                     <div class="user-block-picture">
                        <img src="<?php echo $image; ?>" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                        
                     </div>
                     <!-- Name and Role-->
                     <div class="user-block-info">
                        <span class="user-block-name item-text">Welcome,<br/> <?php echo $this->session->userdata('name');?></span>
                     </div>
                  </div>
               </li>
               <!-- END user info-->
               <!-- START Menu-->
               <li>
                  <a href="<?php echo base_url()."feat"; ?>" title="Features"  class="no-submenu">
                     <em class="fa fa-check-square"></em>
                     <span class="item-text">Features</span>
                  </a>
                  
               </li>
               <li>
                  <a href="<?php echo base_url()."stats"; ?>" title="Usage"  class="no-submenu">
                     <em class="fa fa-bar-chart-o"></em>
                     <span class="item-text">Usage Statistics</span>
                  </a>
               </li>
               <li>
                  <a href="<?php echo base_url()."billing"; ?>" title="Billing" data-toggle="collapse-next" class="has-submenu">
                     <em class="fa fa-money"></em>
                     <span class="item-text">Billing</span>
                  </a>
               </li>
               <li>
                  <a href="<?php echo base_url()."documentation"; ?>" title="Documentation"  class="no-submenu">
                    <em class="fa fa-book"></em>
                    <span class="item-text">Documentation</span>
                  </a>               
               </li>
               <li>
                  <a href="<?php echo base_url()."contact"; ?>" title="Contact"  class="no-submenu">
                     <em class="fa fa-envelope"></em>
                     <span class="item-text">Contact Us</span>
                  </a>
               </li>
			   <li>
                  <a href="<?php echo base_url()."accountsettings"; ?>" title="Account_Settings"  class="no-submenu">
                     <em class="fa fa-cog"></em>
                     <span class="item-text">Account Settings</span>
                  </a>
               </li>
			   <li>
                  <a href="<?php echo base_url()."logout"; ?>" title="Contact"  class="no-submenu">
                     <em class="fa fa-sign-out"></em>
                     <span class="item-text">Logout</span>
                  </a>
               </li>
               <!-- END Menu-->
               <!-- Sidebar footer    -->
               
            </ul>
         </nav>
         <!-- END Sidebar (left)-->
<script type="text/javascript">
var thisurl =  "<?php echo current_url();?>";
document.querySelectorAll('[href="'+thisurl+'"]')[0].parentNode.classList.add('active');
</script>