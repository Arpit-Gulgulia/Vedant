<!DOCTYPE html>
<html>
<head>
	<title>Vedant</title>
    
    <!-- Bootstrap4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
    <!-- Jquery Cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- JS, Popper.js required for Bootstrap4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="assets/js/jquery.js"></script>
    <!-- Customize Js -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/commonActions.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/commentActions.js"></script>
    <script src="assets/js/subscribe.js"></script>


</head>
<body>
    
   	<div id="pageContainer">
   
   		<div id="mastHeadContainer">

   			
            <button class ="navShowHide">
            	<img src="<?php echo base_url();?>assets/images/icons/menu.png">
            </button>
  
            <a class="logoContainer" href="<?php echo base_url();?>home">
            	<img src="<?php echo base_url();?>assets/images/icons/vedant.png" title="logo" alt="Site logo">
            </a>
            
            <div class="searchBarContainer">
            	<form action="<?php echo base_url();?>search" method="GET">
            		<input type="text" name="term" class="searchBar" placeholder="Search">
            		<button class="searchButton" style="margin-left: 0"><i class="fas fa-search"></i></button>
            	</form>
            	
            </div>
            <div class="rightIcons py-2">
                <?php if(!isset($username) || $username==="") {
                    echo "<button onclick='notSignedIn()' >
                            <i class=\"fas fa-upload fa-lg pr-3\" style='color: #5a0099'></i>
                          </button>
                         <a href=\"http://localhost/Vedant2/users/login\">
                            <span class=\"signInLink\">SIGN IN</span>
                         </a>";
                }
                else {
                    echo " <a href=\"http://localhost/Vedant2/upload\">
                             <i class=\"fas fa-upload fa-lg px-3\"></i>
                          </a>";
                    $profilePic = $profilePic;
                    $username = $username;
                    $link = "profile?username=$username";

                    echo "<a href='$link'>
                              <span style='padding: 0px'>
                                   <img src='http://localhost/Vedant2/$profilePic' class='profilePicture'>
                               </span>
                          </a>";
                }
                ?>


            </div>
   		</div> <!-- End of mastHeadContainer -->

   		<div id="sideNavContainer" style="display: none">
   			
               <ul class="list-unstyled">
               	  <li>
                      <i class="fas fa-home fa-lg px-4 py-4"></i>
                          <a href=<?php echo base_url()?>>Home</a>
                  </li>
               	  <li>
                      <i class="fas fa-fire fa-lg px-4 py-4"></i>
                      <a href="<?php echo base_url();?>trending">Trending</a>
                  </li>

               	 <?php

                  if(isset($username) && $username!==""){
                      echo " <li>
                                  <i class=\"fas fa-suitcase-rolling fa-lg px-4 py-4\"></i>
                                  <a href=\"http://localhost/Vedant2/subscription\">Subscription</a>
                              </li>
                              <li>
                                  <i class=\"far fa-thumbs-up fa-lg px-4 py-4\"></i>
                                  <a href=\"http://localhost/Vedant2/likedVideos\">Liked Videos</a>
                              </li>
                              <li>
                                  <i class=\"fas fa-cog fa-lg px-4 py-4\"></i>
                                  <a href=\"http://localhost/Vedant2/settings\">Setting</a>
                              </li>
                             <li>
                                <i class=\"far fa-arrow-alt-circle-right fa-lg px-4 py-4\"></i>
                                    <a href=\"http://localhost/Vedant2/users/logout\">Log Out</a>
                             </li>";
                  }
                  else{
                      echo " <li>
                                  <i class=\"fas fa-suitcase-rolling fa-lg px-4 py-4\"></i>
                                  <a href=\"#\" onclick='notSignedIn()'>Subscription</a>
                              </li>
                              <li>
                                  <i class=\"far fa-thumbs-up fa-lg px-4 py-4\"></i>
                                  <a href=\"#\" onclick='notSignedIn()'>Liked Videos</a>
                              </li>
                              <li>
                                  <i class=\"fas fa-cog fa-lg px-4 py-4\"></i>
                                  <a href=\"#\" onclick='notSignedIn()'>Setting</a>
                              </li>";
                  }

                 ?>
               </ul>
               <span class="heading">Subscriptions</span>
               <?php
                   if (isset($username) && $username!=="")
                   foreach($subscriptions as $sub=>$pic) {
                       $subUsername = $sub;
                       $icon = $pic;
                       echo "<div class='navigationItem'>
                                  <a href='http://localhost/Vedant2/profile?username=$subUsername'>
                                      <img src='http://localhost/Vedant2/$icon'>
                                      <span>$subUsername</span>
                                  </a>
                             </div>";
                   }
               ?>
   		</div> <!-- End of sideNavContainer -->

   		<div id="mainSectionContainer"> <!-- This is underneath the SideNavigation bar -->
   			  
             <div id="mainContentContainer" style="overflow-x:hidden;">