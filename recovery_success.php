<section class="header_text sub">
   <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
   <h4><span>Login or Regsiter</span></h4>
</section>			
<section class="main-content">				
   <div class="row">
      <div class="span5">					
         <h4 class="title"><span class="text"><strong>Password</strong> Recovery</span></h4>
         <?php
            $dt = $this->session->userdata("msg");
            if ($dt != NULL) {
                echo $dt;
                $this->session->unset_userdata("msg");
            }
            ?>
         <form action="<?php echo base_url() ?>recovery/success" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <fieldset>
               <div class="control-group">
                  <label class="control-label">Password</label>
                  <div class="controls">
                     <input type="password" name="pass" placeholder="Enter your password" id="username" class="input-xlarge">
                  </div>
               </div>
               <div class="control-group">
                  <input tabindex="3" name="sub" class="btn btn-inverse large" type="submit" value="Update Password">
                 
               </div>
            </fieldset>
         </form>				
      </div>
      
   </div>
</section>	