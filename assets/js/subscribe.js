function subscribe (button,uploadedBy,userLoggedIn) {

   // alert(uploadedBy);
     $.post("ajax/subscribe.php",{'userTo': uploadedBy,'userFrom':userLoggedIn})
     .done(function(subscriberCount){

        if(subscriberCount != null) {

          $(button).toggleClass("subscribe unsubscribe");

          var buttonText = $(button).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED"; 
          $(button).text(buttonText + " " + subscriberCount); 

        }
        else {

         alert("Something Went Wrong");

        }
     });
}