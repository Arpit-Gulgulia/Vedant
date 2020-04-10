<script src="assets/js/jquery.js"></script>
<script src="assets/js/likeVideo.js"></script>
<script src="assets/js/dislikeVideo.js"></script>
<script src="assets/js/subscribe.js"></script>

<div class="watchLeftColumn">

     <video class="videoPlayer" controls <?php if($autoPlay){echo "autoplay";} else{echo "";}?>>
          
          <source src="<?php echo base_url().$filePath ?>" type = "video/mp4">
          Your Broswer doesn't support the video tag!
     
     </video>

     <div class="videoInfo">
     
        <h1> <?php echo $title;?> </h1>

        <div class="bottomSection">
        
            <span class="viewCount"> <?php echo $views; ?> views</span>
            
            <div class="control">
               <?php
                   if(isset($_SESSION['username']) && $_SESSION['username']!=="") {
                
                ?>
                
                    <button class='likeButton' onclick ='likeVideo(this,<?php echo $id ;?>,"<?php echo $_SESSION['username'] ?>")' style="background: transparent;border: none">
                        <img src="<?php if(!$wasLiked) echo "assets/images/icons/thumb-up.png"; else {echo "assets/images/icons/thumb-up-active.png";} ?>">
                        <span class='text'> <?php echo $likesCount?> </span>
                    </button>
                    <button class='dislikeButton' onclick ='dislikeVideo(this,<?php echo    $id ;?>,"<?php echo $_SESSION['username'] ?>")' style="background: transparent;border: none">
                           <img src="<?php if(!$wasDisliked) echo "assets/images/icons/thumb-down.png"; else {echo "assets/images/icons/thumb-down-active.png";} ?>">
                        <span class='text'> <?php echo $dislikesCount?> </span>
                    </button>
                <?php }
                
                else {
                    ?>
                    
                    <button type="button" class="likeButton" data-toggle="modal" data-target="#exampleModal" style="background: transparent;border: none">
                        <img src="<?php if(!$wasLiked) echo "assets/images/icons/thumb-up.png"; else {echo "assets/images/icons/thumb-up-active.png";} ?>">
                        <span class='text'> <?php echo $likesCount?> </span>
                    </button>
                    <button type="button" class="dislikeButton" data-toggle="modal" data-target="#exampleModal" style="background: transparent;border: none">
                        <img src="<?php if(!$wasDisliked) echo "assets/images/icons/thumb-down.png"; else {echo "assets/images/icons/thumb-down-active.png";} ?>">
                        <span class='text'> <?php echo $dislikesCount?> </span>
                    </button>

                   <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    You have to be logged in first!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">
                                        <a href="<?php echo base_url();?>users/login" style="color: #fff">Login</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

                }

                ?>
            </div>
        </div>
     
     </div>

     <div class="secondaryInfo">
         
         <div class="topRow">
         
              <a href='<?php echo base_url();?>profile?username=<?php echo $uploadedBy;?>'>
              
                 <img src = <?php echo $videoUploadedByProfilePic; ?> class = 'profilePicture' >
              
              </a>
            
              <div class="uploadInfo">
                  <span class="owner">
                      <a href='<?php echo base_url();?>profile?username=<?php echo $uploadedBy;?>'>
                          <?php echo $uploadedBy; ?>
                      </a>
                  </span>
                  <span class="date">Published on <?php echo date("M j, Y",strtotime($uploadDate)) ;?></span>
              </div>

              <?php
               //If Video UploadedBy username is same as Logged in Username
                  if($uploadedBy == $this->session->userdata('username')) {
                     
              ?>
                   <div class="editVideoButtonContainer">
                        <a href="<?php echo base_url()?>editVideo?videoId=<?php echo $id ?>">
                            <button class='edit button'>
                                <span class='text'>EDIT VIDEO</span>
                            </button>
                        </a>
                   </div>
              <?php       
                  }
                  else{
                      //Else if Logged in username is subscribe to UploadedBy Users
                      if($isSubscribedTo && isset($_SESSION['username'])) {
             ?>             
                         <div class="subscribeButtonContainer">
                         
                         
                            <button class='unsubscribe button' onclick ='subscribe(this,"<?php echo $uploadedBy;?>","<?php echo $_SESSION['username'] ?>")'>
                                <span class='text'>SUBSCRIBED <?php echo $videoUploadedBySubscribers ?> </span>
                            </button>

                         </div>
             <?php             
                      }
                      else {

                        if(!isset($_SESSION['username']) || $username==="") {
            ?>
                         <div class="subscribeButtonContainer">
                         
                         
                            <button class='subscribe button' data-toggle="modal" data-target="#exampleModal">
                                <span class='text'>SUBSCRIBE <?php echo $videoUploadedBySubscribers ;?> </span>
                            </button>

                            <!-- Modal -->
                             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             You have to be logged in first!
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="button" class="btn btn-primary">
                                                 <a href="<?php echo base_url()?>users/login" style="color: #fff">Login</a>
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                         </div>

            <?php              
                        }
                        else {
            ?>
                               <div class="subscribeButtonContainer">
                         
                         
                                    <button class='subscribe button' onclick ='subscribe(this,"<?php echo $uploadedBy;?>","<?php echo $_SESSION['username'] ?>")'>
                                        <span class='text'>SUBSCRIBE <?php echo $videoUploadedBySubscribers ;?> </span>
                                    </button>

                               </div>
            <?php
                        }
                    }
                  }
              
              ?>

         </div>

         <div class="descriptionContainer">
             <?php echo $description;?>
         </div>

     </div>







