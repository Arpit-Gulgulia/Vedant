<?php
if (!isset($_SESSION['username']) || $_SESSION['username']===""){
    header("Location: signIn");
}
?>


<div class="container border py-3 column" style="margin-top:50px" xmlns="http://www.w3.org/1999/html">
    <h3 class='text-center mb-5'>Settings</h3>
    <?php $this->load->helper('form'); ?>

    <?php $this->load->library('form_validation');?>


    <?php echo form_open('settings/userDetailsProcessing'); ?>
    <span class="title">User details</span>

    <?php if(isset($detailsMessage)) echo "<div class='alert alert-success'>$detailsMessage</div>"; ?>

    <span class="text-danger"><?php if(form_error('firstName')){echo "*". form_error('firstName');} ?></span>
    <?php

    $attributes = array(
        'class' => 'form-control my-3',
        'name' => 'firstName',
        'placeholder' => 'First name',
        'value' => set_value('firstName',$_SESSION['firstName']),
        'autocomplete' => 'off',
        'required' => 'required'

    );

    echo form_input($attributes) ;
    ?>

    <span class="text-danger"><?php if(form_error('lastName')){echo "*". form_error('lastName');} ?></span>
    <?php

    $attributes = array(

        'class' => 'form-control my-3',
        'name' => 'lastName',
        'placeholder' => 'Last name',
        'value' => set_value('lastName',$_SESSION['lastName']),
        'autocomplete' => 'off',
        'required' => 'required'

    );

    echo form_input($attributes) ;
    ?>

    <span class="text-danger"><?php if(form_error('email')){echo "*". form_error('email');} ?></span>
    <?php

    $attributes = array(

        'class' => 'form-control my-3',
        'name' => 'email',
        'placeholder' => 'Email',
        'value' => set_value('email',$_SESSION['email']),
        'autocomplete' => 'off',
        'type' => 'email',
        'required' => 'required'

    );

    echo form_input($attributes) ;
    ?>



    <!-- <input type="submit" name="submitButton" value="SUBMIT" style="cursor: pointer;"> -->

    <?php

    $attributes = array(

         'class' => 'btn',
        'name' => 'saveDetailsButton',
        'value' => 'save',
        'style' => 'cursor:pointer'

    );

    echo form_submit($attributes);

    ?>

    </form>

    <?php echo form_open('settings/userPasswordProcessing',['class' => 'mt-5 border-top pt-5']); ?>

    <span class="title" style="margin-top: 50px">Update password</span>
    <?php if(isset($passwordMessage)) echo "<div class='alert alert-success'>$passwordMessage</div>"; ?>
    <span class="text-danger"><?php if(form_error('oldPassword')){echo "*". form_error('oldPassword');} ?></span>
    <?php

    $attributes = array(
        'class' => 'form-control my-3',
        'name' => 'oldPassword',
        'placeholder' => 'Old password',
        'autocomplete' => 'off',
        'value' => '',
        'required' => 'required'

    );

    echo form_password($attributes);


    ?>

    <span class="text-danger"><?php if(form_error('newPassword')){echo "*". form_error('newPassword');} ?></span>
    <?php

    $attributes = array(
        'class' => 'form-control my-3',
        'name' => 'newPassword',
        'placeholder' => 'New Password',
        'autocomplete' => 'off',
        'value' => '',
        'required' => 'required'

    );

    echo form_password($attributes);


    ?>

    <span class="text-danger"><?php if(form_error('newPassword2')){echo "*". form_error('newPassword2');} ?></span>
    <?php

    $attributes = array(
        'class' => 'form-control my-3',
        'name' => 'newPassword2',
        'placeholder' => 'Confirm new Password',
        'autocomplete' => 'off',
        'value' => '',
        'required' => 'required'

    );

    echo form_password($attributes);


    ?>

    <?php

    $attributes = array(
        'class' => 'btn',
        'name' => 'savePasswordButton',
        'value' => 'save',
        'style' => 'cursor:pointer'

    );

    echo form_submit($attributes);

    ?>
    </form>


</div>



<script>
    $("form").submit(function() {
        $("#loadingModal").modal("show");
    });
</script>



<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                Please wait. This might take a while.
                <img src="<?php echo base_url();?>assets/images/icons/loading-spinner.gif">
            </div>

        </div>
    </div>
</div>

