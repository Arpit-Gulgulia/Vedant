    function likeVideo(button, videoId,username) {
        var dataInput = [];
        dataInput[0] = videoId;
        dataInput[1] = username;
        // console.log(dataInput);
        $.post("ajax/likeVideo.php",{'dataInput' : dataInput})
        .done(function(data) {
            // alert(data);
            var likeButton = $(button);
            var dislikeButton = $(button).siblings(".dislikeButton");

            likeButton.addClass("active");
            dislikeButton.removeClass("active");

            var result = JSON.parse(data); //We convert string into jason data
            updateLikesValue(likeButton.find(".text"),result.likes);
            updateLikesValue(dislikeButton.find(".text"),result.dislikes);

            if(result.likes < 0) {
                //Liked is removed!
                likeButton.removeClass("active");
                likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
            }
            else {
                //Liked is added!
                likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up-active.png")
            }
    
            dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-down.png");


        });
    }

    function updateLikesValue(element, num) {

        var likesCountVal = element.text() || 0;
        element.text(parseInt(likesCountVal) + parseInt(num));

    }