<div class="profileContainer">
<!--    PHOTO COVER SECTION-->
    <div class='coverPhotoContainer'>
        <img src='<?php echo base_url()."assets/images/coverPhotos/default-cover-photo.jpg"?>' class='coverPhoto'>
        <span class='channelName'><?php echo $name; ?></span>
    </div>

<!--    HEADER SECTION-->
    <div class='profileHeader'>
        <div class='userInfoContainer'>
            <img class='profileImage' src='<?php echo $profileImage; ?>'>
            <div class='userInfo'>
                <span class='title'><?php echo $name; ?></span>
                <span class='subscriberCount'><?php echo $subCount; ?> subscribers</span>
            </div>
        </div>

        <div class='buttonContainer'>
            <div class='buttonItem'>
                <?php echo $button;?>
            </div>
        </div>
    </div>


<!--TAB SECTION-->
    <ul class='nav nav-tabs' role='tablist'>
        <li class='nav-item'>
            <a class='nav-link active' id='videos-tab' data-toggle='tab'
               href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab'
               aria-controls='about' aria-selected='false'>ABOUT</a>
        </li>
    </ul>

<!--    CONTENT SECTION-->
    <div class='tab-content channelContent'>
        <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
<!--            $videoGridHtml-->
            <div class="container">
                <div class="row mb-5 pb-3 border-bottom">
                    <?php
                    if(sizeof($videos) > 0)
                        foreach($videos as $video) {
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
                            No trending videos to show
                        </div>
                        <?php
                    }

                    ?>
                </div>
            </div>
        </div>
        <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
            <div class='section'>
                <div class='title'>
                    <span>Details</span>
                </div>
                <div class='values'>
                    <?php
                    foreach($details as $key => $value) {
                        echo "<span>$key: $value</span>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
