<section class="header_text sub">
   <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
   <h4><span>Login or Regsiter</span></h4>
</section>			
<section class="main-content">				
   <div class="row">
      <div class="span5">					
         <h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
         <?php
            $dt = $this->session->userdata("msg");
            if ($dt != NULL) {
                echo $dt;
                $this->session->unset_userdata("msg");
            }
            ?>
         <form action="<?php echo base_url() ?>login" method="post">
            <input type="hidden" name="next" value="/">
            <fieldset>
               <div class="control-group">
                  <label class="control-label">Email</label>
                  <div class="controls">
                     <input type="email" name="email" placeholder="Enter your username" id="username" class="input-xlarge">
                  </div>
               </div>
               <div class="control-group">
                  <label class="control-label">Password</label>
                  <div class="controls">
                     <input type="password" name="pass" placeholder="Enter your password" id="password" class="input-xlarge">
                  </div>
               </div>
               <div class="control-group">
                  <input tabindex="3" name="sub" class="btn btn-inverse large" type="submit" value="Sign into your account">
                  <hr>
                  <p class="reset">Recover your <a tabindex="4" href="<?php echo base_url() ?>recovery" title="Recover your username or password">Password</a></p>
               </div>
            </fieldset>
         </form>				
      </div>
      <div class="span7">					
         <h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
         <form action="<?php echo base_url() ?>register" method="post" class="form-stacked">
            <fieldset>
               <div class="control-group">
                  <label class="control-label">Full Name</label>
                  <div class="controls">
                     <input type="text" name="fn" placeholder="Enter your Full Name" class="input-xlarge">
                  </div>
               </div>
               <div class="control-group">
                  <label class="control-label">Email address:</label>
                  <div class="controls">
                     <input type="email" name="email" placeholder="Enter your Email" class="input-xlarge">
                  </div>
               </div>
               <div class="control-group">
                  <label class="control-label">Password:</label>
                  <div class="controls">
                     <input type="password" name="pass" placeholder="Enter your Password" class="input-xlarge">
                  </div>
               </div>							                            
               <div class="control-group">
                  <p>Now that we know who you are. I'm not a mistake! In a comic, you know how you can tell who the arch-villain's going to be?</p>
               </div>
               <hr>
               <div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" name="sub" value="Create your account"></div>
            </fieldset>
         </form>					
      </div>				
   </div>
</section>	