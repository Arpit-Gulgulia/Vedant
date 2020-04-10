<?php

?>

<div class="signInContainer mx-auto">

        <div class="column">

            <div class="header">
                <a href="index.php"><img src="<?php echo base_url()?>assets/images/icons/vedant.png" title="logo" alt="Site logo"></a>
                <h3>Sign Up</h3>
                <span>to continue to Vedant</span>
            </div>

            <div class="loginForm">
               
               <?php $this->load->helper('form'); ?>
               
               <?php $this->load->library('form_validation');?>

         
               <?php echo form_open('users/signupProcessing'); ?>
                <!-- <form action="signUp.php" method="POST"> -->
                 
                <span class="text-danger"><?php if(form_error('firstName')){echo "*". form_error('firstName');} ?></span>
                <?php

                   $attributes = array(

                    'name' => 'firstName',
                    'placeholder' => 'First name',
                    'value' => set_value('firstName'),
                    'autocomplete' => 'off',
                    'required' => 'required'

                   );
                    
                    echo form_input($attributes) ;
                 ?>
                <!-- <input type="text" name="firstName" placeholder="First name" value="" autocomplete="off" required> -->

                <span class="text-danger"><?php if(form_error('lastName')){echo "*". form_error('lastName');} ?></span>
                <?php

                   $attributes = array(

                    'name' => 'lastName',
                    'placeholder' => 'Last name',
                    'value' => set_value('lastName'),
                    'autocomplete' => 'off',
                    'required' => 'required'

                   );
              
                    echo form_input($attributes) ;
                 ?>
                <!-- <input type="text" name="lastName" placeholder="Last name" value="" autocomplete="off" required> -->
                 
                <span class="text-danger"><?php if(form_error('username')){echo "*". form_error('username');} ?></span>
                 <?php

                   $attributes = array(

                    'name' => 'username',
                    'placeholder' => 'Username',
                    'value' => set_value('username'),
                    'autocomplete' => 'off',
                    'required' => 'required'

                   );
              
                    echo form_input($attributes) ;
                 ?>
                <!-- <input type="text" name="username" placeholder="Username" value="" autocomplete="off" required> -->
                 
                 
                <!-- <input type="email" name="email" placeholder="Email" value="" autocomplete="off" required>
                <input type="email" name="email2" placeholder="Confirm email" value="" autocomplete="off" required>
                  -->
               <span class="text-danger"><?php if(form_error('email')){echo "*". form_error('email');} ?></span>
                 <?php

                   $attributes = array(

                    'name' => 'email',
                    'placeholder' => 'Email',
                    'value' => set_value('email'),
                    'autocomplete' => 'off',
                    'type' => 'email',
                    'required' => 'required'

                   );
              
                    echo form_input($attributes) ;
                 ?> 

                  <span class="text-danger"><?php if(form_error('email2')){echo "*". form_error('email2');} ?></span>
                 <?php

                   $attributes = array(

                    'name' => 'email2',
                    'placeholder' => 'Confirm Email',
                    'value' => set_value('email2'),
                    'type' => 'email',
                    'autocomplete' => 'off',
                    'required' => 'required'

                   );
              
                    echo form_input($attributes) ;
                 ?> 
                 
                 
                <!-- <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <input type="password" name="password2" placeholder="Confirm password" autocomplete="off" required> -->
                <span class="text-danger"><?php if(form_error('password')){echo "*". form_error('password');} ?></span>
               <?php
               
               $attributes = array(

                  'name' => 'password',
                  'placeholder' => 'Password',
                  'autocomplete' => 'off',
                  'value' => '',
                  'required' => 'required'

               );
                 
               echo form_password($attributes);
               

               ?>
               
               <span class="text-danger"><?php if(form_error('password2')){echo "*". form_error('password2');} ?></span>
                <?php
               
               $attributes = array(

                  'name' => 'password2',
                  'placeholder' => 'Confirm Password',
                  'autocomplete' => 'off',
                  'value' => '',
                  'required' => 'required'

               );
                 
               echo form_password($attributes);
               

               ?>
                <!-- <input type="submit" name="submitButton" value="SUBMIT" style="cursor: pointer;"> -->
               
               <?php 
               
               $attributes = array(
                    
                  'name' => 'submitButton',
                  'value' => 'submit',
                  'style' => 'cursor:pointer'

               );
               
               echo form_submit($attributes);

               ?>
                
               </form>


            </div>

            <a class="signInMessage" href="<?php echo base_url(); ?>Users/login">Already have an account? Sign in here!</a>
        
        </div>
        
</div>





