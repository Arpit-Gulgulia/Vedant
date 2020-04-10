<?php

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

$videoId = $_POST['dataInput'][0];
$username = $_POST['dataInput'][1];


$con = mysqli_connect("localhost","root","Mysqlarp@006r","vedant2");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}


$query = "SELECT * FROM dislikes where username='{$username}' AND videoId={$videoId}";

$result = mysqli_query($con,$query);

if($result) {
    // CHECK IF VIDEO IS LIKED OR NOT
    if(mysqli_num_rows($result)>0) {
        // VIEDO HAS ALREADY DISLIKED
        $query = "DELETE FROM dislikes where username='{$username}' AND videoId={$videoId}";
        $result = mysqli_query($con,$query);

        $result = array(

            "likes" => 0,
            "dislikes" => -1

        );
        
        echo json_encode(utf8ize($result));

    }
    else{
        
        // FIRST DELETE FROM LIKES TABLE
        $query = "DELETE FROM likes where username='{$username}' AND videoId={$videoId}";
        $result = mysqli_query($con,$query);
        $count = mysqli_affected_rows($con);  //We contain 0(if not in dislike table) or 1(if in like table)  
        


        //INSERT LIKE INTO LIKES TABLE
        $query = "INSERT INTO dislikes (username,videoId) VALUES ('{$username}',{$videoId} )";
        $result = mysqli_query($con,$query);

        $result = array(

            "likes" => 0 - $count,
            "dislikes" => 1

        );
    
        echo json_encode(utf8ize($result));
    }
}
else{
    echo "Query Failed!";
}
die();


?>