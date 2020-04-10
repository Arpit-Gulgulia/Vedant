<?php

if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {
    $userTo = $_POST['userTo'];
    $userFrom = $_POST['userFrom'];
    // echo $userFrom;
    // die();
    $con = mysqli_connect('localhost','root','Mysqlarp@006r','vedant2');
    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
   
    //Check if User is Subscribed or not
    
    $query = "SELECT * FROM subscribers where userTo ='{$userTo}' AND userFrom = '{$userFrom}'";

    $result = mysqli_query($con,$query);
   

    if(mysqli_num_rows($result) > 0 ) {
         //If Subscribed - Delete
         
         $query = " DELETE FROM subscribers where userTo ='{$userTo}' AND userFrom = '{$userFrom}' ";
         $result = mysqli_query($con,$query);
         if(!$result){
            echo "Deletion query failed";
            echo mysqli_error($con);
            die();
        }
        

    }
     else {
        //If not subscribed - Insert
       
        $query = "INSERT INTO subscribers (userTo,userFrom) VALUES ('{$userTo}','{$userFrom}')";
        $result = mysqli_query($con,$query);

        if(!$result){
            echo "Insertion query failed";
            echo mysqli_error($con);
            die();
        }
        // else {
        //     echo "Subscribed successfully Check database!!!";
        //     die();
        // }
     }

    

    //Retrun new number of subscribers
    $query = "SELECT * FROM subscribers where userTo ='{$userTo}' AND userFrom = '{$userFrom}'";

    $result = mysqli_query($con,$query);

    echo mysqli_num_rows($result);

}
else {
    echo "one or more parameter are passed in subscribe.php file";
}


?>