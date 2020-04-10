<!---->
<?php
//        echo "<pre>";
//        print_r($likedVideos);
//        die();
//?>

<div class="container">
    <div class="row mb-5 pb-3 border-bottom">
        <div class="col-sm-12 videoGridHeader">
            Videos that you have liked
        </div>
        <?php
        // echo "<pre>";
        //  print_r($_SESSION);
        // echo "</pre>";
        // exit();
        if(sizeof($likedVideos) > 0)
            foreach($likedVideos as $video) {
                ?>
                <div class='col-md-12 searchPageStyle'>

                    <a href=" <?php echo base_url();  ?>watch?id=<?php echo $video['id'] ?> ">

                        <div class="videoGridItem">

                            <div class="thumbnail">

                                <img src="<?php echo base_url().$video['thumbnail']; ?>" alt="<?php  echo $video['title']; ?>" class="src">

                                <div class="duration">
                                    <span><?php echo $video['duration'];?></span>
                                </div>

                            </div>

                            <div class="details w-100">

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
                No videos to show
            </div>
            <?php
        }

        ?>
    </div>
    <!-- </div> --><?php
