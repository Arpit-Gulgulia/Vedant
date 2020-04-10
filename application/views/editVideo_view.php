<?php
if (!isset($_SESSION['username']) || $_SESSION['username']===""){
    header("Location: signIn");
}
//echo $detailsMessage;
//print_r($categories);
//die();
?>


<div class="container border py-3 column" style="margin-top:50px" xmlns="http://www.w3.org/1999/html">
    <h3 class='text-center mb-5'>Edit Video Details</h3>
    <?php $this->load->helper('form'); ?>

    <?php $this->load->library('form_validation');?>


    <?php echo form_open('editVideo?videoId='.$_GET["videoId"]); ?>
    <span class="title">Your Uploaded Video details</span>

    <?php if ($detailsMessage!=="") echo "<div class='alert alert-success'>$detailsMessage</div>"; ?>

    <span class="text-danger"><?php if(form_error('titleInput')){echo "*". form_error('titleInput');} ?></span>
    <?php

    $attributes = array(
        'class' => 'form-control my-3',
        'name' => 'titleInput',
        'placeholder' => 'Title',
        'value' => set_value('titleInput',$video->title),
        'autocomplete' => 'off',
        'required' => 'required'

    );

    echo form_input($attributes) ;
    ?>

    <span class="text-danger"><?php if(form_error('descriptionInput')){echo "*". form_error('descriptionInput');} ?></span>
    <?php

    $attributes = array(

        'class' => 'form-control my-3',
        'name' => 'descriptionInput',
        'placeholder' => 'Description',
        'value' => set_value('lastName',$video->description),
        'autocomplete' => 'off',
        'required' => 'required'

    );

    echo form_textarea($attributes) ;
    ?>

    <div class="form-group">
        <?php

        $option = array(
            '0' => 'Private',
            '1' => 'Public',
            'required' => 'required'

        );

        echo form_dropdown('privacyInput',$option,'1');

        ?>
    </div>


    <div class="form-group">
        <?php

        $option = array();

        foreach($categories as $object) {
            $option[$object->id] = $object->name;
        }


        echo form_dropdown('categoryInput',$option,'1');

        ?>
    </div>



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



</div>





