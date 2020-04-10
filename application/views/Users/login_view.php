    <div class="signInContainer mx-auto">
          <div class="column">

              <div class="header">
                    <a href="index.php"><img src="<?php echo base_url();?>assets/images/icons/vedant.png" alt="vedant"></a>
                    <h3>Sign In</h3>
                    <span>to continue to Vedant</span>
              </div>
              
              <div class="loginForm">
                  <?php

                   if(isset($error_message)){    

                    echo "<span class='text-danger'>". $error_message."</span>";

                   } 
                      
                   ?>
                   <form action="<?php echo base_url();?>users/loginProcessing" method="POST">
                       <span class="text-danger"><?php if(form_error('username')){echo "*". form_error('username');} ?></span>

                       <input type="text" name="username" value="<?php echo set_value('username');?>" placeholder="Username" required autocomplete="off">
                       <input type="password" name="password" placeholder="Password" required="">
                       <input type="submit" name="submitButton" value="SUBMIT">
                   </form>

              </div>

              <a href="<?php echo base_url();?>users/signup" class="signInMessage">Need an account? Sign Up here!</a>
          </div>
      </div>