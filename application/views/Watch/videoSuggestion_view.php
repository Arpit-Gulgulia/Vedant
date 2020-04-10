<div class="suggestions" style="">



<div class="videoGrid">

    
         
             <?php
                foreach($suggestedVideos as $video) {
                    ?>
                
                     <a href=" <?php echo base_url();  ?>watch?id=<?php echo $video['id'] ?> ">
                 
                                <div class="videoGridItem">
                                
                                    <div class="thumbnail">
                                        
                                        <img src="<?php echo base_url().$video['thumbnail']; ?>" alt="<?php  echo $video['title']; ?>" class="src">

                                        <div class="duration">
                                            <span><?php echo $video['duration'];?></span>
                                        </div>
                                        
                                    </div>

                                   <div class="details" style="font-size: 13px">
                                        
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
            
                    <?php
                }
             ?>
            
         
   

</div>







</div>