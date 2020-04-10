<?php
require_once("config.php");
require_once("Comment.php");
require_once("User.php");

$username = $_SESSION["username"];
$videoId = $_POST["videoId"];
$commentId = $_POST["commentId"];

$userLoggedInObj = new User($con, $username);
$comment = new Comment($con, $commentId, $userLoggedInObj, $videoId);

echo $comment->getReplies();
?>