<?php
if (!isset($_SESSION['username']) || $_SESSION['username']===""){
    header("Location: signIn");
}
?>

<div class="container border py-3 column" style="margin-top:50px">
    <h3 class='text-center mb-5'>Upload Your Video</h3>
    <?php  if(isset($error)) {
         echo "<span class='text text-danger'".$error."</span>" ;
        } 
    ?>

    <?php echo form_open_multipart('upload/processing'); ?>

    <div class="form-group">

        <?php 
             echo form_label('Your File','formGroupExampleFile1');

             $attributes = array(

                'id' => 'formGroupExampleFile1',
                'class' => 'form-control-file',
                'name' => 'fileInput',
                'enctype' => 'multipart/form-data',
                'required' => 'required'
             ); 

             echo form_upload($attributes,'required');


        ?>

    </div>

    <div class="form-group">


        <?php 
             echo form_label('Your Title','formGroupExampleInput');

             $attributes = array(

                'id' => 'formGroupExampleInput',
                'class' => 'form-control',
                'name' => 'titleInput',
                'placeholder' => 'Title',
                'required' => 'required'
             ); 

             echo form_input($attributes);


        ?>

    </div>

    <div class="form-group">

        <?php

           $attributes = array(

              'class' => 'form-control',
              'placeholder' => 'Description',
              'name' => 'descriptionInput',
              'rows' => '3',
              'required' => 'required'

           );

           echo form_textarea($attributes);
        
        ?>  
         

    </div>

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

    <?php

    $attributes = array(

        'class' => 'btn',
        'name' => 'saveDetailsButton',
        'value' => 'save',
        'style' => 'cursor:pointer'

    );

    echo form_submit($attributes);

    ?>

    <?php echo form_close()?>
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

