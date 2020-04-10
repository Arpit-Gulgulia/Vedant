<div class="container">
       <div class="row mb-5 pb-3 border-bottom">
          <div class="col-sm-12 videoGridHeader">
              Subscriptions
          </div>
             <?php
                // echo "<pre>";
                //  print_r($_SESSION);
                // echo "</pre>"; 
                // exit();
                if(sizeof($subscriptionVideos) > 0)

                foreach($subscriptionVideos as $video) {
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

                else {
                    ?>
                    <div class="col-sm-12">
                        No Subscription!
                    </div>
                    <?php 
                }
             
             ?>
       </div>
<!-- </div> -->