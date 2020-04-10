<!-- DIV CONTAINER CONTINUE WITH SUBSCRIPTION VIEW -->
       <div class="row">
          <div class="col-sm-12 videoGridHeader">
              Recommended
          </div>
             <?php
             
                foreach($suggestedVideos as $video) {
             ?>        
                    <div class='col-md-3'>
                    
                       <a href=" <?php echo base_url();  ?>watch?id=<?php echo $video['id'] ?> ">
                 
                            <div class="videoGridItem">
                            
                                <div class="thumbnail">
                                    
                                    <img src="<?php echo base_url().$video['thumbnail']; ?>" alt="<?php  echo $video['title']; ?>" class="src">

                                    <div class="duration">
                                        <span><?php echo $video['duration'];?></span>
                                    </div>
                                    
                                </div>

                                <div class="details">
                                    
                                    <h3 class="title"><?php echo $video['title'];?></h3>
                                    <span class="username"><?php echo $video['uploadedBy'];?></span>
                                    <div class="stats">
                                        <span class="viewCount"><?php echo $video['views'];?> views</span>
                                        <span class="timeStamp"><?php echo date("M jS, Y",strtotime($video['uploadDate'])) ;?></span>
                                    </div>
                                    <?php echo $video['description'];?>
                                </div>

                            </div>

                       </a>  

                    </div>
             <?php 

                }
             
             ?>
       </div>
<!-- CLOSER OF CONTAINER DIV OPENED FROM VIDEO SUBSCRIPTION VIEW        -->
</div>